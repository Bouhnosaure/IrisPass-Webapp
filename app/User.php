<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * An user can have many confirmations at the same time like sms or mails
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function confirmations()
    {
        return $this->hasMany('App\UserConfirmation');
    }

    /**
     * An user has one profile
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne('App\UserProfile');
    }
}
