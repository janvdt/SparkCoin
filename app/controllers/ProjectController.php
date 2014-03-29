<?php

class ProjectController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$projects = Project::all();
		return View::make('projects.index')->with('projects',$projects);
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
			$project->expire_date = Carbon::now()->addMonths(1);
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