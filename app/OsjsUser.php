<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class OsjsUser extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'osjs_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'name', 'password', 'groups', 'settings'];

    public function organization()
    {
        return $this->belongsTo('App\Organization');
    }

    public function groups()
    {
        return $this->belongsToMany('App\OsjsGroup', 'osjs_users_groups', 'osjs_group_id', 'osjs_user_id');
    }

}
