<?php

namespace App\Notifications;

use Carbon\Carbon;
use App\Models\VaccineCenter;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VaccineNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected $vaccineCandidate)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Vaccine Registration Update')
                    ->greeting('Hello ' . $this->vaccineCandidate->name)
                    ->line('You are scheduled for your vaccination.')
                    ->line('Please be present at the scheduled date: ' . Carbon::parse($this->vaccineCandidate->schedule_date)->format('d-m-Y'))
                    ->line('Center: ' . VaccineCenter::where('id', $this->vaccineCandidate->vaccine_center_id)->value('title'))
                    ->line('Thank you!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
