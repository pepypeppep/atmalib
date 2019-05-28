<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'desc', 'created_by', 'active', 'created_at', 'updated_at', 'updated_by', 'deleted_at'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
