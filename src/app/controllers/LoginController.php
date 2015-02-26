<?php

class LoginController extends BaseController {

    public function getIndex($from=0)
    {
        // check if user is logged - display login form if not, or redirect to admin if he is
		log::info('get index of login controller');
		log::info($from);
        if (Auth::check())
        {
            return Redirect::to('/admin');
        }

        return View::make('user.login', array('from' => $from));
    }

    public function postIndex()
    {
        log::info('Inside postIndex of LoginController');
		
		//$username = Input::get('emailsignin');
		$username = $_POST['email'];
		log::info($username);
        //$password = Input::get('regpassword');
		$password = $_POST['pwd'];
		
       /* if (Auth::attempt(['username' => $username, 'password' => $password]))
        {
			log::info('Inside if of post index');
			if(Auth::user()->role == '1')
			{
				return Redirect::intended('/admin');
			}
			else
			{
				return Redirect::intended('/');
			} 
			
			
        }*/
		
		/* if($username == '' || $password == '')
		{
			return Redirect::back()
				->withInput()
				->withErrors('Please enter email and password.');
		} */
		
		if (Auth::attempt(['email' => $username, 'password' => $password, 'is_banned' => 0, 'is_deleted'=>0, 'confirmed' => 1]))
		{
			
			$user = Auth::user();
			
			$user->last_logged_in_time = date('Y-m-d G:i:s',time());
			$user->total_visits = $user->total_visits + 1;
			$user->save();
			return "success";	
		}
		
		if (Auth::attempt(['email' => $username, 'password' => $password, 'is_banned' => 0, 'is_deleted'=>0, 'confirmed' => 0]))
		{
			Auth::logout();
			return "notconfirmed";
			
		/*	return Redirect::back()
            ->withInput()
            ->withErrors('You have not confirmed your registration.Please check your email and confirm.'); */
		}
		if (Auth::attempt(['email' => $username, 'password' => $password, 'is_banned' => 1, 'is_deleted'=>0]))
		{
			Auth::logout();
			return "banned";
		}
        return "invalidcredentials";
		/*return Redirect::back()
            ->withInput()
            ->withErrors('That username/password combo does not exist.'); */
    }

    public function getLogin()
    {
        log::info('Inside getLogin of LoginController');
		return Redirect::to('/');
    }

    public function getLogout()
    {
        Auth::logout();

        return Redirect::to('/');
    }

}