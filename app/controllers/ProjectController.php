<?php

class ProjectController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$projects = Project::orderBy('created_at','DESC')->get();
		$type = null;
		return View::make('projects.index')->with('projects',$projects)->with('type',$type);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('projects.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validator = Validator::make($input, Project::$rules);
		if($validator->passes()){
			$project = New Project;
			$project->name = $input['name'];
			$project->description = $input['description'];
			$project->address = $input['address'];
			$project->zipcode = $input['zipcode'];
			$project->town = $input['town'];
			$project->country = $input['country'];

			$user = User::find(Auth::user()->id);
			$project->profile_id = $user->profile_id;

			$project->image_id = Input::get('image_id') ? Input::get('image_id'): 0;

			//$project->expire_date = Carbon::now()->addMonths(1);

			$project->save();
			return Redirect::to('projects/'.$project->id)->with('message','Your project was succesfully published!.')->with('project',$project);
		}
		else{
			return Redirect::to('projects/create')->with('message','Please correct the following errors.')->withErrors($validator)->withInput();
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
		$project = Project::find($id);
		$project->views += 1;
		$project->save();
		$fund_total = Fund::find($project->fund_id)->total;
		return View::make('projects.show')->with('project', $project)->with('fund_total',$fund_total);
	}

	public function showYours()
	{
		$profile_id = Auth::User()->profile_id;
		$project = Project::where('profile_id',$profile_id)->get();
		return View::make('projects.show')->with('project', $project);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$project = Project::find($id);
		return View::make('projects.edit')->with('project', $project);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::all();
		$validator = Validator::make($input, Project::$rules);
		if($validator->passes()){
			$project = Project::find($id);
			$project->name = $input['name'];
			$project->description = $input['description'];
			$project->address = $input['address'];
			$project->zipcode = $input['zipcode'];
			$project->town = $input['town'];
			$project->country = $input['country'];
			$project->save();
			return Redirect::to('projects/'.$id)->with('message','Your project was succesfully edited!.');
		}
		else{
			return Redirect::to('projects/create')->with('message','Please correct the following errors.')->withErrors($validator)->withInput();
		}
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

	public function sort($type)
	{
		$projects = Project::orderBy($type,'DESC')->get();
		return View::make('projects.index')->with('projects',$projects)->with('type', $type);
	}

}