<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	/**
	 * The attributes that are mass assignable
	 * @var array
	 */
	protected $fillable = [
		'name'
	];
	/**
	 * Gets the articles associated with this tag
	 * @return array
	 */
    public function articles(){
    	return $this->belongsToMany('App\Article');
    }
}