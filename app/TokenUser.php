<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TokenUser extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'token', 'created_at', 'expired_at', 'updated_at', 'deleted_at'
    ];

    // Relation with user table
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('expired_at', function (Builder $builder) {
            $builder->where('expired_at', '>', now());
        });
    }
}
