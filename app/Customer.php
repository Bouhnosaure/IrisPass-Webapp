<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['firstname', 'lastname', 'email', 'phone', 'address', 'city', 'postal_code', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [''];

    /*
     * Relations
     */

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }

}
