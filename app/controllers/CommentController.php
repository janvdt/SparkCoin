<?php

class CommentController extends \BaseController {

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
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$user = Auth::user();
		$profile_id = Profile::find($user->profile_id)->id;
		$validator = Validator::make($input, Comment::$rules);
		if($validator->passes()){
			$comment = New Comment;
			$comment->project_id = $input['project_id'];
			$comment->parent = 0;
			$comment->profile_id = $profile_id;
			$comment->body = $input['body'];
			$comment->save();
			return Redirect::to('projects/'.$comment->project_id)->with('message','Your comment was posted!.');
		}
		else{
			return Redirect::to('projects/'.$input['project_id'])->with('message','Please correct the following errors.')->withErrors($validator)->withInput();
		}

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