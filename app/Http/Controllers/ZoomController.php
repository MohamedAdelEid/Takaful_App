<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ZoomService;

class ZoomController extends Controller
{
    protected $zoomService;

    public function __construct(ZoomService $zoomService)
    {
        $this->zoomService = $zoomService;
    }

    public function listMeetings()
    {
        try {
            $meetings = $this->zoomService->listMeetings();
            return response()->json($meetings);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function createMeeting(Request $request)
    {
        $data = $request->validate([
            'topic' => 'required|string|max:255',
            'start_time' => 'sometimes|date_format:Y-m-d\TH:i:s\Z',
            'duration' => 'sometimes|integer',
            'timezone' => 'sometimes|string',
            'password' => 'sometimes|string|max:10',
            'host_name' => 'sometimes|string|max:255',
            'host_email' => 'sometimes|email',
        ]);

        try {
            $meeting = $this->zoomService->createMeeting($data);

            return response()->json([
                'meeting' => $meeting->meeting,
                'meetingSdk' => $meeting->meetingSdk,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
