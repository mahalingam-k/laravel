<?php

class UserNotificationController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		log::info('inside index method of user-notifications controller');
	//	$usernotification = new UserNotification();
		$usernotifications = UserNotification::all();
		$notificationArray = array();
		foreach($usernotifications as $notification)
		{
			$notificationArray[$notification->notification_code] = $notification;
		}
		log::info(count($usernotifications));
		//session_start();
		$_SESSION["currentlink"] = 6;
		return View::make('admin.user-notifications.index',['notificationArray' => $notificationArray]);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		log::info('inside create method of user-notifications controller');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		/*
		log::info('inside store method of user-notifications controller');
		log::info(Input::get('getRegisterSubject'));
		log::info(Input::get('getRegistermsg'));
		log::info(Input::get('srchdeliverysub'));
		log::info(Input::get('srchdeliverymsg'));
		log::info(Input::get('cntntdeliverysub'));
		log::info(Input::get('cntntdeliverymsg'));
		log::info(Input::get('pwdrstsub'));
		log::info(Input::get('pwdrstmsg'));
		log::info(Input::get('accntclosureconfsub'));
		log::info(Input::get('accntclosureconfmsg'));
		log::info(Input::get('banconfsub'));
		log::info(Input::get('banconfmsg')); */
		
		$userid = Auth::user()->id;
		
		$usernotifications = UserNotification::all();
		log::info($usernotifications);
		$notificationArray = array();
		foreach($usernotifications as $notification)
		{
			$notificationArray[$notification->notification_code] = $notification;
		}
		//log::info($notificationArray);
		
			if(array_key_exists('1', $notificationArray))
			{
				$usernotification1 = $notificationArray[1];
				$usernotification1->subject = Input::get('getRegisterSubject');
				$usernotification1->message = Input::get('getRegistermsg');
				$usernotification1->created_by = $userid;
				$usernotification1->save();
			}
			else
			{
				$usernotification1 = new UserNotification();
				$usernotification1->notification_type = 'REGISTRATION CONFIRMATION EMAIL';
				$usernotification1->notification_code = '1';
				$usernotification1->subject = Input::get('getRegisterSubject');
				$usernotification1->message = Input::get('getRegistermsg');
				$usernotification1->created_by = $userid;
				$usernotification1->save();
			}
		
				
		
			if(array_key_exists('2', $notificationArray))
			{
				$usernotification2 = $notificationArray[2];
				$usernotification2->subject = Input::get('srchdeliverysub');
				$usernotification2->message = Input::get('srchdeliverymsg');
				$usernotification2->created_by = $userid;
				$usernotification2->save();
			}
			else
			{
				$usernotification2 = new UserNotification();
				$usernotification2->notification_type = 'COVER EMAIL FOR SEARCH RESULTS DELIVERY';
				$usernotification2->notification_code = '2';
				$usernotification2->subject = Input::get('srchdeliverysub');
				$usernotification2->message = Input::get('srchdeliverymsg');
				$usernotification2->created_by = $userid;
				$usernotification2->save();
			}
		
			if(array_key_exists('3', $notificationArray))
			{
				$usernotification3 = $notificationArray[3];
				$usernotification3->subject = Input::get('cntntdeliverysub');
				$usernotification3->message = Input::get('cntntdeliverymsg');
				$usernotification3->created_by = $userid;
				$usernotification3->save();
			}
			else
			{
				$usernotification3 = new UserNotification();
				$usernotification3->notification_type = 'COVER EMAIL FOR DOCUMENT DELIVERY';
				$usernotification3->notification_code = '3';
				$usernotification3->subject = Input::get('cntntdeliverysub');
				$usernotification3->message = Input::get('cntntdeliverymsg');
				$usernotification3->created_by = $userid;
				$usernotification3->save();
			}
		
			if(array_key_exists('4', $notificationArray))
			{
				$usernotification4 = $notificationArray[4];
				$usernotification4->subject = Input::get('pwdrstsub');
				$usernotification4->message = Input::get('pwdrstmsg');
				$usernotification4->created_by = $userid;
				$usernotification4->save();
			}
			else
			{
				$usernotification4 = new UserNotification();
				$usernotification4->notification_type = 'PASSWORD RESET';
				$usernotification4->notification_code = '4';
				$usernotification4->subject = Input::get('pwdrstsub');
				$usernotification4->message = Input::get('pwdrstmsg');
				$usernotification4->created_by = $userid;
				$usernotification4->save();
			}
		
			if(array_key_exists('5', $notificationArray))
			{
				$usernotification5 = $notificationArray[5];
				$usernotification5->subject = Input::get('accntclosureconfsub');
				$usernotification5->message = Input::get('accntclosureconfmsg');
				$usernotification5->created_by = $userid;
				$usernotification5->save();
			}
			else
			{
				$usernotification5 = new UserNotification();
				$usernotification5->notification_type = 'ACCOUNT CLOSURE CONFIRMATION';
				$usernotification5->notification_code = '5';
				$usernotification5->subject = Input::get('accntclosureconfsub');
				$usernotification5->message = Input::get('accntclosureconfmsg');
				$usernotification5->created_by = $userid;
				$usernotification5->save();
			}
		
			if(array_key_exists('6', $notificationArray))
			{
				log::info($notificationArray[6]);
				$usernotification6 = $notificationArray[6];
				$usernotification6->subject = Input::get('banconfsub');
				$usernotification6->message = Input::get('banconfmsg');
				$usernotification6->created_by = $userid;
				$usernotification6->save();
			}
			else
			{
				$usernotification6 = new UserNotification();
				$usernotification6->notification_type = 'BANNING CONFIRMATION';
				$usernotification6->notification_code = '6';
				$usernotification6->subject = Input::get('banconfsub');
				$usernotification6->message = Input::get('banconfmsg');
				$usernotification6->created_by = $userid;
				$usernotification6->save();
			}
			
			if(array_key_exists('7', $notificationArray))
			{
				log::info($notificationArray[7]);
				$usernotification7 = $notificationArray[7];
				$usernotification7->subject = Input::get('regsub');
				$usernotification7->message = Input::get('regmsg');
				$usernotification7->created_by = $userid;
				$usernotification7->save();
			}
			else
			{
				$usernotification7 = new UserNotification();
				$usernotification7->notification_type = 'REGISTRATION';
				$usernotification7->notification_code = '7';
				$usernotification7->subject = Input::get('regsub');
				$usernotification7->message = Input::get('regmsg');
				$usernotification7->created_by = $userid;
				$usernotification7->save();
			}
			
			if(array_key_exists('8', $notificationArray))
			{
				log::info($notificationArray[8]);
				$usernotification8 = $notificationArray[8];
				$usernotification8->subject = Input::get('researchtrailsub');
				$usernotification8->message = Input::get('researchtrailmsg');
				$usernotification8->created_by = $userid;
				$usernotification8->save();
			}
			else
			{
				$usernotification8 = new UserNotification();
				$usernotification8->notification_type = 'RESEARCH TRAIL';
				$usernotification8->notification_code = '8';
				$usernotification8->subject = Input::get('researchtrailsub');
				$usernotification8->message = Input::get('researchtrailmsg');
				$usernotification8->created_by = $userid;
				$usernotification8->save();
			}
		
		//session_start();
		$_SESSION["currentlink"] = 6;
		return View::make('admin.index');

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		log::info('inside show method of user-notifications controller');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		log::info('inside edit method of user-notifications controller');
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		log::info('inside update method of user-notifications controller');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		log::info('inside destroy method of user-notifications controller');
	}


}
