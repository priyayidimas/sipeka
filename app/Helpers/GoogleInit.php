<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\Storage;

class GoogleInit {
    public function getClient()
    {
        $client = new \Google_Client();
        $client->setApplicationName('Sipeka');
        $client->setAccessType('offline');
        $client->setAuthConfig(storage_path('private/client_secret.json'));
        $client->setPrompt('select_account consent');
        $client->setRedirectUri(url('/glogin'));
        $client->setIncludeGrantedScopes(true);
        $client->setScopes([
            \Google_Service_PeopleService::USERINFO_PROFILE,
            \Google_Service_Calendar::CALENDAR_EVENTS,
            \Google_Service_Drive::DRIVE
        ]);

/*
        $tokenPath = Storage::path('public/token.json');
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $client->setAccessToken($accessToken);
        }
        if ($client->isAccessTokenExpired()) {
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            } else {
                $authUrl = $client->createAuthUrl();
                printf("Open the following link in your browser:\n%s\n", $authUrl);
                print 'Enter verification code: ';
                $authCode = trim(fgets(STDIN));

                $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                $client->setAccessToken($accessToken);

                if (array_key_exists('error', $accessToken)) {
                    throw new Exception(join(', ', $accessToken));
                }
            }
            // Save the token to a file.
            if (!file_exists(dirname($tokenPath))) {
                mkdir(dirname($tokenPath), 0700, true);
            }
            file_put_contents($tokenPath, json_encode($client->getAccessToken()));
        }
*/

        return $client;
    }
}
