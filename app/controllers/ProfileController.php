<?php

class ProfileController extends \BaseController {

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
		return View::make('user.profile.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user_id = Auth::user()->id;
		$profileid = User::find($user_id)->profile_id;
		$profile  = Profile::find($profileid);
		$profile->type = Input::get('type');
		$profile->description = Input::get('description');
		$profile->image_id = Input::get('image_id');
		
		$profile->save();

		
		return Redirect::to('/projects');

		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
	}

	public function getDashboard()
	{
		$user = Auth::user();
		$profile = Profile::find($user->profile_id);
		$projects = Project::where('profile_id',$profile->id)->take(3)->get();
		$numbernotificationsspark =  Notification::where('user_id',Auth::user()->id)->where('type',3)->count();

		return View::make('profile.show')
			->with('profile',$profile)
			->with('user',$user)
			->with('projects',$projects)
			->with('numbernotificationsspark',$numbernotificationsspark);
	}

	public function showYours()
	{
		$profile_id = Auth::User()->profile_id;
		$projects = Project::where('profile_id',$profile_id)->get();
		return View::make('profile.ownprojects')->with('projects', $projects);
	}

	public function yourProgress()
	{
		$profile_id = Auth::User()->profile_id;
		$profile = Profile::find($profile_id);
		
		return View::make('profile.dashboard.managespark')->with('profile',$profile);

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