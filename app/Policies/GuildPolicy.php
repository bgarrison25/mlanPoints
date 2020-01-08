<?php

namespace App\Policies;

use App\Guild;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GuildPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->is_admin) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any guilds.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the guild.
     *
     * @param  \App\User  $user
     * @param  \App\Guild  $guild
     * @return mixed
     */
    public function view(User $user, Guild $guild)
    {
        return true;
    }

    /**
     * Determine whether the user can create guilds.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the guild.
     *
     * @param  \App\User  $user
     * @param  \App\Guild  $guild
     * @return mixed
     */
    public function update(User $user, Guild $guild)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the guild.
     *
     * @param  \App\User  $user
     * @param  \App\Guild  $guild
     * @return mixed
     */
    public function delete(User $user, Guild $guild)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the guild.
     *
     * @param  \App\User  $user
     * @param  \App\Guild  $guild
     * @return mixed
     */
    public function restore(User $user, Guild $guild)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the guild.
     *
     * @param  \App\User  $user
     * @param  \App\Guild  $guild
     * @return mixed
     */
    public function forceDelete(User $user, Guild $guild)
    {
        return false;
    }
}
