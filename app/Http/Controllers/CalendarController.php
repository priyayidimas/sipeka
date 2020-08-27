<?php

namespace App\Http\Controllers;

use Google_Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Carbon\Carbon;
use App\Model\Event;
use App\Model\Kelas;


class CalendarController extends Controller
{
    private $cilent;

    public function __construct() {
        $this->client = new Google_Client();
        $this->client->setApplicationName(env('APP_TITLE'));
        $this->client->setDeveloperKey(env('GOOGLE_SERVER_KEY'));
    }

    public function bentrokHandler($minDate, $maxDate){
        $this->client->setAccessToken(Auth::user()->token);
        $service = new \Google_Service_Calendar($this->client);

        $calendars = $service->calendarList->listCalendarList()->items;
        $items = [];
        foreach($calendars as $calendar){
            $item = new \Google_Service_Calendar_FreeBusyRequestItem;
            $item->setId($calendar['id']);
            array_push($items, $item);
        }
        $request = new \Google_Service_Calendar_FreeBusyRequest;
        $request->setItems($items);
        $request->setTimeMin($minDate->format('c'));
        $request->setTimeMax($maxDate->format('c'));
        $request->setTimeZone('Asia/Jakarta');

        $freebusy = $service->freebusy->query($request);

        $count = 0;
        foreach($freebusy['calendars'] as $calendar){
            $count = $count + count($calendar['busy']);
        }
        $cek = ($count == 0) ? true : false;
        return $cek;
    }

    public function storeEvent(Request $req){
        // Init
        $this->client->setAccessToken(Auth::user()->token);
        $service = new \Google_Service_Calendar($this->client);

        // Create Date From Formatted String
        $mulai = Carbon::createFromFormat('d F Y @ H:i', $req->waktu_mulai, 'Asia/Jakarta');
        $selesai = Carbon::createFromFormat('d F Y @ H:i', $req->waktu_selesai, 'Asia/Jakarta');

        // Bentrok Handler
        $cek = $this->bentrokHandler($mulai, $selesai);
        if(!$cek) return "Bentrok";

        // Init Event
        $event = new \Google_Service_Calendar_Event(array(
            'summary' => $req->title,
            'location' => 'SiPeka',
            'description' => $req->desc,
            'start' => array(
                'dateTime' => $mulai->format('c'),
                'timeZone' => 'Asia/Jakarta'
            ),
            'end' => array(
                'dateTime' => $selesai->format('c'),
                'timeZone' => 'Asia/Jakarta'
            ),
        ));

        // Invite Others

        $event->setAttendees([
            ['email' => 'priyayidimas@gmail.com'],
        ]);

        // Select Calendar Id
        $calendarId = Auth::user()->calendar_id;

        // Insert Event
        $event = $service->events->insert($calendarId, $event, ['sendUpdates' => 'all']);

        printf('Event created: %s', $event->htmlLink);

        // Conference Data
        $conference = new \Google_Service_Calendar_ConferenceData();
        $conferenceRequest = new \Google_Service_Calendar_CreateConferenceRequest();
        $conferenceRequest->setRequestId('IniMeeting');
        $conference->setCreateRequest($conferenceRequest);
        $event->setConferenceData($conference);

        // Update Again
        $event = $service->events->patch($calendarId, $event->id, $event, ['conferenceDataVersion' => 1]);

        printf('<br>Conference created: %s', $event->hangoutLink);

        // Store To Sipeka DB
        $dbEvent = new Event;
        $dbEvent->fill($req->all());
        $dbEvent->waktu_mulai = $mulai->format('Y-m-d H:i:s');
        $dbEvent->waktu_selesai = $selesai->format('Y-m-d H:i:s');
        $dbEvent->id_kelas = $req->id_kelas;
        $dbEvent->link = $event->hangoutLink;
        $dbEvent->save();
        printf("DB Event Stored");
    }

    // DEBUG
    public function calendars(){
        $this->client->setAccessToken(Auth::user()->token);

        $service = new \Google_Service_Calendar($this->client);

        $results = $service->calendarList->listCalendarList()->items;
        $sipekaCalendar = null;
        foreach($results as $result){
            if($result['summary'] == '[SiPeka]'){
                $sipekaCalendar = $result;
                break;
            }
        }
        if($sipekaCalendar){
            dd($sipekaCalendar);
        }else{
            echo "GAK ADA WOY";
        }
    }

    public function getEvents(){
        $mulai = Carbon::parse('2020-09-01 07:00:00')->addMinutes(-30);
        $akhir = Carbon::parse('2020-09-01 07:00:00')->addHour()->addMinutes(30);

        $mulai_data = Carbon::parse('2020-09-01 08:00:00');
        $akhir_data = Carbon::parse('2020-09-01 09:00:00');

        $kelasEvent = [];
        $kelas = Auth::user()->join;
        foreach($kelas as $kel){
            $event = $kel->event()
            ->whereBetween('waktu_mulai',[$mulai, $mulai_data])
            ->orWhereBetween('waktu_selesai', [$mulai_data,$akhir_data])
            ->get();
            array_push($kelasEvent, $event);
        }
        $count = [];
        foreach($kelasEvent as $events){
            foreach($events as $event){
                $joinEvent = $event->joinEvent;
                array_push($count, count($joinEvent));
            }
        }

        $cek = (array_sum($count) == 0) ? true : false;
        return $cek;
    }

    public function getEventsB(){
        $mulai = Carbon::parse('2020-09-01 07:00:00')->addMinutes(-30);
        $akhir = Carbon::parse('2020-09-01 07:00:00')->addHour()->addMinutes(30);

        $kelas = Kelas::find(1);
        $events = $kelas->event()->whereBetween('waktu_mulai',[$mulai, $akhir])->get();
        dd($mulai,$akhir,$events);
    }

    public function getEventsCalendar()
    {
        $this->client->setAccessToken(Auth::user()->token);

        $service = new \Google_Service_Calendar($this->client);

        $optParams = array(
            'maxResults' => 10,
            'orderBy' => 'startTime',
            'singleEvents' => true,
            'timeMin' => date('c'),
        );
        $results = $service->events->listEvents(Auth::user()->calendar_id, $optParams);
        $events = $results->getItems();

        return view('events', compact('events'));
    }

    public function createCalendar()
    {
        $this->client->setAccessToken(Auth::user()->token);
        $service = new \Google_Service_Calendar($this->client);

        $meet = new \Google_Service_Calendar_ConferenceProperties;
        $meet->setAllowedConferenceSolutionTypes(['hangoutsMeet']);

        $calendar = new \Google_Service_Calendar_Calendar();
        $calendar->setSummary('[SiPeka]');
        $calendar->setTimeZone('Asia/Jakarta');
        $calendar->setConferenceProperties($meet);
        $calendar->setDescription("Kalender Otomatis Yang Dibuat Oleh SiPeka");

        $createdCalendar = $service->calendars->insert($calendar);

        return $createdCalendar->getId();

    }

    public function calendar()
    {
        // Playground to convert string to date
        $dateMin = Carbon::createFromFormat('d F Y @ H:i','28 August 2020 @ 18:00','Asia/Jakarta')
                ->format('c');
        $dateMax = Carbon::createFromFormat('d F Y @ H:i','28 August 2020 @ 20:00','Asia/Jakarta')
                ->format('c');

        //Playground for bentrok handler
        $this->client->setAccessToken(Auth::user()->token);
        $service = new \Google_Service_Calendar($this->client);

        $calendars = $service->calendarList->listCalendarList()->items;
        $items = [];
        foreach($calendars as $calendar){
            $item = new \Google_Service_Calendar_FreeBusyRequestItem;
            $item->setId($calendar['id']);
            array_push($items, $item);
        }
        $request = new \Google_Service_Calendar_FreeBusyRequest;
        $request->setItems($items);
        $request->setTimeMin($dateMin);
        $request->setTimeMax($dateMax);
        $request->setTimeZone('Asia/Jakarta');

        $freebusy = $service->freebusy->query($request);

        $count = 0;
        foreach($freebusy['calendars'] as $calendar){
            $count = $count + count($calendar['busy']);
        }
        dd($count);
    }

    public function createEventConference()
    {
        $this->client->setAccessToken(Auth::user()->token);
        $service = new \Google_Service_Calendar($this->client);

        $event = new \Google_Service_Calendar_Event(array(
            'summary' => 'Appointment',
            'location' => 'Indonesia',
            'description' => 'Hello world',
            'start' => array(
                'dateTime' => Carbon::now()->format('c'),
                'timeZone' => 'Asia/Jakarta',
            ),
            'end' => array(
                'dateTime' => Carbon::now()->addMinutes(90)->format('c'),
                'timeZone' => 'Asia/Jakarta',
            )
        ));
        $event->setAttendees([
            ['email' => 'priyayidimas@gmail.com'],
            ['email' => 'mendozadante05@gmail.com']
        ]);
        $calendarId = Auth::user()->calendar_id;
        $event = $service->events->insert($calendarId, $event);

        printf('Event created: %s', $event->htmlLink);

        $conference = new \Google_Service_Calendar_ConferenceData();
        $conferenceRequest = new \Google_Service_Calendar_CreateConferenceRequest();
        $conferenceRequest->setRequestId('IniMeeting');
        $conference->setCreateRequest($conferenceRequest);
        $event->setConferenceData($conference);

        $event = $service->events->patch($calendarId, $event->id, $event, ['conferenceDataVersion' => 1]);

        printf('<br>Conference created: %s', $event->hangoutLink);
    }

    public function getPeople()
    {
        $this->client->setAccessToken(Auth::user()->token);

        $service = new \Google_Service_PeopleService($this->client);

        $optParams = array('requestMask.includeField' => 'person.phone_numbers,person.names,person.email_addresses');
        $results = $service->people_connections->listPeopleConnections('people/me',$optParams);

        return view('contacts', compact('results'));
    }
}
