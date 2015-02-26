<?php

class AdminController extends BaseController {

    /**
     * Constructor
     **/
    public function __construct()
    {
        // TODO: check if user is logged in and redirect to login if not
    }

    public function getIndex()
    {
		log::info('Inside getIndex of AdminController');
		session_start();
		$_SESSION["currentlink"] = 0;
		if(Auth::user()->role == '1' || Auth::user()->role == '2')
		{
			$name = Auth::user()->getFullName();
			$user = Auth::user();
			$user->last_logged_in_time = date('Y-m-d G:i:s',time());
			$user->total_visits = $user->total_visits + 1;
			$user->save();
			return View::make('admin.index', ['fullname' => $name]);
		}
	}
	
	public function logout($username = null,$password = null)
	{
		Auth::logout();
		if (Auth::attempt(['email' => $username, 'password' => $password]))
		{
			
		}
		
	}

}
