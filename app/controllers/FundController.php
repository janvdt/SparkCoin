<?php

class FundController extends \BaseController {
	
	public function postFund()
	{
		$user_id = Auth::user()->id;
		$input = Input::all();
		$project = Project::find($input['project_id']);
		$profile_id = User::find($user_id)->profile_id;
		if(!empty($project->fund_id) | $project->fund_id != 0)
		{
			$fund = Fund::find($project->fund_id);
			$fund->total += $input['value'];
			$fund->save();
			$project->funds()->attach($fund->id, array('project_id'=>$input['project_id'],'profile_id'=>$profile_id,'fund_id'=>$fund->id));
		}
		else{
			$fund = New Fund;
			$fund->total = $input['value'];
			$fund->save();
			$project->funds()->attach($fund->id, array('project_id'=>$input['project_id'],'profile_id'=>$profile_id,'fund_id'=>$fund->id));
			$project->fund_id = $fund->id;
			$project->save();
		}
		return Redirect::back()->with('message','Thanks for funding!');
	}

}