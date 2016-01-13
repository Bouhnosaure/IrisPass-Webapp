<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'outlets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [''];

    /*
     * Relations
     */

    public function organization()
    {
        return $this->belongsTo('App\Organization');
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public function layouts()
    {
        return $this->hasMany('App\Layout');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

}
