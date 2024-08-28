<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class ZoomService
{
    protected $client;
    protected $baseUri = 'https://api.zoom.us/v2/';

    public function __construct()
    {
        $this->client = new Client();
    }

    protected function generateToken(): string
    {
        try {
            $base64String = base64_encode(env('ZOOM_CLIENT_ID') . ':' . env('ZOOM_CLIENT_SECRET'));
            $accountId = env('ZOOM_ACCOUNT_ID');

            $responseToken = Http::withHeaders([
                "Content-Type" => "application/x-www-form-urlencoded",
                "Authorization" => "Basic {$base64String}"
            ])->post("https://zoom.us/oauth/token?grant_type=account_credentials&account_id={$accountId}");

            $token = $responseToken->json();

            if (isset($token['access_token'])) {
                return $token['access_token'];
            }

            throw new \Exception('Failed to retrieve access token.');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    protected function generateZoomSignature($sdkKey, $sdkSecret, $meetingId, $role): string
    {
        $timestamp = time() * 1000 - 30000; // 30 seconds earlier
        $message = $sdkKey . $meetingId . $timestamp . $role;
        $signature = base64_encode(hash_hmac('sha256', $message, $sdkSecret, true));

        return $signature;
    }

    public function createMeeting($data)
    {
        $accessToken = $this->generateToken();

        $response = $this->client->post($this->baseUri . 'users/me/meetings', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ],
            'json' => $data,
        ]);

        $meeting = json_decode($response->getBody()->getContents());

        // Generate SDK details for frontend
        $sdkKey = env('ZOOM_SDK_KEY');
        $sdkSecret = env('ZOOM_SDK_SECRET');
        $signature = $this->generateZoomSignature($sdkKey, $sdkSecret, $meeting->id, 1); // 1 for host role

        return (object) [
            'meeting' => $meeting,
            'meetingSdk' => [
                'meetingNumber' => $meeting->id,
                'sdkKey' => $sdkKey,
                'signature' => $signature,
                'password' => $meeting->password,
                'role' => 1, // Host role
                'userName' => $data['host_name'] ?? 'Host',
                'userEmail' => $data['host_email'] ?? 'host@example.com',
            ],
        ];
    }

    public function listMeetings()
    {
        $accessToken = $this->generateToken();

        $response = $this->client->get($this->baseUri . 'users/me/meetings', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
            ],
        ]);

        return json_decode($response->getBody()->getContents());
    }
}
