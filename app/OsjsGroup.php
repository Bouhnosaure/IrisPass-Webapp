<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class OsjsGroup extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'osjs_groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'path'];


    public function organization()
    {
        return $this->belongsTo('App\Organization');
    }

    public function users()
    {
        return $this->belongsToMany('App\OsjsUser', 'osjs_users_groups', 'osjs_user_id', 'osjs_group_id');
    }

}
