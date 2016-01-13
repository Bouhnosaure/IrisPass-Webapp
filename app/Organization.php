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
    protected $fillable = ['name', 'phone', 'mail', 'website', 'address', 'status', 'owner', 'siret_number', 'siren_number', 'tva_number', 'kbis_number', 'ape_number'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [''];

    /*
     * Relations
     */

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function outlets()
    {
        return $this->hasMany('App\Outlet');
    }

    public function licence()
    {
        return $this->belongsTo('App\Licence');
    }

}
