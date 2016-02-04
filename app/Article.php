<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	/**
	 * Sets the mass assignable properties
	 * @var String Array
	 */
    protected $fillable = [
    	'title',
    	'body',
    	'published_at',
    ];
    /**
     * Sets the properties to be treated as
     * carbon instances
     * @var array
     */
    protected $dates = ['published_at'];

    // Scope, requires query builder $query
    /**
     * Sets a scope to retrieve articles that
     * are published
     * @param  QueryBuilder $query
     * @return Query
     */
    public function scopePublished ($query)
    {
    	$query->where('published_at', '<=', Carbon::now());
    }
    /**
     * Sets a scope to retrieve articles that
     * are unpublished
     * @param  QueryBuilder $query
     * @return Query
     */
    public function scopeUnpublished ($query)
    {
    	$query->where('published_at', '>=', Carbon::now());
    }
    // set {Name of Attribute}Attribute for mutator
    /**
     * Sets the published at attribute to an
     * instance of carbon upon creation
     * @param String $date
     */
    public function setPublishedAtAttribute($date)
    {
    	$this->attributes['published_at'] = Carbon::parse($date);
    }
    /**
     * Ensures that a carbon instance is always returned
     * for the published at attribute even if published at
     * is null
     * @param  String $date
     * @return Carbon
     */
    public function getPublishedAtAttribute($date){
    	return new Carbon($date);
    }
    //Function name must be same name as forign key unless otherwise specified (user -> user_id)
    /**
     * Gets the user that is associated with the article
     * @return User
     */
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    //Need to add timestamps ->withTimestamps()
    /**
     * Gets the collection fo tags associated with the article
     * @return array
     */
    public function tags(){
    	return $this->belongsToMany('App\Tag');
    }
    /**
     * Gets a list of associated tags by their id
     * Used as part of the form model binding to set
     * the selected tags
     * @return Array
     */
    public function getTagListAttribute(){
    	return $this->tags->lists('id')->all();
    }
}
