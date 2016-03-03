<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{

    use HasRoles;

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

    /**
     * An user has one profile
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function apps()
    {
        return $this->hasOne('App\UserApp');
    }

    /**
     * An user has one organization
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function organization()
    {
        return $this->hasOne('App\Organization');
    }

    /**
     * An os js user can be in many groups
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany('App\OsjsGroup', 'groups_users_pivot', 'user_id', 'group_id')->withTimestamps();
    }
}
