<?php

namespace App;

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
        'user_id', 'token', 'created_at', 'updated_at', 'deleted_at'
    ];

    // Relation with user table
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
