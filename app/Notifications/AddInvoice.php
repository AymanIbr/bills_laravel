<?php

namespace App\Notifications;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class AddInvoice extends Notification
{
    use Queueable;

    protected $invoice_id;
    // protected Invoice $invoice ;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($invoice_id)
    {
        $this->invoice_id = $invoice_id;
        // $this->invoice = $invoice;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('http://127.0.0.1:8000/invoices/' . $this->invoice_id);
        return (new MailMessage)
            ->subject('اضافة فاتورة جديدة')
            ->line('اضافة فاتورة جديدة')
            ->action('عرض الفاتورة', $url)
            ->line('شكرا لاستخدامك برنامج ادارة الفواتير');
    }

    public function toDatabase($notifiable)
    {

        return [
            'id' => $this->invoice_id,
            'url' => "/invoices/{$this->invoice_id->id}",
            'title' => 'تم اضافة فاتورة جديدة بواسطة',
            'user' => Auth::user()->name,
        ];
    }


    public function toBroadcast($notifiable)
    {

        return new BroadcastMessage([
            'id' => $this->invoice_id,
            'url' => "/invoices/{$this->invoice_id->id}",
            'title' => 'تم اضافة فاتورة جديدة بواسطة',
            'user' => Auth::user()->name,
        ]);
    }
}
