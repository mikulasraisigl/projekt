<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;

class EventPolicy
{
    /**
     * Determine whether the user can view any events.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return true; // Umožní všem uživatelům zobrazit seznam událostí
    }

    /**
     * Determine whether the user can view a specific event.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event
     * @return bool
     */
    public function view(User $user, Event $event)
    {
        return true; // Umožní všem uživatelům zobrazit detaily události
    }

    /**
     * Determine whether the user can create events.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->role === 'admin'; // Umožní vytvářet události pouze adminům
    }

    /**
     * Determine whether the user can update the event.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event
     * @return bool
     */
    public function update(User $user, Event $event)
    {
        // Uživatel může upravit pouze své vlastní události nebo pokud je admin
        return $user->id === $event->user_id || $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the event.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event
     * @return bool
     */
    public function delete(User $user, Event $event)
    {
        // Uživatel může smazat pouze své vlastní události nebo pokud je admin
        return $user->id === $event->user_id || $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the event.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event
     * @return bool
     */
    public function restore(User $user, Event $event)
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the event.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event
     * @return bool
     */
    public function forceDelete(User $user, Event $event)
    {
        return $user->role === 'admin';
    }
}
