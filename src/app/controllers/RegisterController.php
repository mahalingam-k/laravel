<?php

class RegisterController extends \BaseController  {

	const RESULTS_PER_PAGE = 20;
	protected $currentPage = 0;

	
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
		log::info('Inside create method');
		return View::make('search.create');
	}
	
	public function register()
	{
		log::info('Inside register method');
		return View::make('search.create');
	}
	
	public function confirm($confirmation_code)
    {
        Session::flush();
		if( ! $confirmation_code)
        {
            throw new InvalidConfirmationCodeException;
        }

        $user = User::whereConfirmationCode($confirmation_code)->first();

        if ( ! $user)
        {
			Session::flash('from', '');
			Session::flash('alreadyconfirmed', 'yes');
			Session::flash('userconfirmed', 'no');
			return Redirect::to('/');
			//throw new InvalidConfirmationCodeException;
        }

        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();

		$usernotification = UserNotification::where('notification_code', 1)->get();
			log::info($usernotification);
			if(count($usernotification) == 1)
			{
				$msg = $usernotification[0]->message;
				if($msg != '')
				{
					//$sub = $usernotification[0]->subject;
					$valuesArray = array();
					$valuesArray['email'] = $user->email;
					$valuesArray['viewpage'] = 'emails.registrationconfirm';
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
					Mail::send('emails.registrationconfirm', $data, function($message) use($user) 
					{
						$message->to($user->email, $user->email)->subject('Confirmation of User registration in mistminds application');
						
					});
				}
			}
			else
			{
				$data = array('email'=>$user->email);
	
				Mail::send('emails.registrationconfirm', $data, function($message) use($user)
				{
					$message->to($user->email, $user->email)->subject('Confirmation of User registration in mistminds application');
					
				});
			}
       // Flash::message('You have successfully verified your account.');

        //return Redirect::route('/');
		
		Session::flash('from', 'fromexternallink');
		Session::flash('alreadyconfirmed', 'no');
		Session::flash('userconfirmed', 'yes');
		return Redirect::to('/');
    }


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		log::info('Inside store method');
		
		$email = $_POST["email"];
		$pwd = $_POST["pwd"];
		log::info($email);
		log::info($pwd);		
		
		$query1 = "select * from users where email='".$email."' and (is_deleted=0 or is_banned=1)";
		$users = DB::select($query1);
		//log::info($users);
		log::info(count($users));
		
		if(count($users)>0)
		{
			//return 'donotallow';
			$banned = false;
			foreach($users as $user)
			{
				if($user->is_banned == 1)
				{
					$banned = true;
					break;
				}
			}
			if($banned == true)
			{
				return 'banned';
			}
			else
			{
				return 'registered';
			}
		}		
		else
		{
			/* $user->first_name = Input::get('first_name');
			$user->last_name  = Input::get('last_name');
			$user->username   = Input::get('username');
			$user->email      = Input::get('email');
			$user->password   = Hash::make(Input::get('password')); */
			$user = new User;
			$user->email      = $email;
			$user->password   = Hash::make($pwd);
			$confirmation_code = str_random(30);
			$user->confirmation_code = $confirmation_code;
			$user->role = '3';
			$user->is_deleted = 0;
			$user->is_banned = 0;
			$user->save();
					
			$usernotification = UserNotification::where('notification_code', 7)->get();
			
			$valuesArray = array();
			if(count($usernotification) == 1)
			{
				$msg = $usernotification[0]->message;
				if($msg != '')
				{
					
					$valuesArray['email'] = $email;
					$valuesArray['viewpage'] = 'emails.welcome';
					$valuesArray['subject'] = $usernotification[0]->subject;
					$valuesArray['confirmation_code'] = $user->confirmation_code;
					$valuesArray['to1'] = $email;
					
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
			
			//Auth::attempt(['username' => $user->username, 'password' => Input::get('password')]);
			
			//Auth::user() = $user;
			return Redirect::to('/');
			//return View::make('search.index');
		}
       		
	}

	public function logout()
	{
		
		Auth::logout();
		return Redirect::to('/');
	}
	
	public function getResearchTrail()
	{
		log::info('Inside getResearchTrail');
		$pastMonthDate = date('Y-m-d G:i:s', strtotime('-30 days'));
		//log::info($pastMonthDate);
		$currentDate = date('Y-m-d G:i:s');
		//log::info($currentDate);
		//$searchedResults = SearchedTerms::all();
		$stats = Statistics::where('user_id', Auth::user()->id)
							 ->where('is_deleted', 0)
							 ->where('action', 'search')
							 ->orderBy('created_at', 'desc')
							 ->whereBetween('created_at', array($pastMonthDate,$currentDate))->get();
		//$searchedResults = SearchedTerms::find(Auth::user()->id);
		//log::info($stats);
		
		$this->preparePaginationArray($stats);
		
		return $this->getPagination(1,null,null);
		
		//$linksArray = array();
		/*foreach($searchedResults as $result)
		{
			$docIdsArray = explode(',', $result->document_ids);
			//log::info($docIdsArray);
			$modifiedDocIdsArray = array();
			foreach($docIdsArray as $docId)
			{
				$url = '/document/'.$docId;
				$modifiedDocIdsArray[] = '<a href="javascript:void(0)" onclick="window.open(\''.$url.'\',\'real title\',\'width=800,height=400,menubar=yes,status=yes,location=yes,toolbar=yes,scrollbars=yes\')">'.$docId.'</a>';
			}
			//log::info($modifiedDocIdsArray);
			$linksArray[] = $modifiedDocIdsArray;
		}
		log::info($linksArray); */
		//return View::make('search.researchtrail', ['searchResults' => $searchedResults, 'links' => $linksArray]);
	
	/*	$s_date = date('Y-m-d G:i:s', strtotime(0));
		$tmp_date = date('Y-m-d G:i:s');
		$e_date = date('Y-m-d H:i:s', strtotime($tmp_date . ' + 1 day')); */
		
	}
	
	public function filterRecordsByDates()
	{
		log::info('Inside filterRecordsByDates method');
		$stDate = date('Y-m-d', strtotime(0));
		$tmp_Date = date('Y-m-d');
		$endDate = date('Y-m-d', strtotime($tmp_Date . ' + 1 day'));
		$tmpVal1 = null;
		$tmpVal2 = null;
		if(Input::has('from_date'))
		{
			//$stDate = Input::get('from_date');
			$stDate = date('Y-m-d', strtotime(Input::get('from_date')));
			$tmpVal1 = date('Y-m-d', strtotime(Input::get('from_date')));
		}
		if(Input::has('to_date'))
		{
			//$endDate = Input::get('to_date');
			$endDate = date('Y-m-d', strtotime(Input::get('to_date').' + 1 day'));
			$tmpVal2 = date('Y-m-d', strtotime(Input::get('to_date')));
		}	
		
		//log::info($stDate);
		//log::info($endDate);
		$stats = array();
		$stats = Statistics::where('user_id', Auth::user()->id)
							 ->where('action', 'search')
							 ->where('is_deleted', 0)
							 ->orderBy('created_at', 'desc')
							 ->whereBetween('action_on', array($stDate,$endDate))->get();
							// ->whereRaw('action_on < ? and action_on > ?', array($stDate,$stDate))->get();
						 
							 
		//log::info($stats);		
		$stDate = $tmpVal1;
		$endDate = $tmpVal2;
		
		$this->preparePaginationArray($stats);
		return $this->getPagination(1,$stDate,$endDate);
	//	return View::make('search.researchtrail', ['pagination' => $pagination ,'stats' => $stats, 'st_date' =>$stDate, 'end_date' =>$endDate]);
	}
	
	public function exportRecords()
	{
		log::info('Inside export method');
		//log::info(Input::get('from_date'));
		$stDate = date('Y-m-d', strtotime(0));
		$tmp_Date = date('Y-m-d');
		$endDate = date('Y-m-d', strtotime($tmp_Date . ' + 1 day'));
		$tmpVal1 = null;
		$tmpVal2 = null;
		if(Input::has('st_date'))
		{
			//$stDate = Input::get('from_date');
			$stDate = date('Y-m-d', strtotime(Input::get('st_date')));
			$tmpVal1 = date('Y-m-d', strtotime(Input::get('st_date')));
		}
		if(Input::has('end_date'))
		{
			//$endDate = Input::get('to_date');
			$endDate = date('Y-m-d', strtotime(Input::get('end_date').' + 1 day'));
			$tmpVal2 = date('Y-m-d', strtotime(Input::get('end_date')));
		}	
		
		log::info($stDate);
		log::info($endDate);
		/*log::info('Inside exportRecords method');
		log::info(Input::get('st_date'));
		log::info(Input::get('end_date')); */
		$stats = array();
		$stats = Statistics::where('user_id', Auth::user()->id)
							 ->where('action', 'search')
							 ->where('is_deleted', 0)
							 ->orderBy('created_at', 'desc')
							 ->whereBetween('action_on', array($stDate,$endDate))->get();
							// ->whereRaw('action_on < ? and action_on > ?', array($stDate,$stDate))->get();
						 
							 
		//log::info($stats);
		
		$usernotification = UserNotification::where('notification_code', 8)->get();
		$user = Auth::user();	
			$valuesArray = array();
			if(count($usernotification) == 1)
			{
				$msg = $usernotification[0]->message;
				if($msg != '')
				{
					
					$valuesArray['email'] = $user->email;
					$valuesArray['viewpage'] = 'emails.exportresearchtrailresult';
					$valuesArray['subject'] = $usernotification[0]->subject;
					$valuesArray['to1'] = $user->email;
					$valuesArray['stats'] = $stats;
					
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
					$data = array('email'=>Auth::user()->email, 'stats' =>$stats);
			
					Mail::send('emails.exportresearchtrailresult', $data, function($message) 
					{
						$message->to(Auth::user()->email, Auth::user()->first_name)->subject('Exported Research Trail results');
						
					});
				}
			}
			else
			{
				$data = array('email'=>Auth::user()->email, 'stats' =>$stats);
			
				Mail::send('emails.exportresearchtrailresult', $data, function($message) 
				{
					$message->to(Auth::user()->email, Auth::user()->first_name)->subject('Exported Research Trail results');
					
				});
			}			
		
		/* $data = array('firstname'=>Auth::user()->first_name, 'stats' =>$stats);
	//	log::info($data);
		
		 Mail::send('emails.exportresearchtrailresult', $data, function($message) 
		{
			$message->to(Auth::user()->email, Auth::user()->first_name)->subject('Exported Research Trail results');
			
		}); */

		//$pagination = $this->getPagination($stats);
		$this->preparePaginationArray($stats);
		return $this->getPagination(1,Input::get('st_date'), Input::get('end_date'));
		//return View::make('search.researchtrail', ['pagination' => $pagination ,'stats' => $stats, 'st_date' =>Input::get('st_date'), 'end_date' =>Input::get('end_date')]);
	}

	public function deleteRecords()
	{
		log::info('Inside deleteRecords method');
		//log::info(Input::has('st_date'));
		//log::info(Input::has('end_date'));

		$stDate = date('Y-m-d', strtotime(0));
		$tmp_Date = date('Y-m-d');
		$endDate = date('Y-m-d', strtotime($tmp_Date . ' + 1 day'));
		$tmpVal1 = null;
		$tmpVal2 = null;
		if(Input::has('st_date'))
		{
			//$stDate = Input::get('from_date');
			$stDate = date('Y-m-d', strtotime(Input::get('st_date')));
			$tmpVal1 = date('Y-m-d', strtotime(Input::get('st_date')));
		}
		if(Input::has('end_date'))
		{
			//$endDate = Input::get('to_date');
			$endDate = date('Y-m-d', strtotime(Input::get('end_date').' + 1 day'));
			$tmpVal2 = date('Y-m-d', strtotime(Input::get('end_date')));
		}	

		
		$stats = array();
		$stats = Statistics::where('user_id', Auth::user()->id)
							 ->where('action', 'search')
							 ->where('is_deleted', 0)
							 ->whereBetween('action_on', array($stDate,$endDate))->get();
							// ->whereRaw('action_on < ? and action_on > ?', array($stDate,$stDate))->get();		
							 
		log::info($stats);
		
		foreach($stats as $stat)
		{
			//log::info('deleting');
			$stat->is_deleted = 1;
			$stat->save();
		}
		
		$stats = Statistics::where('user_id', Auth::user()->id)
							 ->where('action', 'search')
							 ->where('is_deleted', 0)
							 ->whereBetween('action_on', array($stDate,$endDate))->get();
							 
		$stDate = $tmpVal1;
		$endDate = $tmpVal2;
		
		$this->preparePaginationArray($stats);
		return $this->getPagination(1,$stDate,$endDate);
		//$pagination = $this->getPagination($stats);
		//return View::make('search.researchtrail', ['pagination' => $pagination ,'stats' => $stats, 'st_date' =>$stDate, 'end_date' =>$endDate]);
	}
	
	public function preparePaginationArray($stats)
	{
		log::info('Inside preparePaginationArray');
	//	log::info($stats);
		$paginationArray = array();
		$paginationIndex = 1;
		$totalNrOfItems=0;
		$index = 0;
		$statParts = array();
		$searchURL = array();
		foreach($stats as $idx => $stat)
		{
			if($index != self::RESULTS_PER_PAGE)
			{
				$statParts[$idx] = $stat;
				$searchURL[$idx] = $this->getUrlLink($stat->content);
			}
			else
			{
				$paginationArray[$paginationIndex] = $statParts;
				$statParts = array();
				$statParts[$idx] = $stat;
				$searchURL[$idx] = $this->getUrlLink($stat->content);
				$paginationIndex++;
				$index = 0;
			}
			$index++;
			$totalNrOfItems++;
		}
		$paginationArray[$paginationIndex] = $statParts;
		//log::info($totalNrOfItems);
		//session_start();
		$_SESSION["paginationArray"] = $paginationArray;
		$_SESSION["searchURL"] = $searchURL;
		
	}
	
	public function paginate($pageNum) {
	
		//session_start();
		return $this->getPagination($pageNum,null,null);
	}
	
	protected function getPagination($currentpg, $s_date, $e_date) {

        $paginationURL = '/user/researchtrail/pagination/';
		$paginationArray = array();
		$paginationArray = $_SESSION["paginationArray"];
		$statsPart = $paginationArray[$currentpg];
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
			if($i == $startIndex) 
			{
				$pagination[] = array(
					'cssClass' => ($currentpg == 1) ? 'disabled' : '',
					'link' => $paginationURL.($currentpg - 1),
			  //      'link' => $this->getLink(null, null, $this->currentPage - 1),
					'label' => '&laquo;'
				);
			}
			
			if($i==$currentpg)
			{
				$pagination[] = array(
					'cssClass' => ($currentpg == $i) ? 'active' : '',
					'link' => $paginationURL.$i,
					//'link' => $this->getLink(null, null, $i),
					'label' => '<u>'.$i.'</u>'
				);
			}
			else
			{
				$pagination[] = array(
					'cssClass' => ($currentpg == $i) ? 'active' : '',
					'link' => $paginationURL.$i,
					//'link' => $this->getLink(null, null, $i),
					'label' => $i
				);
			}
			
			// last element
			if ($i == $endIndex) {
				$pagination[] = array(
					'cssClass' => ($currentpg == $maxIndex) ? 'disabled' : '',
					'link' => $paginationURL.($currentpg + 1),
				   // 'link' => $this->getLink(null, null, $this->currentPage + 1),
					'label' => '&raquo;'
				);
			}
		}
		
		//log::info($pagination);
		//$s_date = null;
		//$e_date = null;
		
		return View::make('search.researchtrail', ['pagination' => $pagination ,'stats' => $statsPart, 'st_date' =>$s_date, 'end_date' =>$e_date]);
		
		/*$totalNrOfItems=0;
		foreach($stats as $stat)
		{
			$totalNrOfItems++;
		}
		
		$nrOfPages = ceil($totalNrOfItems/self::RESULTS_PER_PAGE);

        //$pagination = array();

        // first check if we even need a pagination
        if(self::RESULTS_PER_PAGE < $totalNrOfItems) {
            for($i = 1; $i <= $nrOfPages; $i++) {

                // first element
                if($i == 1) {
                    $pagination[] = array(
                        'cssClass' => ($this->currentPage == 1) ? 'disabled' : '',
						'link' => 'http://localhost:8000/researchtrail/open/'.($this->currentPage - 1),
                  //      'link' => $this->getLink(null, null, $this->currentPage - 1),
                        'label' => '&laquo;'
                    );
                }

                // pages
                $pagination[] = array(
                    'cssClass' => ($this->currentPage == $i) ? 'active' : '',
					'link' => 'http://localhost:8000/researchtrail/open/'.$i,
                    //'link' => $this->getLink(null, null, $i),
                    'label' => $i
                );

                // last element
                if ($i == $nrOfPages) {
                    $pagination[] = array(
                        'cssClass' => ($this->currentPage == $nrOfPages) ? 'disabled' : '',
						'link' => 'http://localhost:8000/researchtrail/open/'.($this->currentPage - 1),
                       // 'link' => $this->getLink(null, null, $this->currentPage + 1),
                        'label' => '&raquo;'
                    );
                }
            }
        }
		
        return $pagination;*/

    }
	
	public function getUrlLink($content)
	{
		//$myArray = explode('&', $content);
		$test='Text=\'nigeria\' AND Title=\'Stephen O. Aigbe v. Nigeria\' AND Judges=\'Kamel Rezag-Bara\' AND Citation=\'252/2002\' AND Parties=\'Stephen O. Aigbe\' AND Date=\'01/01/2001-01/12/2014\'';
		//log::info('Inside getUrlLink');
		
		//$urlString = 'http://'.$_SERVER['HTTP_HOST'].'/search?'.$content;
		$urlString = $content;
		$removeSpaces = array("' AND ");
		$urlString = str_replace($removeSpaces, "", $urlString);
		
		$test='Text=\'nigeria\ Title=\'Stephen O. Aigbe v. Nigeria\ Judges=\'Kamel Rezag-Bara\ Citation=\'252/2002\ Parties=\'Stephen O. Aigbe\ Date=\'01/01/2001-01/12/2014\'';
		
		$test='q=nigeria &title=Stephen O. Aigbe v. Nigeria&judges=Kamel Rezag-Bara&citation=252/2002&parties=Stephen O. Aigbe\ Date=\'01/01/2001-01/12/2014\'';
		
		if (strpos($urlString, 'Text=\'') !== FALSE)
		{
			$urlString = str_replace('Text=\'','q=',$urlString);
			//$urlString = str_replace('Text=\'','q=',$urlString);
		}
		if (strpos($urlString, 'Title=\'') !== FALSE)
		{
			$urlString = str_replace('Title=\'','&title=',$urlString);
		}
		if (strpos($urlString, 'Judges=\'') !== FALSE)
		{
			$urlString = str_replace('Judges=\'','&judges=',$urlString);
		}
		if (strpos($urlString, 'Citation=\'') !== FALSE)
		{
			$urlString = str_replace('Citation=\'','&citation=',$urlString);
		}
		if (strpos($urlString, 'Parties=\'') !== FALSE)
		{
			$urlString = str_replace('Parties=\'','&parties=',$urlString);
		}
		if (strpos($urlString, 'Date=\'') !== FALSE)
		{
			$pos = strpos($urlString, 'Date=\'');
			$datesStr = substr($urlString, $pos, (strlen($urlString)-1));
			//log::info();
			//$positionOfHyphen = strpos($datesStr, '-');
			$datesArray = explode('-', $datesStr);
			//log::info($datesArray);
			$modifiedFromDate = str_replace('Date=\'','',$datesArray[0]);
			//log::info($modifiedFromDate);
			$modifiedToDate = str_replace('\'','',$datesArray[1]);
			$urlString = str_replace($datesArray[0],'&from='.date('Y-m-d', strtotime($modifiedFromDate)),$urlString);
			$urlString = str_replace('-'.$datesArray[1],'&to='.date('Y-m-d', strtotime($modifiedToDate)),$urlString);
		}
		$urlString = str_replace('\'','',$urlString);
		$urlString = $urlString.'&page=researchtrail';
		return $urlString;
		//log::info($urlString);
	//	$urlString = '';
	//	$urlString = $urlString.'q='.$stat->searchterm;
	//	http://localhost:8000/search?q=nigeria&title=Stephen+O.+Aigbe+v.+Nigeria&parties=Stephen+O.+Aigbe&citation=252%2F2002&judges=Kamel+Rezag-Bara&doctype=&from=2001-01-01&to=2014-12-01
	}
	
	public function resetPassword()
	{
		log::info('inside reset pwd');
		$eml = $_POST['email'];
		//log::info($eml);
		
		$user = User::where('email', $eml)
							 ->where('is_banned', 0)
							 ->where('is_deleted', 0)->get();
						//	 ->whereBetween('action_on', array($stDate,$endDate))->get();
		//log::info($user);
		//log::info($user[0]);
		//log::info($user[0]['email']);
		if((count($user) == 1) && ($user[0]['email']==$eml))
		{
			//log::info('inside true');
			$newpwd = $this->randomPassword();
			//log::info($newpwd);
		}
	}
	
	public function deleteAccount()
	{
		$eml = $_POST['email'];
		$pwd = $_POST['pwd'];
		
		if (Auth::attempt(['email' => $eml, 'password' => $pwd, 'is_banned' => 0, 'is_deleted'=>0, 'confirmed' => 1]))
		{
			$user = Auth::user();
			$user->is_deleted = 1;
			$user->email = 'deleted_'.$user->email;
			$user->save();
			
			
			$usernotification = UserNotification::where('notification_code', 5)->get();
			log::info($usernotification);
			if(count($usernotification) == 1)
			{
				$msg = $usernotification[0]->message;
				if($msg != '')
				{
					//$sub = $usernotification[0]->subject;
					$valuesArray = array();
					$valuesArray['email'] = $eml;
					$valuesArray['viewpage'] = 'emails.accountclosure';
					$valuesArray['subject'] = $usernotification[0]->subject;
					//$valuesArray['confirmation_code'] = $user->confirmation_code;
					$valuesArray['to1'] = $eml;
					
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
					$data = array('email'=>$eml);
			
					Mail::send('emails.accountclosure', $data, function($message) use($data) 
					{
						$message->to($data['email'], $data['email'])->subject('Mistminds Account Closure Intimation');
						
					});
				}
			}
			else
			{
				$data = array('email'=>$eml);
			
				Mail::send('emails.accountclosure', $data, function($message) use($data) 
				{
					$message->to($data['email'], $data['email'])->subject('Mistminds Account Closure Intimation');
					
				});
			}
			
			Auth::logout();
			return "success";
		}
		else
		{
			return "invaliduser";
		}
	}
	
	public function openTermsAndConditions()
	{
		//log::info('inside openTermsAndConditions');
		return View::make('search.termsandconditions');
	}
	
	public function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
	
	/*public function getPagination($stats)
	{
		$pagination = array();
		$contentArray = array();
		$contentArray['cssClass'] = 'disabled';
		$contentArray['link'] = 'http://localhost:8000/search/title/asc/0/?q=court';
		$contentArray['label'] = '&laquo;';
		
		$pagination[0] = $contentArray;
		foreach($stats as $ind => $stat)
		{
			$i = $ind+1;
			$cntArray = array();
			if($ind == 0)
			{
				$cntArray['cssClass'] = 'active';
			}
			else
			{
				$cntArray['cssClass'] = '';
			}
			$cntArray['link'] = 'http://localhost:8000/search/title/asc/0/?q=court';
			$cntArray['label'] = $i;
			$pagination[$i] = $cntArray;
		}
		$nextPageArray = array();
		$nextPageArray['cssClass'] = '';
		$nextPageArray['link'] = 'http://localhost:8000/search/title/asc/0/?q=court';
		$nextPageArray['label'] = '&raquo;';
		
		$pagination[count($stats)+1] = $nextPageArray;
		
		log::info($pagination);
		return $pagination;
	} */
	
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
