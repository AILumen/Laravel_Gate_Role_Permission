<?php

namespace App\Http\Controllers;
use App\Post;
use Illuminate\Http\Request;
use Gate;
use App\Http\Requests\UpdatePost as UpdatePostRequest;
use App\Http\Requests\StorePost as StorePostRequest;
use Auth;


class PostController extends Controller
{
    public function index()
	{
	    $posts = Post::published()->paginate();
	    return view('posts.index', compact('posts'));
	}

	public function create()
	{
    	return view('posts.create');
	}

	public function store(StorePostRequest $request)
	{
		// dd($request->all());
	    $data = $request->only('title', 'body');
	    $data['slug'] = str_slug($data['title']);
	    $data['user_id'] = Auth::user()->id;
	    // dd($data);
	    $post = Post::create($data);
	    return redirect()->route('edit_post', ['id' => $post->id]);
	}

	public function edit(Post $post)
	{
	    return view('posts.edit', compact('post'));
	}

	public function update(Post $post, UpdatePostRequest $request)
	{
	    $data = $request->only('title', 'body');
	    $data['slug'] = str_slug($data['title']);
	    $post->fill($data)->save();
	    return back();
	}

	public function publish(Post $post)
	{
	    $post->published = true;
	    $post->save();
	    return back();
	}

	public function show($id)
	{
	    $post = Post::published()->findOrFail($id);
	    return view('posts.show', compact('post'));
	}

	public function drafts()
	{
	    $postsQuery = Post::unpublished();
	    if(Gate::denies('see-all-drafts')) {
	        $postsQuery = $postsQuery->where('user_id', Auth::user()->id);
	    }
	    $posts = $postsQuery->paginate();
	    return view('posts.drafts', compact('posts'));
	}


}
