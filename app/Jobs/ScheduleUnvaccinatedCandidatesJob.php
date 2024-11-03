<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Constants\Status;
use App\Models\VaccineCenter;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\VaccineNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;

class ScheduleUnvaccinatedCandidatesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;

    public $backoff = 10;

    public $retryAfter = 60;

    public $timeout = 120;

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
            $centers = VaccineCenter::with(['vaccineCandidates' => function($query) {
                $query->where('status', Status::NOT_SCHEDULED)
                      ->orderBy('created_at');
            }])->get();
            
            $candidatesByCenter = $centers->map(function($center) {
                return $center->vaccineCandidates->take($center->daily_limit);
            });
            
            foreach ($candidatesByCenter as $candidates) 
            {
                foreach ($candidates as $candidate) 
                {
                    $candidate->update([
                        'status'        => Status::SCHEDULED,
                        'schedule_date' => Carbon::now()->addDay()->format('Y-m-d'),
                    ]);
    
                    $candidate->notify(new VaccineNotification($candidate));
                    // Notification::send($candidate, (new VaccineNotification($candidate))->delay(now()->addMinutes(1)));
                    sleep(5);
                }
            }
        } catch (\Exception $e) {
            Log::error('Error sending notifications: ' . $e->getMessage());
        }
    }
}
