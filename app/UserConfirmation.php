<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UserConfirmation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users_confirmations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type', 'confirmation_code'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
