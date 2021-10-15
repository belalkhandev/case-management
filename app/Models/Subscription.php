<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'subscription_user', 'subscription_id', 'user_id');
    }

    public function subusers()
    {
        return $this->belongsToMany(User::class, 'subscription_user', 'subscription_id', 'user_id')->where('id', '!=', $this->user()->id);
    }

    public function attachUser($user)
    {
        if (is_object($user)) {
            $user = $user->getKey();
        }

        if (is_array($user)) {
            if(!isset($user['id'])) {
                return $this->attachUsers($user);
            }

            $user = $user['id'];
        }

        $this->subusers()->attach($user);
    }

    public function attachUsers($users)
    {
        foreach ($users as $user) {
            $this->attachUser($user);
        }
    }

    public function detachUser($user)
    {
        if (is_object($user)) {
            $user = $user->getKey();
        }
        if (is_array($user)) {
            if(!isset($user['id'])) {
                return $this->detachUsers($user);
            }

            $user = $user['id'];
        }

        $this->subusers()->detach($user);
    }


    public function detachUsers($users = null)
    {
        if (!$users) $users = $this->users()->get();
        foreach ($users as $user) {
            $this->detachUser($user);
        }
    }


}
