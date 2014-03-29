<?php

class FundController extends \BaseController {
	
	public function postFund()
	{
		$user_id = Auth::user()->id;
		$input = Input::all();
		$project = Project::find($input['project_id']);
		$profile_id = User::find($user_id)->profile_id;
		$fund = New Fund;
		$fund->total += $input['value'];
		$fund->save();
		$fund->projects()->attach($fund_id);
		$fund->projects()->save();
		$project->fund_id = $fund->id;
		$project->save();
		return Redirect::back()->with('message','Thanks for funding!');
	}

}