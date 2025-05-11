<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\FCMV1Service;

class NotificationController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'device_token' => 'required|string',
        ]);

        $deviceToken = $request->device_token;
        $title = 'Test Notification';
        $body = 'This is a test push notification from Laravel using FCM v1.';
        $data = ['key1' => 'value1', 'type' => 'test'];

        $response = FCMV1Service::sendNotification($deviceToken, $title, $body, $data);

        return response()->json($response);
    }
}
