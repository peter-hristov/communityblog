<?php

class PostController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//return Response::json(array('name' => 'Steve', 'state' => 'CA'));
		$data = Post::paginate(2);

		return View::make('post.index')->with(compact('data'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if (!Auth::check()) {
			return Redirect::route('user.login');
		}

		return View::make('post.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if (!Auth::check()) {
			return Redirect::route('user.login');
		}

		$input = Input::only('title', 'body');

		$input['user_id'] = 1;

		Post::create($input);

		return Redirect::route('post.index');
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if (!Auth::check()) {
			return Redirect::route('user.login');
		}

		$post = Post::find($id);

		return View::make('post.edit')->with(compact('post'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if (!Auth::check()) {
			return Redirect::route('user.login');
		}

		$input = Input::only('title', 'body');
		$post = Post::find($id);

		if (isset($post)) {
			$post->update($input);
		}

		return Redirect::route('post.index');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if (!Auth::check()) {
			return Redirect::route('user.login');
		}

		Post::destroy($id);
		return Redirect::route('post.index');
	}


}
