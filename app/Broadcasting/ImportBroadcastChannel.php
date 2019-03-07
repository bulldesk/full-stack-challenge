<?php

namespace App\Broadcasting;

use App\User;
use App\Import;

class ImportBroadcastChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\User  $user
     * @param  integer  $import_id
     * @return array|bool
     */
    public function join(User $user, $import_id)
    {
        $import = Import::find($import_id);
        return $user->id == $import->created_by;
    }
}
