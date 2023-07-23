<?php

namespace App\Broadcasting;

use App\Models\Room;
use App\Models\User;

class TictactoeChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Room  $room
     * @return array|bool
     */
    public function join(User $user, Room $room)
    {
        return $user->id == $room->user1_id or $user->id == $room->user2_id;
    }
}
