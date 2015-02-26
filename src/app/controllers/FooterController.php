<?php

class FooterController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}
	
	public function remind()
	{
		log::info('inside remind method');
		return View::make('password.remind');
	}
 
	public function request()
	{
	  log::info('inside request method');
	  $credentials = array('email' => Input::get('email'));
	 $user=User::where('email', Input::get('email'))
	 ->where('is_banned' , 0)
	  ->where('is_deleted' , 0)
	   ->where('confirmed' , 1)->get(); 
	   
	  if (count($user)==1)
	 {
		Auth::logout();
		return Password::remind($credentials,function($message)
		{
			$message->subject('Password Reset Notification');
		});
	 }
	 else
	 {
		return "invaliduser";
	 }
	  /*$usernotification = UserNotification::where('notification_code', 4)->get();
	$msg = '';
	$valuesArray = array();
	if(count($usernotification) == 1)
	{
		$msg = $usernotification[0]->message;
		
		
		//$valuesArray['firstname'] = $user->email;
		//$valuesArray['viewpage'] = 'emails.welcome';
		$valuesArray['subject'] = $usernotification[0]->subject;
		//$valuesArray['to1'] = Input::get('email');
		//$valuesArray['to2'] = Input::get('first_name');
		//$usernotification[0]->prepareMailContent($msg,$valuesArray);
		
		preg_match_all("/{{(.*?)}}/", $msg, $valuesArray);
	//	log::info($results);
		foreach($valuesArray[1] as $res)
		{
			if($res=='firstname')
			{
				$msg =  str_replace('{{firstname}}',$valuesArray['firstname'],$msg);
			}
		}
		log::info('inside customtemplate');
		log::info($msg);
		return Password::remind($credentials, array('template'=>$msg,'customtemplate' => 0) ,function($message) use($valuesArray)
		{
			$message->subject($valuesArray['subject']);
		});
		
		/* Mail::send($valuesArray['viewpage'], array('template'=>$message), function($message) use($valuesArray) 
		{
			$message->to($valuesArray['to1'], $valuesArray['to2']);
			$message->subject($valuesArray['subject']);
		}); 
	}
	else
	{
		
		
	} */
	}
 
	public function reset($token)
	{
	  log::info('inside reset method');
	  return View::make('password.reset')->with('token', $token);
	}
	
	public function update()
	{
	  log::info('Inside update method of PasswordController');
	 // $credentials = array('email' => Input::get('email'), 'password' => Input::get('password'), 'password_confirmation' => Input::get('password_confirmation'), 'token' => Input::get('token'));
	 $eml = Input::get('email');
	 $pwd = Input::get('password');
	 $confpwd = Input::get('password_confirmation');
	 if($eml =='' || $pwd == '' || $confpwd == '')
	 {
	 return Redirect::back()
            ->withInput()
            ->withErrors('Please enter all the values.');
		}
		else if($pwd != $confpwd)
		{
			return Redirect::back()
            ->withInput()
            ->withErrors('Password and Confirm Password does not match.');
		}
		else{
			$credentials = array('email' => $eml, 'password' => $pwd, 'password_confirmation' => $confpwd, 'token' => Input::get('token'));
			 
			  return Password::reset($credentials, function($user, $password)
			  {
				$user->password = Hash::make($password);
			 
				$user->save();
			 log::info('End of update method');
				return Redirect::to('/');
			  });
		}
	 
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
	/* public function update($id)
	{
		//
	} */


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

	public function openAboutPage()
	{
		$footer = Footer::where('type', 'about')->get();
		log::info($footer);
		return View::make('search.about', [ 'footer' => $footer ]);
	}
	
	public function openTermsAndConditionsPage()
	{
		$footer = Footer::where('type', 'termsandconditions')->get();
		log::info($footer);
		return View::make('search.termsandconditions', [ 'footer' => $footer ]);
	}
	
	public function openHelpPage()
	{
		$footer = Footer::where('type', 'help')->get();
		log::info($footer);
		return View::make('search.help', [ 'footer' => $footer ]);
	}

}
