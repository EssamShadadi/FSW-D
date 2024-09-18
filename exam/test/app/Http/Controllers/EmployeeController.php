<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tickets;
use App\Models\software_tickets;
use App\Models\hardware_tickets;
use App\Models\it_specialists;
use App\Models\centers;
class EmployeeController extends Controller
{
    public function SubmitTicket(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'location' => 'required|integer',
            'problem_description' => 'required|string',
            'problem_type' => 'required|string|in:Hardware,Software',
            'device_type' => 'nullable|string',
            'os_version' => 'nullable|string',
            'error_code' => 'nullable|string',
            'screenshots' => 'nullable|file|mimes:png,jpg,jpeg',
            'serial_number' => 'nullable|string',
            'picture' => 'nullable|file|mimes:png,jpg,jpeg',
        ]);
        $location = centers::where('CenterName' , $request->input('location'))->first();
        $specialist = it_specialists::where('LocationID' ,$location->CenterID )->first()->SpecialistID??null;
        $ticket = tickets::create([
            'EmployeeID' => $request->user->EmployeeID, 
            'SpecialistID' => $specialist, 
            'ProblemDescription' => $request->input('problem_description'),
            'ProblemType' => $request->input('problem_type'),
            'DeviceType' => $request->input('device_type'),
        ]);

        if ($request->hasFile('screenshots')) {
            $screenshot = $request->file('screenshots')->store('screenshots');
            software_tickets::create([
                'TicketID' => $ticket->TicketID,
                'Screenshot' => $screenshot,
                'OSVersion' => $request->input('os_version'),
                'ErrorCode' => $request->input('error_code'),
            ]);
        }

        if ($request->input('problem_type') === 'Hardware') {
            $picture = $request->hasFile('picture') ? $request->file('picture')->store('pictures') : null;
            hardware_tickets::create([
                'TicketID' => $ticket->TicketID,
                'SerialNumber' => $request->input('serial_number'),
                'Picture' => $picture,
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Ticket submitted successfully']);
    }
}
