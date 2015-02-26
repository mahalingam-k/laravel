<?php

class UserController extends \BaseController {

    private $icon = 'users';
	const RESULTS_PER_PAGE = 10;

    public function __construct()
    {
        $this->beforeFilter('auth');
    }

    /**
     * Display a listing of the user.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::where('is_deleted', 0)
		->orderBy('last_logged_in_time', 'desc')->get();
		
		//$resultsAsArray = $this->getUserStats($users);
	
		$_SESSION["currentlink"] = 5;
		$this->preparePaginationArray($users);
		return $this->getPagination(1,'aa','');
		
        //return View::make('user.index', ['pagination' => $datas[0] ,'highlightLink' => 'aa', 'users' => $datas[1], 'userEmails' => $resultsAsArray[0], 'userDownloads' => $resultsAsArray[1] , 'visitsPerMonth' => $resultsAsArray[2] ,'searchedUser'=>'','icon' => $this->icon]);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('user.create');
		
		$_SESSION["currentlink"] = 5;
    }

    /**
     * Store a newly created user in storage.
     *
     * @return Response
     */
    public function store()
    {
        $user = new User;

        $user->first_name = Input::get('first_name');
        $user->last_name  = Input::get('last_name');
        $user->username   = Input::get('username');
        $user->email      = Input::get('email');
        $user->password   = Hash::make(Input::get('password'));
	
		$user->role = Input::get('role');
        $user->save();
		
		$usernotification = UserNotification::where('notification_code', 7)->get();
			
			$valuesArray = array();
			if(count($usernotification) == 1)
			{
				$msg = $usernotification[0]->message;
				if($msg != '')
				{
					
					$valuesArray['email'] = $user->email;
					$valuesArray['viewpage'] = 'emails.welcome';
					$valuesArray['subject'] = $usernotification[0]->subject;
					$valuesArray['confirmation_code'] = $user->confirmation_code;
					$valuesArray['to1'] = $user->email;
					
					
					if($user->username !=null)
					{
						$valuesArray['to2'] = $user->username;
					}
					else
					{
						$valuesArray['to2'] = '';
					}
					$usernotification[0]->prepareMailContent($msg,$valuesArray);
				}
				else
				{
					$userNotification = new UserNotification();	
					$msg = '<h1>Hi, {{email}}!</h1>
	 
	<p>We\'d like to personally welcome you to the Mistminds Application. Thank you for registering!</p>';
					
					$valuesArray['email'] = $user->email;
					$valuesArray['viewpage'] = 'emails.welcome';
					$valuesArray['subject'] = 'Welcome to the Mistminds Application!';
					$valuesArray['confirmation_code'] = $user->confirmation_code;
					$valuesArray['to1'] = $user->email;
					if($user->username !=null)
					{
						$valuesArray['to2'] = $user->username;
					}
					else
					{
						$valuesArray['to2'] = '';
					}
					
					$userNotification->prepareMailContent($msg,$valuesArray);
				}
			}
			else
			{
				$userNotification = new UserNotification();	
				$msg = '<h1>Hi, {{email}}!</h1>
 
<p>We\'d like to personally welcome you to the Mistminds Application. Thank you for registering!</p>';
				
				$valuesArray['email'] = $user->email;
				$valuesArray['viewpage'] = 'emails.welcome';
				$valuesArray['subject'] = 'Welcome to the Mistminds Application!';
				$valuesArray['confirmation_code'] = $user->confirmation_code;
				$valuesArray['to1'] = $user->email;
				if($user->username !=null)
				{
					$valuesArray['to2'] = $user->username;
				}
				else
				{
					$valuesArray['to2'] = '';
				}
				
				$userNotification->prepareMailContent($msg,$valuesArray);
			}	
		 /*
		 Mail::send('emails.welcome', array('firstname'=>$user->first_name), function($message) 
		{
			$message->to(Input::get('email'), Input::get('first_name'))->subject('Welcome to the Mistminds Application!');
		});  */
     
		$_SESSION["currentlink"] = 5;
		return Redirect::to('/admin/user');
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::find($id);

		
		$_SESSION["currentlink"] = 5;       
	   return View::make('user.edit', ['user' => $user ]);
    }

    /**
     * Update the specified user in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $user = User::find($id);

        $user->first_name = Input::get('first_name');
        $user->last_name  = Input::get('last_name');
        $user->username   = Input::get('username');
        $user->email      = Input::get('email');
        $user->password   = Hash::make(Input::get('password'));

        $user->save();
		
        
		$_SESSION["currentlink"] = 5;
		return Redirect::to('/admin/user');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        User::destroy($id);
		
		$_SESSION["currentlink"] = 5;
        return Redirect::to('/admin/user');
    }
	
	public function searchUsers()
	{
		log::info('Inside searchusers method');
		$user = Input::get('getUserName');
		log::info($user);
		
		if($user=='')
		{
			$users = User::where('is_deleted', 0)->get();
		}
		else
		{
			$users = User::where('email','LIKE', '%'.$user.'%')
			->where('is_deleted', 0)->get();
		}
		
		//$resultsAsArray = $this->getUserStats($users);
		
		$_SESSION["currentlink"] = 5;
		
		$this->preparePaginationArray($users);
		return $this->getPagination(1,'aa',$user);
		//return View::make('user.index', ['highlightLink' => 'aa','users' => $users,'userEmails' => $resultsAsArray[0], 'userDownloads' => $resultsAsArray[1] , 'visitsPerMonth' => $resultsAsArray[2], 'searchedUser'=>$user, 'icon' => $this->icon]);		
	}
	
	public function banUser($userId=0)
	{
	//session_start();
		
		log::info('inside banuser');
		$user = User::find($userId);
		$msg = '';
		if($user->is_banned == 1)
		{
			$msg = 'User is already banned';
		}
		else
		{
			$user->is_banned = 1;
			$user->save();
			
			$usernotification = UserNotification::where('notification_code', 6)->get();
			log::info($usernotification);
			if(count($usernotification) == 1)
			{
				$msg = $usernotification[0]->message;
				if($msg != '')
				{
					//$sub = $usernotification[0]->subject;
					$valuesArray = array();
					$valuesArray['email'] = $user->email;
					$valuesArray['viewpage'] = 'emails.banningconfirmation';
					$valuesArray['subject'] = $usernotification[0]->subject;
					//$valuesArray['confirmation_code'] = $user->confirmation_code;
					$valuesArray['to1'] = $user->email;
					
					if($user->username !=null)
					{
						$valuesArray['to2'] = $user->username;
					}
					else
					{
						$valuesArray['to2'] = '';
					}
					$usernotification[0]->prepareMailContent($msg,$valuesArray);
				}
				else
				{
					$data = array('email'=>$user->email);
				
					Mail::send('emails.banningconfirmation', $data, function($message) use($user)
					{
						$message->to($user->email, $user->email)->subject('Mistminds Account Ban Confirmation');
						
					});
				}
			}
			else
			{
				$data = array('email'=>$user->email);
				
				Mail::send('emails.banningconfirmation', $data, function($message) use($user)
				{
					$message->to($user->email, $user->email)->subject('Mistminds Account Ban Confirmation');
Mistminds					
				});
			}
			
			$msg = 'User is banned successfully';
		}
		
		
		Session::flash('ban', $msg);
		//session_start();
		$_SESSION["currentlink"] = 5;
		return Redirect::to('/admin/user');
		//return Redirect::to('login')->with('flash', 'Your password has been reset');
	}
	
	public function deleteUser($userId=0)
	{
		log::info('inside deleteuser');
		$user = User::find($userId);
		$user->is_deleted = 1;
		$user->email = 'deleted_'.$user->email;
		$user->save();
		
		$users = User::where('is_deleted', 0)->get();
		
	//	$resultsAsArray = $this->getUserStats($users);
		//session_start();
		$_SESSION["currentlink"] = 5;
		$this->preparePaginationArray($users);
		return $this->getPagination(1,'aa','');
        return View::make('user.index', ['highlightLink' => 'aa','users' => $users, 'userEmails' => $resultsAsArray[0], 'userDownloads' => $resultsAsArray[1] , 'visitsPerMonth' => $resultsAsArray[2] ,'searchedUser'=>'','icon' => $this->icon]);
	}
	
	public function searchByCharacter($searchedCharacter = null)
	{
		$users = User::where('email','LIKE', $searchedCharacter.'%')
			->where('is_deleted', 0)->get();
	//	$resultsAsArray = $this->getUserStats($users);
		//session_start();
		$_SESSION["currentlink"] = 5;
		
		$this->preparePaginationArray($users);
		return $this->getPagination(1,$searchedCharacter,'');
	//	return View::make('user.index', ['highlightLink' => $searchedCharacter,'users' => $users,'userEmails' => $resultsAsArray[0], 'userDownloads' => $resultsAsArray[1] , 'visitsPerMonth' => $resultsAsArray[2], 'searchedUser'=>'', 'icon' => $this->icon]);		
			/*
		//log::info('Inside searchByCharacter');
		$searchedCharacter = $_GET["val"];
		//log::info($searchedCharacter);
		$users = User::where('email','LIKE', $searchedCharacter.'%')
			->where('is_deleted', 0)->get();
			$resultsAsArray = $this->getUserStats($users);
			$finalArray = array();
			$finalArray[0] = $users;
			$finalArray[1] = $resultsAsArray[0];
			$finalArray[2] = $resultsAsArray[1];
			$finalArray[3] = $resultsAsArray[2];
			 return json_encode($finalArray);
		
		//return View::make('user.index', ['highlightLink' => $searchedCharacter,'users' => $users,'userEmails' => $resultsAsArray[0], 'userDownloads' => $resultsAsArray[1] , 'visitsPerMonth' => $resultsAsArray[2], 'searchedUser'=>'', 'icon' => $this->icon]);	
		*/
	}
	
	public function getUserStats($users)
	{
		$userEmails = array();
		$userDownloads = array();
		$visitsPerMonth = array();
		foreach($users as $usr)
		{
			$emails = Statistics::where('action','Emailed')
			->where('user_id',$usr->id)->get();
			$userEmails[$usr->id] = count($emails);
			
			$downloads = Statistics::where('action','Downloaded')
			->where('user_id',$usr->id)->get();
			$userDownloads[$usr->id] = count($downloads);
			
			$ts1 = strtotime($usr->created_at);
			$ts2 = strtotime(date('Y-m-d G:i:s'));

			$year1 = date('Y', $ts1);
			$year2 = date('Y', $ts2);

			$month1 = date('m', $ts1);
			$month2 = date('m', $ts2);

			$diff = (($year2 - $year1) * 12) + ($month2 - $month1);
			
			$visitsPerMonth[$usr->id] = ($usr->total_visits/($diff+1));
		}
		
		$finalArray = array();
		$finalArray[0] = $userEmails;
		$finalArray[1] = $userDownloads;
		$finalArray[2] = $visitsPerMonth;
		return $finalArray;
	}
	
	public function preparePaginationArray($users)
	{
		log::info('Inside preparePaginationArray');
		//log::info($users);
		$paginationArray = array();
		$paginationIndex = 1;
		$totalNrOfItems=0;
		$index = 0;
		$userParts = array();
		foreach($users as $idx => $user)
		{
			if($index != self::RESULTS_PER_PAGE)
			{
				$userParts[$idx] = $user;
			}
			else
			{
				$paginationArray[$paginationIndex] = $userParts;
				$userParts = array();
				$userParts[$idx] = $user;
				$paginationIndex++;
				$index = 0;
			}
			$index++;
			$totalNrOfItems++;
		}
		$paginationArray[$paginationIndex] = $userParts;
		log::info($totalNrOfItems);
		//log::info($paginationArray);
		//session_start();
		$_SESSION["paginationArray"] = $paginationArray;
	}
	
	public function paginate($pageNum) {
	
		//session_start();
		return $this->getPagination($pageNum,'aa','');
	}
	
	protected function getPagination($currentpg,$highlightLink,$searchedUser) {

        $paginationURL = '/admin/user/pagination/';
		$paginationArray = array();
		$paginationArray = $_SESSION["paginationArray"];
		$usersPart = $paginationArray[$currentpg];
		$startIndex = 1;
		$endIndex = 0;
		end($paginationArray);         
		$maxIndex = key($paginationArray); 
	
		if($currentpg>10)
		{
			$startIndex = $currentpg - 9;
			$endIndex = $currentpg;
		}
		else
		{
			if($maxIndex<10)
			{
				$endIndex = $maxIndex;
			}
			else
			{
				$endIndex = 10;
			}
		}
		
		$pagination = array();
		for($i = $startIndex; $i <= $endIndex ; $i++)
		{
			
			if($i==$currentpg)
			{
				$pagination[] = array(
					'cssClass' => ($currentpg == $i) ? 'active' : '',
					'link' => $paginationURL.$i,
					//'link' => $this->getLink(null, null, $i),
					'label' => '<font color="red"><u>'.$i.'</font></u>'
				);
			}
			else
			{
				$pagination[] = array(
					'cssClass' => ($currentpg == $i) ? 'active' : '',
					'link' => $paginationURL.$i,
					//'link' => $this->getLink(null, null, $i),
					'label' => '<font color="black">'.$i.'</font>'
				);
			}
			
			
		}
		
		//log::info($pagination);
		$resultsAsArray = $this->getUserStats($usersPart);
		return View::make('user.index', ['pagination' => $pagination ,'highlightLink' => $highlightLink, 'users' => $usersPart, 'userEmails' => $resultsAsArray[0], 'userDownloads' => $resultsAsArray[1] , 'visitsPerMonth' => $resultsAsArray[2] ,'searchedUser'=>$searchedUser,'icon' => $this->icon]);
		//return View::make('user.index', ['pagination' => $pagination ,'stats' => $statsPart, 'st_date' =>$s_date, 'end_date' =>$e_date]);
	}

}