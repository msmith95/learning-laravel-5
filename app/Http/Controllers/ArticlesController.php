<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\CreateArticleRequest;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
	/**
	 * Sets up the middleware for the controller
	 */
	function __construct() {
		$this->middleware('auth', ['only' => [
            'create',
            'edit',
            'destroy'
        ]]);
	}
	/**
	 * Displays the view for the index of the blog
	 * @return view
	 */
    public function index(){

    	$articles = Article::latest('published_at')->published()->get();

    	return view('articles.index', compact('articles'));
    }
    /**
     * @param  String id of the article to show
     * @return view
     */
    public function show($id){
    	$article = Article::published()->findOrFail($id);
    	$edit = true;

    	return view('articles.show', compact('article', 'edit'));
    }
    /**
     * Shows view to create an article
     * @return view
     */
    public function create()
    {
    	$tags = Tag::lists('name', 'id');
    	return view('articles.create', compact('tags'));
    }
    //Type cast CreateArticleRequest
    /**
     * Stores an article in the database
     * @param  CreateArticleRequest $request
     * @return view
     */
    public function store(CreateArticleRequest $request)
    {
    	//Extract to function
    	$tags = $request->input('tagList');
    	foreach ($tags as $key => $value) {
    		if (!is_numeric($value)) {
    			$newTag = Tag::create(['name' => $value]);
    			$tags[$key] = (string)$newTag->id;
    		}
    	}

    	$article = \Auth::user()->articles()->create($request->all());

    	$article->tags()->attach($tags);

    	\Session::flash('flash_message', 'Your article has been created!');

    	return redirect('articles');
    }
    /**
     * Shows the edit article view
     * @param  Integer $id Article Id
     * @return view
     */
    public function edit($id, Request $request)
    {
    	$article = Article::published()->findOrFail($id);
    	$tags = Tag::lists('name', 'id');

    	return view('articles.edit', compact('article', 'tags'));
    }
    /**
     * Updates an article in the database
     * @param  Integer  $id      Article Id
     * @param  Request $request
     * @return view
     */
    public function update($id, Request $request)
    {
    	$this->validate($request, [
            'title' => 'required|min:3',
            'body' => 'required',
            'published_at' => 'required|date'
        ]);

    	$article = Article::findOrFail($id);

    	$article->update($request->all());
    	$article->tags()->sync((!$request->input('tag_list') ? [] : $request->input('tag_list')));

    	\Session::flash('flash_message', 'Your article has been updated');
    	return redirect('articles');
    }
    /**
     * Removes an article from the database
     * @param  Request $request
     * @param  Integer  $id      Article Id
     * @return view
     */
    public function destroy(Request $request, $id){
    	$article = Article::findOrFail($id);
    	if(\Auth::user()->id == $article->user_id){
    		$article->delete();
    		\Session::flash('flash_message', 'Your article has been deleted');
    		return redirect('articles');
    	}else{
    		abort(404);
    	}
    }
}