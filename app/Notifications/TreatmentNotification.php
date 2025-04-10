<?php
namespace App\Notifications;

use App\Models\Patient;
use App\Models\Treatment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TreatmentNotification extends Notification
{
    use Queueable;

    public $treatment;
    public $patient;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Treatment $treatment)
    {
        $this->treatment = $treatment;
        $this->patient = Patient::with('user')->where('id', $treatment->patient_id)->first();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'title'   => "Treatment: " . $this->treatment->test_name,
            'message' => "New Treatment added for patient #{$this->patient->user->name}",
            'icon'    => 'fas fa-file',
            'url'     => route('treatments.index', $this->treatment->patient_id),
        ];
    }

    public function toBroadcast($notifiable)
    {
        return [
            'title'   => "Treatment: " . $this->treatment->test_name,
            'message' => "New Treatment added for patient #{$this->patient->user->name}",
            'icon'    => 'fas fa-file',
            'url'     => route('treatments.index', $this->treatment->patient_id),
        ];
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
