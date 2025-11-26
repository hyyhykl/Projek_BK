<?php

namespace App\Notifications;

use App\Models\Pengajuan;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PengajuanBaruNotification extends Notification
{
    use Queueable;

    protected Pengajuan $pengajuan;

    /**
     * Create a new notification instance.
     */
    public function __construct(Pengajuan $pengajuan)
    {
        $this->pengajuan = $pengajuan;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int,string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Data stored to database channel.
     *
     * @return array<string,mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'Pengajuan Baru',
            'message' => 'Pengajuan baru dari ' . $this->pengajuan->nama_pelapor,
            'pengajuan_id' => $this->pengajuan->id,
            'created_at' => now()->toDateTimeString(),
        ];
    }

    /**
     * Fallback array representation.
     *
     * @return array<string,mixed>
     */
    public function toArray(object $notifiable): array
    {
        return $this->toDatabase($notifiable);
    }
}