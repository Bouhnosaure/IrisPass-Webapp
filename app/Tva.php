<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tva extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tvas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'rate'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [''];

    /*
     * Relations
     */

    public function prices()
    {
        return $this->hasMany('App\Price');
    }
}
