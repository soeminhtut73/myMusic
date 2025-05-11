<?php

namespace App\Http\Controllers\API;

use App\Models\DeviceToken;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeviceTokenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($user_id)
    {
        $tokens = DeviceToken::where('user_id', $user_id)->get();

        return response()->json(['tokens' => $tokens], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'user_id' => 'required',
            'device_token' => 'required|string|unique:device_tokens,device_token',
        ]);

        DeviceToken::updateOrCreate(
            ['user_id' => $request->user_id],
            ['device_token' => $request->device_token]
        );

        return response()->json([
            'message' => 'Device token stored successfully',
            'data' => $request->device_token
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user_id)
    {
        $deleted = DeviceToken::where('user_id', $user_id)->delete();

        return response()->json([
            'message' => $deleted ? 'Token deleted.' : 'No token found.',
        ]);
    }
}
