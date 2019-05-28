<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'desc', 'created_by', 'active', 'created_at', 'updated_at', 'updated_by', 'deleted_at'
    ];

    // Relation with user table
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
