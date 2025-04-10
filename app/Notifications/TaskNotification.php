<?php
namespace App\Notifications;

use App\Models\Patient;
use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskNotification extends Notification
{
    use Queueable;

    public $task;
    public $patient;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
        $this->patient = Patient::with('user')->where('id', $task->patient_id)->first();
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
            'title'   => "Task: " . $this->task->test_name,
            'message' => "New Task added for patient #{$this->patient->user->name}",
            'icon'    => 'fas fa-file',
            'url'     => route('tasks.index', $this->task->patient_id),
        ];
    }

    
    public function toBroadcast($notifiable)
    {
        return [
            'title'   => "Task: " . $this->task->test_name,
            'message' => "New Task added for patient #{$this->patient->user->name}",
            'icon'    => 'fas fa-file',
            'url'     => route('tasks.index', $this->task->patient_id),
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
