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
		$validator = Validator::make(
				Input::all(),
				array(
					'id' => 'required',
					'cardid' => 'required',
					'email' => 'unique:users,email',
					// 'firstname'  => 'required',
					// 'lastname'  =>'required',
					'password' => 'confirmed',
					'password_confirmation'  => 'required', 
					'code' => 'required',
				)
			);
	
			if ($validator->fails())
			{
				return Redirect::to('/#register')
					->withInput()
					->with('register_message','Register unsuccesfull. Please try again.')
					->withErrors($validator);
			}


		$profile = new Profile;

		$spark = new Spark;

		$spark->value = 100;

		$spark->save();

		$profile->spark_id = $spark->id;

		$profile->save();

		$user = new User;

		$user->email = Input::get('email');

		$user->firstname = 'Manu';

		$user->lastname = 'Labarbe';

		$user->status = 1;

		$user->profile_id = $profile->id; 

		$user->password = Hash::make(Input::get('password'));

		$user->save();

		$email = $user->email;
		$password = Input::get('password');

			if (Auth::attempt(array('email' => $email, 'password' => $password)	))
			{
					
		    return Redirect::to('profile/create');

			}
		    
		    return Redirect::to('/#register')->with('register_message', 'Register unsuccesfull, please try again.')->withErrors($validator)->withInput();
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