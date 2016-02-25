<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
    protected $fillable = ['uuid', 'name', 'address', 'address_comp', 'phone', 'email', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * An organization belongs to an Subscription
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subscription()
    {
        return $this->hasOne('App\Subscription');
    }

    /**
     * An organization belongs to an user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * An organization has many groups
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function groups()
    {
        return $this->hasMany('App\OsjsGroup');
    }

    /**
     * An organization has many users
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\OsjsUser');
    }

    /**
     * An organization has one website
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function website()
    {
        return $this->hasOne('App\Website');
    }

    /**
     * An organization has one crm
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function crm()
    {
        return $this->hasOne('App\Crm');
    }

}
