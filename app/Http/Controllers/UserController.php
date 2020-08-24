<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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
            // ->with(["access_type" => "offline", "prompt" => "consent select_account"])
            ->redirect();
    }

    public function handleProviderCallback()
    {
        //Google
        $user = Socialite::driver('google')->user();

        //Auth
        $authUser = $this->findOrCreateUser($user);
        Auth::login($authUser, true);

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

    public function findOrCreateUser($user)
    {
        $cek = User::where('google_id', $user->id)->count();

        if ($cek > 0) {
            $data = User::where('google_id', $user->id)->first();
        }else{
            $data = new User;
            $data->fullname = $user->name;
            $data->email = !empty($user->email) ? $user->email : '';
            $data->google_id = $user->id;
            $data->avatar = $user->avatar;
        }

        $google_client_token = [
            'access_token' => $user->token,
            'refresh_token' => $user->refreshToken,
            'expires_in' => $user->expiresIn,
        ];

        $data->token = json_encode($google_client_token);
        $data->save();

        return $data;
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
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
}
