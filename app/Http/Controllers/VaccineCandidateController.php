<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Constants\Status;
use Illuminate\Http\Request;
use App\Models\VaccineCenter;
use App\Models\VaccineCandidate;
use App\Services\VaccineCandidateService;
use App\Notifications\VaccineNotification;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\StoreVaccineCandidateRequest;

class VaccineCandidateController extends Controller
{
    public function create()
    {
        $vaccineCenters = VaccineCenter::orderBy('title')->get();

        return view('register', compact('vaccineCenters'));
    }

    public function store(StoreVaccineCandidateRequest $request, VaccineCandidateService $vaccineCandidateService)
    {
        $vaccineCandidateService->store($request->validated());

        return redirect()->back()->with(['success' => 'Your registration has been successful']);
    }

    public function search()
    {
        return view('welcome');
    }

    public function getCandidate(Request $request)
    {
        $candidateNid = $request->validate([
            'nid' =>  'required|numeric|digits:10',
        ]);

        // $candidateNid = $request->input('nid');
  
        $candidate = VaccineCandidate::where('nid', $candidateNid)->get();
        
        return response()->json($candidate);
    }
}
