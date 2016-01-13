<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

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

    public function outlet()
    {
        return $this->belongsTo('App\Outlet');
    }

    public function prices()
    {
        return $this->hasMany('App\Price');
    }

    public function category()
    {
        return $this->belongsTo('App\ProductCategory');
    }
}
