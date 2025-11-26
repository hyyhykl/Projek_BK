<?php

namespace App\Notifications;

use App\Models\Pengajuan;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class StatusPengajuanNotification extends Notification
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
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Data yang disimpan ke database
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'message' => "Status pengajuan Anda kini: {$this->pengajuan->status}",
            'pengajuan_id' => $this->pengajuan->id,
        ];
    }

    /**
     * Tidak digunakan, tapi biarkan ada
     */
    public function toArray(object $notifiable): array
    {
        return [];
    }
}