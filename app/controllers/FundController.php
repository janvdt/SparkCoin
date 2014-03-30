<?php

class FundController extends \BaseController {
	
	public function postFund()
	{

		$validator = Validator::make(
				Input::all(),
				array(
					'value' => 'required',
					
				)
			);

		// If the validation fails.
		if ($validator->fails()) {
			// If it was an ajax upload, send an error message in json format.
			if (Input::get('ajax')) {
				return Response::json(array('error' => 'true'));
			}

			// Else redirect back to the File Manager creation form.
			return Redirect::back()
				->withErrors($validator)
				->with('new_file_error', true);
		}

		$project = Project::find(Input::get('projectid'));


		

		DB::table('projects')->where('id',$project->id)->increment('total', Input::get('value'));

		Notification::insert(array('body' => "Sparked your project!",'user_id' => Auth::user()->id,'project_id' => $project->id,'project_creator' => $project->profile_id,"type" => 3,'created_at' => date("Y-m-d H:i:s")));
		
		if($project->profile_id != Auth::user()->profile_id){
		Notification::insert(array('body' => "Sparked your project!",'user_id' => Auth::user()->id,'project_id' => $project->id,'project_creator' => $project->profile_id,"type" => 3,'created_at' => date("Y-m-d H:i:s")));
		}

		$user_id = Auth::user()->id;
		$input = Input::all();
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
		


		$value = Input::get('value');

			if (Input::get('ajax')) {
			

			$response = array(
				'total'    => $fund->total
				
			);

			return Response::json($response);
		}

	}

}