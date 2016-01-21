<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Organization extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'organizations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'address', 'address_comp', 'phone', 'email', 'is_active', 'max_users', 'date_start', 'date_end'];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    protected $dates = ['date_start', 'date_end'];

    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function groups()
    {
        return $this->hasMany('App\OsjsGroup');
    }

    public function users()
    {
        return $this->hasMany('App\OsjsUser');
    }

}
