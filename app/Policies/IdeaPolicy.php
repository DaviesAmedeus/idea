<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Idea;
use App\Models\User;

class IdeaPolicy
{

    public function workWith(User $user, Idea $idea)
    {
        return $idea->user->is($user);
    }


}
