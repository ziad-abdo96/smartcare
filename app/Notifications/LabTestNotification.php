<?php
namespace App\Notifications;

use App\Models\LabTest;
use App\Models\Patient;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LabTestNotification extends Notification
{
    use Queueable;

    public $labTest;
    public $patient;
 
    public function __construct(LabTest $labTest)
    {
        $this->labTest = $labTest;
        $this->patient = Patient::with('user')->where('id', $labTest->patient_id)->first();
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
            'title'   => "Lab Test: " . $this->labTest->test_name,
            'message' => "New lab test added for patient #{$this->patient->user->name}",
            'icon'    => 'fas fa-file',
            'url'     => route('lab-tests.index', $this->labTest->patient_id),
        ];
    }

    public function toBroadcast($notifiable)
    {
        return [
            'title'   => "Lab Test: " . $this->labTest->test_name,
            'message' => "New lab test added for patient #{$this->patient->user->name}",
            'icon'    => 'fas fa-file',
            'url'     => route('lab-tests.index', $this->labTest->patient_id),
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
