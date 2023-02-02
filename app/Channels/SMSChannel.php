<?php

namespace App\Channels;

use App\Facades\InfoRu;
use App\Models\User;
use App\Notifications\SmsNotification;

class SMSChannel
{
    public function send(User $notifiable, SmsNotification $notification): void
    {
        $message = $notification->toSMS($notifiable);

        if (InfoRu::isServiceEnabled()) {
            InfoRu::sendMessage($notifiable->phone, $message);
        }
    }
}
