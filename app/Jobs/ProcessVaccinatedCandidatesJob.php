<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Constants\Status;
use Illuminate\Bus\Queueable;
use App\Models\VaccineCandidate;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessVaccinatedCandidatesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;

    public $backoff = 10;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $candidates = VaccineCandidate::where('status', Status::SCHEDULED)
                ->whereDate('schedule_date', '<',  Carbon::now())
                ->get();

            foreach ($candidates as $candidate) 
            {
                $candidate->update([
                    'status' => Status::VACCINATED
                ]);
            }       
        } catch (\Exception $e) {
            Log::error('Error updating vaccination status: ' . $e->getMessage());
        }
       
    }
}
