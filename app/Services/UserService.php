<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\EmailNotification;
use App\Notifications\SmsNotification;

class UserService
{
    public function createUser(array $data): void
    {
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];

        $user->save();
        $user->refresh();

        $user->countries()->sync([$data['country_id']]);
        $user->phoneBook()->create([
            'phone' => $data['phone']
        ]);

        $user->notify(new SmsNotification());
        $user->notify(new EmailNotification());
    }
}
