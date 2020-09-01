<?php

namespace App\Http\Controllers;

use Google_Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Mail;
use App\Model\Kelas;

class UserController extends Controller
{
/*
    private $gclient;

    public function __construct(GoogleInit $google) {
        $this->gclient = $google->getClient();
    }
*/

    public function index(Request $req)
    {
        $data = session('calendar');
        dd($data);
    }

    public function redirectToProvider($akses)
    {
        // Cek Orang Iseng
        $session = ($akses == 'dosen') ? 'dosen' : 'mhs';
        session(['akses' => $session]);

        //Driver
        return Socialite::driver('google')
            ->scopes([
                'openid', 'profile', 'email',
                \Google_Service_PeopleService::CONTACTS_READONLY ,
                \Google_Service_Calendar::CALENDAR])
            ->with(['prompt' => 'select_account'])
            // ->with(["access_type" => "offline", "prompt" => "select_account consent"])
            ->redirect();
    }

    public function handleProviderCallback()
    {
        //Google
        $user = Socialite::driver('google')->user();

        //Auth
        $authUser = $this->findOrCreateUser($user);
        Auth::login($authUser);

        //Get Akses
        $akses = session('akses');

        //Redirect To Pelengkapan Data if Not Exists
        $cond = Auth::user()->dosen()->count() > 0 ||
                Auth::user()->mahasiswa()->count() > 0;
        if ($cond){
            return redirect($akses);
        }
        return redirect($akses.'/pelengkapan-data');

    }

    public function findOrCreateCalendar($access_token){
        // Google Client Init
        $client = new Google_Client();
        $client->setApplicationName(env('APP_TITLE'));
        $client->setDeveloperKey(env('GOOGLE_SERVER_KEY'));

        // Feed Access Token
        $client->setAccessToken($access_token);

        // Init Service
        $service = new \Google_Service_Calendar($client);

        // Let's see whether there is sipeka calendar or not
        $results = $service->calendarList->listCalendarList()->items;
        $sipekaCalendar = null;
        foreach($results as $result){
            if($result['summary'] == '[SiPeka]'){
                $sipekaCalendar = $result;
                break;
            }
        }

        if($sipekaCalendar){
            // Sipeka Calendar is Exist
            return $sipekaCalendar['id'];
        }else{
            // Create New Calendar
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
    }

    public function findOrCreateUser($user)
    {
        $cek = User::where('google_id', $user->id)->count();

        $google_client_token = [
            'access_token' => $user->token,
            'refresh_token' => $user->refreshToken,
            'expires_in' => $user->expiresIn,
        ];


        if ($cek > 0) {
            $data = User::where('google_id', $user->id)->first();
        }else{
            $data = new User;
            $data->fullname = $user->name;
            $data->email = !empty($user->email) ? $user->email : '';
            $data->google_id = $user->id;
            $data->level = (session('akses') == 'dosen') ? '1' : '0';
        }


        $data->avatar = $user->avatar;
        $data->token = json_encode($google_client_token);
        $data->calendar_id = $this->findOrCreateCalendar($google_client_token);
        $data->save();

        return $data;
    }

    public function logout(Request $req)
    {
        if (Auth::check()) {
            Auth::logout();
            $req->session()->flush();
            $req->session()->regenerate();
        }
        $msg = "Logged Out";
        $color = "green";
        return redirect('/')->with(compact('msg','color'));
    }

    // DEBUG
    public function newAPIRequest()
    {
        $client = new \Google_Client();
        $client->setApplicationName(env('APP_TITLE'));
        $client->setDeveloperKey(env('GOOGLE_SERVER_KEY'));
        // $client->setAccessToken(json_encode($google_client_token));

        // $service = new \Google_Service_PeopleService($client);

        // $optParams = array('requestMask.includeField' => 'person.phone_numbers,person.names,person.email_addresses');
        // $results = $service->people_connections->listPeopleConnections('people/me',$optParams);

        $calendar = new \Google_Service_Calendar($client);
        dd($calendar);
    }

    public function mail(){
        $akses = 'Memposting, menyunting, dan menghapus materi, serta memberikan tugas, me-review dan menilai tugas mahasiswa';

        $to_name = 'Dimas Anom Priyayi';
        $to_email = 'priyayidimas@upi.edu';

        $data = [
            'receiver' => 'Meggy Nurdyansyah',
            'senderName' => 'Dimas Anom Priyayi',
            'senderUniv' => 'Universitas Pendidikan Indonesia',
            'kelasName' => 'Pemrograman Perangkat Bergerak',
            'link' => 'www.google.com',
            'akses' => $akses
        ];

        Mail::send('emails.template2', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Undangan Kontribusi Kelas');
            $message->from('rektor.sipeka@gmail.com','Rektor SiPeka');
        });
    }

    public function invite($kelas_id,$akses,$user_id){
        $kelas = Kelas::find($kelas_id);
        $user = User::find($user_id);

        $kelas->kolab()->attach($user->id, ['akses' => $akses, 'status' => '1']);
        return redirect('/')->with(['msg' => 'Join Kolaborator', 'color' => 'success']);
    }
}
