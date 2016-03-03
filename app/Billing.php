<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'billings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['uuid', 'status', 'price', 'is_billed'];

    protected $casts = [
        'is_billed' => 'boolean'
    ];

    /**
     * An billing belongs to an Subscription
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subscription()
    {
        return $this->belongsTo('App\Subscription', 'subscription_id');
    }

    /**
     * An billing belongs to an organization
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organization()
    {
        return $this->belongsTo('App\Organization', 'organization_id');
    }


}
