<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'layouts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type', 'value'];

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
}
