<?php

namespace App\Policies\Forum;

use App\Models\User;
use App\Models\Forum\Forum;
use Illuminate\Auth\Access\HandlesAuthorization;

class ForumPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function owner(User $user, Forum $forum)
    {
        return $user->id == $forum->user_id;
    }
}
