<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('user.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$errors = User::tryStore(Input::only('email', 'username', 'password'));

		if ($errors === null ) {
			return Redirect::route('post.index');
        }

        else {
        	return Redirect::route('user.create')
            ->withInput()
            ->withErrors($errors)
            ->with('message', 'There were validation errors.');
        }
	}


	public function internalLogin()
	{
		$errors = User::tryLogin(Input::only('email', 'password'));

		if($errors === null) {
			return Redirect::route('post.index');
		}

		return Redirect::route('user.login')
		            ->withInput()
		            ->withErrors($errors)
		            ->with('message', 'There were validation errors.');
	}

	public function login()
	{

		return View::make('user.login');
	}

	public function logout()
	{
		Auth::logout();
		return Redirect::route('post.index');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$data = User::find($id);
		return View::make('user.show')->with(compact('data'));
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
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
