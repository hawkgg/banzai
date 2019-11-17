<?php

namespace App\Notificators;

use App\Models\User;

interface NotificatorInterface {
    public function send(User $user, string $text);
}
