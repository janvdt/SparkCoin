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

		$project = Post::find($id);

		Like::insert(array('post_id' => $post->id,'user_id' => Auth::user()->id));

		DB::table('posts')->where('id',$post->id)->increment('postlikes');
		
		Notification::insert(array('body' => "liked your post!",'user_id' => Auth::user()->id,'post_id' => $post->id,'post_creator' => $post->created_by,"type" => 3,'created_at' => date("Y-m-d H:i:s")));
		
		if($post->created_by != Auth::user()->id){
		Notification::insert(array('body' => "liked a post!",'user_id' => Auth::user()->id,'post_id' => $post->id,'post_creator' => $post->created_by,'activity' => 1, 'type' => 3,'created_at' => date("Y-m-d H:i:s")));
		}

		if(Auth::user())
		{
			if($post->created_by != Auth::user()->id)
			{	
				$user = User::find($post->created_by);
				DB::table('totalpoints')->where('account_id',$user->accountUser()->id)->increment('value');
				if($user->accountuser()->points->value < 100)
				{
					DB::table('points')->where('account_id',$user->accountUser()->id)->increment('value');
				}
				else
				{
					if($user->accountuser()->levels->first()->id != 5)
					{
						$user = User::find($post->created_by);
						DB::table('account_level')->where('account_id',$user->accountUser()->id)->increment('level_id');
						DB::table('points')->where('account_id',$user->accountUser()->id)->update(array('value' => 1));
					}

				}
			}
		}

		return $id;

		$value = Input::get('value');

			if (Input::get('ajax')) {
			

			$response = array(
				'value'    => $value = Input::get('value')
				
			);

			return Response::json($response);
		}



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