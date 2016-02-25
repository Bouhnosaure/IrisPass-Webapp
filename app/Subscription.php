<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subscriptions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['category', 'price_base', 'price_current', 'values', 'last_billing_uuid', 'date_end', 'is_active'];

    protected $casts = [
        'attributes' => 'json',
        'is_active' => 'boolean'
    ];

    /**
     * An subscriptions has many billings
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function billings()
    {
        return $this->hasMany('App\Billing');
    }

    /**
     * An subscription has one organization
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function organization()
    {
        return $this->belongsTo('App\Organization', 'organization_id');
    }


}
