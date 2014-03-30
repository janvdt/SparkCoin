<?php

class HomeController extends BaseController {

	public function index()
	{
		return View::make('splashpage');
	}

	public function postSignin()
	{
		if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')))) {
		    return Redirect::to('projects');
		} else {
		    return Redirect::to('/')
		        ->with('login_message', 'Password and username don\'t match')->withInput();
		}


	}

	public function postRegister()
	{
		
		$rules = array(
    		'email'=>'required|email|unique:users',
    		'password'=>'required|between:6,12|confirmed',
    		'password_confirmation'=>'required|between:6,12'
		);
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->passes()) {

		    $user = new User;
		    $user->email = Input::get('email');
		    $user->password = Hash::make(Input::get('password'));
		    
		    $user->save();
		    $password = $user->password;
		    if (Auth::attempt(array('email'=> $user->email, 'password'=> $password))) {
		    	return Redirect::to('profile/create')->with('message', 'You are succesfully registered!');
		} else {
		  
		        return Redirect::to('/#register')->with('register_message', 'Register unsuccesfull, please try again.')->withErrors($validator)->withInput();
		}
	}


	}

}