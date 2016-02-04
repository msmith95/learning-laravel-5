<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
	/**
	 * Creates the view to show all articles associated with
	 * the specified tag
	 * @param  string $name Tag name
	 * @return view
	 */
    public function show($name){
    	$articles = Tag::where('name', $name)->firstOrFail()->articles()->published()->get();

    	return view('articles.index', compact('articles'));
    }
}
