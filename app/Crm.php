<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Crm extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'crms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['identifier', 'is_active', 'url'];

    protected $casts = [
        'is_active' => 'boolean'
    ];


    public function organization()
    {
        return $this->belongsTo('App\Organization', 'organization_id');
    }

}
