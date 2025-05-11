<?php

namespace App\Services;

use Google\Client;
use Illuminate\Support\Facades\Http;

class FCMV1Service
{
    public static function sendNotification($deviceToken, $title, $body, $data = [])
    {
        $keyFilePath = storage_path('app/firebase/firebase-adminsdk.json');

        $client = new Client();
        $client->setAuthConfig($keyFilePath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');

        $accessToken = $client->fetchAccessTokenWithAssertion()['access_token'];

        $projectId = config('services.firebase.project_id'); // Store in config/services.php or .env
        $url = "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send";

        $payload = [
            'message' => [
                'token' => $deviceToken,
                'notification' => [
                    'title' => $title,
                    'body' => $body,
                ],
                'data' => $data,
            ],
        ];

        $response = Http::withToken($accessToken)
            ->post($url, $payload);

        return $response->json();
    }

    public function notify(Request $request)
    {
        $deviceToken = $request->device_token;
        $title = 'Hello';
        $body = 'This is a secure v1 FCM push';
        $data = ['customKey' => 'value'];

        return FCMV1Service::sendNotification($deviceToken, $title, $body, $data);
    }
}