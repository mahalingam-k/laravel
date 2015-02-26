<?php

class StatisticsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
			
		//log::info('Inside index of stat controller');

		/*
		select s.act_on, s.search,e.email, d.download, a.alert, o.opened from (
select DATE(action_on) as act_on,count(*) as search from statistics where action='Search' group by DATE(action_on) order by action) as s
left join (select DATE(action_on) as act_on, count(*) as email from statistics where action='Emailed' group by DATE(action_on)) as e
on s.act_on = e.act_on
left join (select DATE(action_on) as act_on, count(*) as download from statistics where action='Downloaded' group by DATE(action_on)) as d  
on e.act_on = d.act_on
left join (select DATE(action_on) as act_on, count(*) as alert from statistics where action='Alerts')as a 
on d.act_on = a.act_on
left join (select DATE(action_on) as act_on, count(*) as opened from statistics where action='Opened')as o
on a.act_on = o.act_on order by s.act_on desc
		*/
		//select DISTINCT DATE(action_on) from statistics where is_deleted=0 group by action_on
		
		/*
		select s.search,e.email,d.download,a.alert,o.opened from (select count(*) as search from statistics where action='Search' and action_on BETWEEN '2014-09-25 00:00:00' AND '2014-09-25 23:59:59' order by action) as s
join (select count(*) as email from statistics where action='Emailed' and action_on BETWEEN '2014-09-25 00:00:00' AND '2014-09-25 23:59:59' order by action) as e
join (select count(*) as download from statistics where action='Downloaded' and action_on BETWEEN '2014-09-25 00:00:00' AND '2014-09-25 23:59:59' order by action) as d
join (select count(*) as alert from statistics where action='Alerts' and action_on BETWEEN '2014-09-25 00:00:00' AND '2014-09-25 23:59:59' order by action)as a
join (select count(*) as opened from statistics where action='Opened' and action_on BETWEEN '2014-09-25 00:00:00' AND '2014-09-25 23:59:59' order by action)as o

		*/
		
		/*$query = 'select s.act_on, s.search,e.email, d.download, a.alert, o.opened from (
		select is_deleted as isdel,DATE(action_on) as act_on,count(*) as search from statistics where action=\'Search\' group by DATE(action_on) order by action) as s
		left join (select DATE(action_on) as act_on, count(*) as email from statistics where action=\'Emailed\' group by DATE(action_on)) as e
		on s.act_on = e.act_on
		left join (select DATE(action_on) as act_on, count(*) as download from statistics where action=\'Downloaded\' group by DATE(action_on)) as d  
		on e.act_on = d.act_on
		left join (select DATE(action_on) as act_on, count(*) as alert from statistics where action=\'Alerts\')as a 
		on d.act_on = a.act_on
		left join (select DATE(action_on) as act_on, count(*) as opened from statistics where action=\'Opened\')as o
		on a.act_on = o.act_on where s.isdel=0 order by s.act_on desc'; */
		
		$query = 'select c.act_on, s.search, e.email, d.download, a.alert,o.opened from
			(select distinct DATE(action_on) as act_on,is_deleted as isdel from statistics) as c
			left join
			(select DATE(action_on) as act_on, count(*) as search from statistics where action=\'Search\' group by DATE(action_on)) as s
			on c.act_on = s.act_on
			left join
			(select DATE(action_on) as act_on, count(*) as email from statistics where action=\'Emailed\' group by DATE(action_on)) as e
			on c.act_on = e.act_on
			left join
			(select DATE(action_on) as act_on, count(*) as download from statistics where action=\'Downloaded\' group by DATE(action_on)) as d
			on c.act_on = d.act_on
			left join
			(select DATE(action_on) as act_on, count(*) as opened from statistics where action=\'Opened\' group by DATE(action_on)) as o
			on c.act_on = o.act_on
			left join
			(select DATE(action_on) as act_on, count(*) as alert from statistics where action=\'Alerts\' group by DATE(action_on)) as a
			on c.act_on = a.act_on
			where c.isdel=0 order by c.act_on desc';
		
		$results = DB::select($query);
		
		$query1 = 'select content,document_ids,count(*) as doccnt from statistics where action=\'Opened\' group by document_ids 
				   order by doccnt desc LIMIT 50 OFFSET 0';
		$popularDocs = DB::select($query1);
		//log::info($popularDocs);
		
		$query2 = 'select searchterm,count(*) as srchcnt from statistics where action=\'Search\' group by searchterm order by srchcnt desc LIMIT 50 OFFSET 0';		
		$popularSearches = DB::select($query2);
		
		$cal = $this->getCalendarArray();
		
		$defy = date("Y");
		$defm = 13;
		$defd = 0;
	/*	$stats = Statistics::where('is_deleted', 0)
		->orderBy('action_on', 'desc')
		->distinct()
		->groupBy('action_on')->get(); */
	
		//$stats = Statistics::whereRaw('select DISTINCT DATE(action_on) from statistics where is_deleted=0 group by action_on')->get();
	
		//log::info($results);
		//session_start();
		$_SESSION["currentlink"] = 7;
		return View::make('admin.statistics.index', 
		['results' => $results,'cal'=>$cal, 'dd' => $defd, 'dm' => $defm,'dy' => $defy,'docs' => $popularDocs,'searches'=>$popularSearches]);
		//return View::make('admin.statistics.index', ['searchResults' => $searchedResults, 'links' => $linksArray, 'users' => $unameArray, 'default' => $default]);
	}
	
	public function getCalendarArray()
	{
		$years = array_combine(range(2000, date("Y")), range(2000, date("Y")));
		
		//log::info($years);
		$months = array();
		$months = cal_info(0)['months'];
		$months[] = 'All Months';
	//	log::info($months);
		
		$i=1;
		$days = array();
		$days[0] = 'All Days';
		for($i=1;$i<32;$i++)
		{
			$days[$i] = $i;
		}
		
		$cal = array();
		$cal[0] = $years;
		$cal[1] = $months;
		$cal[2] = $days;
		
	//	log::info($cal);
		return $cal;
	}

	public function getStatistics()
	{
		log::info(Input::get('Years'));
		log::info(Input::get('Months'));
		log::info(Input::get('Days'));
		$yr = Input::get('Years');
		$mnt = Input::get('Months');
		$day = Input::get('Days');
		$num_padded = 0;
		$results = array();
		if($mnt<10)
		{
			$num_padded = sprintf("%02s", $mnt);
		}
		else
		{
			$num_padded = $mnt;
		}
		$query = '';
		$query1 = '';
		$query2 = '';
		if($mnt == 13 && $day == 0)
		{
			log::info('Inside first condition');
			$query = 'select c.act_on, s.search, e.email, d.download, a.alert,o.opened from
			(select distinct DATE(action_on) as act_on,is_deleted as isdel from statistics) as c
			left join
			(select DATE(action_on) as act_on, count(*) as search from statistics where action=\'Search\' group by DATE(action_on)) as s
			on c.act_on = s.act_on
			left join
			(select DATE(action_on) as act_on, count(*) as email from statistics where action=\'Emailed\' group by DATE(action_on)) as e
			on c.act_on = e.act_on
			left join
			(select DATE(action_on) as act_on, count(*) as download from statistics where action=\'Downloaded\' group by DATE(action_on)) as d
			on c.act_on = d.act_on
			left join
			(select DATE(action_on) as act_on, count(*) as opened from statistics where action=\'Opened\' group by DATE(action_on)) as o
			on c.act_on = o.act_on
			left join
			(select DATE(action_on) as act_on, count(*) as alert from statistics where action=\'Alerts\' group by DATE(action_on)) as a
			on c.act_on = a.act_on
			where c.isdel=0 and YEAR(c.act_on) = '.$yr.' order by c.act_on desc';
			
			$query1 = 'select content,document_ids,count(*) as doccnt from statistics where action=\'Opened\' and YEAR(action_on) = '.$yr.' group by document_ids 
			order by doccnt desc LIMIT 50 OFFSET 0';
		
		
			$query2 = 'select searchterm,count(*) as srchcnt from statistics where action=\'Search\' and YEAR(action_on) = '.$yr.' group by searchterm 
			order by srchcnt desc LIMIT 50 OFFSET 0';		

			
			/*$query = 'select s.act_on, s.search,e.email, d.download, a.alert, o.opened from (
			select is_deleted as isdel, DATE(action_on) as act_on,count(*) as search from statistics where action=\'Search\' group by DATE(action_on) order by action) as s
			left join (select DATE(action_on) as act_on, count(*) as email from statistics where action=\'Emailed\' group by DATE(action_on)) as e
			on s.act_on = e.act_on
			left join (select DATE(action_on) as act_on, count(*) as download from statistics where action=\'Downloaded\' group by DATE(action_on)) as d  
			on e.act_on = d.act_on
			left join (select DATE(action_on) as act_on, count(*) as alert from statistics where action=\'Alerts\')as a 
			on d.act_on = a.act_on
			left join (select DATE(action_on) as act_on, count(*) as opened from statistics where action=\'Opened\')as o
			on a.act_on = o.act_on where s.isdel=0 and YEAR(s.act_on)='.$yr.' order by s.act_on desc'; */
			
		}
		elseif($mnt == 13 && $day != 0)
		{
			log::info('Inside second condition');
			$query = 'select c.act_on, s.search, e.email, d.download, a.alert,o.opened from
			(select distinct DATE(action_on) as act_on,is_deleted as isdel from statistics) as c
			left join
			(select DATE(action_on) as act_on, count(*) as search from statistics where action=\'Search\' group by DATE(action_on)) as s
			on c.act_on = s.act_on
			left join
			(select DATE(action_on) as act_on, count(*) as email from statistics where action=\'Emailed\' group by DATE(action_on)) as e
			on c.act_on = e.act_on
			left join
			(select DATE(action_on) as act_on, count(*) as download from statistics where action=\'Downloaded\' group by DATE(action_on)) as d
			on c.act_on = d.act_on
			left join
			(select DATE(action_on) as act_on, count(*) as opened from statistics where action=\'Opened\' group by DATE(action_on)) as o
			on c.act_on = o.act_on
			left join
			(select DATE(action_on) as act_on, count(*) as alert from statistics where action=\'Alerts\' group by DATE(action_on)) as a
			on c.act_on = a.act_on
			where c.isdel=0 and DATE_FORMAT(c.act_on, "%d-%Y") = \''.$day.'-'.$yr.'\' order by c.act_on desc';
			
			$query1 = 'select content,document_ids,count(*) as doccnt from statistics where action=\'Opened\' and 
			DATE_FORMAT(action_on, "%d-%Y") = \''.$day.'-'.$yr.'\' group by document_ids order by doccnt desc LIMIT 50 OFFSET 0';
		
		
			$query2 = 'select searchterm,count(*) as srchcnt from statistics where action=\'Search\' and DATE_FORMAT(action_on, "%d-%Y") = \''.$day.'-'.$yr.'\'
			group by searchterm order by srchcnt desc LIMIT 50 OFFSET 0';
		}
		elseif($mnt != 13 && $day == 0)
		{
			
			log::info('Inside third condition');	
			$query = 'select c.act_on, s.search, e.email, d.download, a.alert,o.opened from
			(select distinct DATE(action_on) as act_on,is_deleted as isdel from statistics) as c
			left join
			(select DATE(action_on) as act_on, count(*) as search from statistics where action=\'Search\' group by DATE(action_on)) as s
			on c.act_on = s.act_on
			left join
			(select DATE(action_on) as act_on, count(*) as email from statistics where action=\'Emailed\' group by DATE(action_on)) as e
			on c.act_on = e.act_on
			left join
			(select DATE(action_on) as act_on, count(*) as download from statistics where action=\'Downloaded\' group by DATE(action_on)) as d
			on c.act_on = d.act_on
			left join
			(select DATE(action_on) as act_on, count(*) as opened from statistics where action=\'Opened\' group by DATE(action_on)) as o
			on c.act_on = o.act_on
			left join
			(select DATE(action_on) as act_on, count(*) as alert from statistics where action=\'Alerts\' group by DATE(action_on)) as a
			on c.act_on = a.act_on
			where c.isdel=0 and DATE_FORMAT(c.act_on, "%m-%Y") = \''.$num_padded.'-'.$yr.'\'  order by c.act_on desc';
			
			$query1 = 'select content,document_ids,count(*) as doccnt from statistics where action=\'Opened\' and 
			DATE_FORMAT(action_on, "%m-%Y") = \''.$num_padded.'-'.$yr.'\' group by document_ids order by doccnt desc LIMIT 50 OFFSET 0';
		
		
			$query2 = 'select searchterm,count(*) as srchcnt from statistics where action=\'Search\' and 
			DATE_FORMAT(action_on, "%m-%Y") = \''.$num_padded.'-'.$yr.'\' group by searchterm order by srchcnt desc LIMIT 50 OFFSET 0';

		/*	$query = 'select s.act_on, s.search,e.email, d.download, a.alert, o.opened from (
			select is_deleted as isdel, DATE(action_on) as act_on,count(*) as search from statistics where action=\'Search\' group by DATE(action_on) order by action) as s
			left join (select DATE(action_on) as act_on, count(*) as email from statistics where action=\'Emailed\' group by DATE(action_on)) as e
			on s.act_on = e.act_on
			left join (select DATE(action_on) as act_on, count(*) as download from statistics where action=\'Downloaded\' group by DATE(action_on)) as d  
			on e.act_on = d.act_on
			left join (select DATE(action_on) as act_on, count(*) as alert from statistics where action=\'Alerts\')as a 
			on d.act_on = a.act_on
			left join (select DATE(action_on) as act_on, count(*) as opened from statistics where action=\'Opened\')as o
			on a.act_on = o.act_on where s.isdel=0 and DATE_FORMAT(s.act_on, "%m-%Y") = \''.$num_padded.'-'.$yr.'\' order by s.act_on desc';
			//on a.act_on = o.act_on where s.isdel=0 and DATE_FORMAT(s.act_on, "%m-%Y") = \'9-2014\' order by s.act_on desc'; */


		}
		else
		{
			log::info('Inside fourth condition');
			
			$query = 'select c.act_on, s.search, e.email, d.download, a.alert,o.opened from
			(select distinct DATE(action_on) as act_on,is_deleted as isdel from statistics) as c
			left join
			(select DATE(action_on) as act_on, count(*) as search from statistics where action=\'Search\' group by DATE(action_on)) as s
			on c.act_on = s.act_on
			left join
			(select DATE(action_on) as act_on, count(*) as email from statistics where action=\'Emailed\' group by DATE(action_on)) as e
			on c.act_on = e.act_on
			left join
			(select DATE(action_on) as act_on, count(*) as download from statistics where action=\'Downloaded\' group by DATE(action_on)) as d
			on c.act_on = d.act_on
			left join
			(select DATE(action_on) as act_on, count(*) as opened from statistics where action=\'Opened\' group by DATE(action_on)) as o
			on c.act_on = o.act_on
			left join
			(select DATE(action_on) as act_on, count(*) as alert from statistics where action=\'Alerts\' group by DATE(action_on)) as a
			on c.act_on = a.act_on
			where c.isdel=0 and DATE_FORMAT(c.act_on, "%d-%m-%Y") = \''.$day.'-'.$num_padded.'-'.$yr.'\'order by c.act_on desc';
			
			$query1 = 'select content,document_ids,count(*) as doccnt from statistics where action=\'Opened\' and 
			DATE_FORMAT(action_on, "%d-%m-%Y") = \''.$day.'-'.$num_padded.'-'.$yr.'\' group by document_ids order by doccnt desc LIMIT 50 OFFSET 0';
		
		
			$query2 = 'select searchterm,count(*) as srchcnt from statistics where action=\'Search\' and 
			DATE_FORMAT(action_on, "%d-%m-%Y") = \''.$day.'-'.$num_padded.'-'.$yr.'\' group by searchterm order by srchcnt desc LIMIT 50 OFFSET 0';
		}
		
		$results = DB::select($query);
		$results1 = DB::select($query1);
		log::info('res1......');
		log::info($results1);
		$results2 = DB::select($query2);
		
		$resArray = array();
		$resArray[] = $results;
		$resArray[] = $results1;
		$resArray[] = $results2;
		return $resArray;
		//return View::make('admin.statistics.index', ['searchResults' => $searchedResults, 'links' => $linksArray, 'users' => $unameArray, 'default' => $default]);
		
		/* $searchedResults = array();
		
		log::info('individual user search');
		log::info(Input::get('user'));
		if(Input::get('user') != 0)
		{
			$searchedResults = SearchedTerms::where('user_id', Input::get('user'))->get();
		}
		else
		{
			$searchedResults = SearchedTerms::all();
		}
		
		$users = User::all();
		$i=0;
		$unameArray = array();
		$unameArray[0] = 'All';
		foreach($users as $user)
		{
			$unameArray[$user->id] = $user->username;
			$i++;
		}
		log::info($unameArray);
		//$searchedResults = SearchedTerms::find(Auth::user()->id);
		log::info($searchedResults);
		$linksArray = array();
		foreach($searchedResults as $result)
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
		log::info($linksArray);
		$default = Input::get('user');
		//return View::make('search.researchtrail', ['searchResults' => $searchedResults, 'links' => $linksArray]);
		return View::make('admin.statistics.index', ['searchResults' => $searchedResults, 'links' => $linksArray, 'users' => $unameArray, 'default' => $default]);
		*/
	}
	
	public function postStat()
	{
		log::info('Inside postStat method');
		log::info(Input::get('getstats'));
		$res = array();
		if(Input::get('getstats'))
		{
			$resArray = $this->getStatistics();
			
		}
		elseif(Input::get('exportsearch'))
		{
			log::info('Inside exportsearch');
			$output = $this->exportSearchedRecords();
			$headers = array(
			'Content-Type' => 'text/csv',
			'Content-Disposition' => 'attachment; filename="GeneralStatistics.csv"',
			);
 
			return Response::make(rtrim($output, "\n"), 200, $headers);
		}
		elseif(Input::get('exportpopularsearchterms'))
		{
			$output = $this->exportPopularSearchTerms();
			$headers = array(
			'Content-Type' => 'text/csv',
			'Content-Disposition' => 'attachment; filename="PopularSearchTerms.csv"',
			);
 
			return Response::make(rtrim($output, "\n"), 200, $headers);
		}
		elseif(Input::get('exportpopulardocuments'))
		{
			$output = $this->exportPopularOpenedDocuments();
			$headers = array(
			'Content-Type' => 'text/csv',
			'Content-Disposition' => 'attachment; filename="PopularOpenedDocuments.csv"',
			);
 
			return Response::make(rtrim($output, "\n"), 200, $headers);
		}
		elseif(Input::get('exportuserstats'))
		{
			log::info('Inside exportuserstats');
			$output = $this->exportUserStatistics();
			$headers = array(
			'Content-Type' => 'text/csv',
			'Content-Disposition' => 'attachment; filename="UserStatistics.csv"',
			);
 
			return Response::make(rtrim($output, "\n"), 200, $headers);
		}
		else
		{
			log::info('Inside else of post stat');
		}
		
		$cal = $this->getCalendarArray();
		$defy = Input::get('Years');
		$defm = Input::get('Months');
		$defd = Input::get('Days');
		
		log::info('Calculating count...');
		log::info(count($resArray['1']));
		log::info(count($resArray['2']));
		/*$query1 = 'select content,document_ids,count(*) as doccnt from statistics where action=\'Opened\' group by document_ids 
				   order by doccnt desc LIMIT 50 OFFSET 0';
		$popularDocs = DB::select($query1);
		//log::info($popularDocs);
		
		$query2 = 'select searchterm,count(*) as srchcnt from statistics where action=\'Search\' group by searchterm order by srchcnt desc LIMIT 50 OFFSET 0';		
		$popularSearches = DB::select($query2); */
		//session_start();
		$_SESSION["currentlink"] = 7;
		return View::make('admin.statistics.index', ['results' => $resArray['0'],'cal'=>$cal, 'dd' => $defd, 'dm' => $defm,'dy' => $defy,'docs' => $resArray['1'],'searches'=>$resArray['2']]);
	}
	
	public function exportSearchedRecords()
	{
		log::info(Input::get('frmsrchdate'));
		//$stDate = Input::get('frmsrchdate');
		//$endDate = Input::get('endsrchdate');
		
		$stDate = date('Y-m-d', strtotime(0));
		$tmp_Date = date('Y-m-d');
		$endDate = date('Y-m-d', strtotime($tmp_Date . ' + 1 day'));
		
		if(Input::has('frmsrchdate'))
		{
			$stDate = date('Y-m-d', strtotime(Input::get('frmsrchdate')));
		}
		if(Input::has('endsrchdate'))
		{
			$endDate = date('Y-m-d', strtotime(Input::get('endsrchdate')));
		}
		
		$query = 'select c.act_on, s.search, e.email, d.download, a.alert,o.opened from
			(select distinct DATE(action_on) as act_on,is_deleted as isdel from statistics) as c
			left join
			(select DATE(action_on) as act_on, count(*) as search from statistics where action=\'Search\' group by DATE(action_on)) as s
			on c.act_on = s.act_on
			left join
			(select DATE(action_on) as act_on, count(*) as email from statistics where action=\'Emailed\' group by DATE(action_on)) as e
			on c.act_on = e.act_on
			left join
			(select DATE(action_on) as act_on, count(*) as download from statistics where action=\'Downloaded\' group by DATE(action_on)) as d
			on c.act_on = d.act_on
			left join
			(select DATE(action_on) as act_on, count(*) as opened from statistics where action=\'Opened\' group by DATE(action_on)) as o
			on c.act_on = o.act_on
			left join
			(select DATE(action_on) as act_on, count(*) as alert from statistics where action=\'Alerts\' group by DATE(action_on)) as a
			on c.act_on = a.act_on
			where c.isdel=0 and c.act_on between \''.$stDate.'\' and \''.$endDate.'\' order by c.act_on';
		
		$results = DB::select($query);
		log::info($results);
		
		$output=null;
		$output="Date,Searched,Opened,Emailed,Download,Alerts\n";
		foreach ($results as $index =>  $result) 
		{
		//	log::info($result->search);
			$temp = array();
			$temp[] = date('Y-m-d',strtotime($result->act_on));
			//$temp[] = date('G-i-s',strtotime($result->act_on));
			$temp[] = $result->search;
			$temp[] = $result->opened;
			$temp[] = $result->email;
			$temp[] = $result->download;
			$temp[] = $result->alert;
			$temp[] = "\n";
			$res=  implode(",",$temp);
			$output = $output.$res;
		}
		return $output; 
		/*
		$stats = array();
		$stats = Statistics::where('action', 'Search')
							 ->where('is_deleted', 0)
							 ->whereBetween('action_on', array($stDate,$endDate))->get(); */
	}
	
	public function exportPopularSearchTerms()
	{
		$stDate = date('Y-m-d', strtotime(0));
		$tmp_Date = date('Y-m-d');
		$endDate = date('Y-m-d', strtotime($tmp_Date . ' + 1 day'));
		
		if(Input::has('frmpopularststartdate'))
		{
			$stDate = date('Y-m-d', strtotime(Input::get('frmpopularststartdate')));
		}
		if(Input::has('topopularstenddate'))
		{
			$endDate = date('Y-m-d', strtotime(Input::get('topopularstenddate').' + 1 day'));
		}	
		
		$query = 'select searchterm,count(*) as srchcnt from statistics where action=\'Search\' 
		and action_on between \''.$stDate.'\' and \''.$endDate.'\' group by searchterm order by srchcnt desc LIMIT 50 OFFSET 0';		
		$popularSearches = DB::select($query);
								
		$output=null;
		$output="#,Search Term,Search Count\n";
		foreach ($popularSearches as $index => $search) 
		{
			$temp = array();
			 $temp[] = $index+1;
			 $temp[] = $search->searchterm;
			 $temp[] = $search->srchcnt;
			 $temp[] = "\n";
			 $res=  implode(",",$temp);
			 $output = $output.$res;
		}
		return $output;
	}
	
	public function exportPopularOpenedDocuments()
	{
		$stDate = date('Y-m-d', strtotime(0));
		$tmp_Date = date('Y-m-d');
		$endDate = date('Y-m-d', strtotime($tmp_Date . ' + 1 day'));
		
		if(Input::has('frmpopulardocstartdate'))
		{
			$stDate = date('Y-m-d', strtotime(Input::get('frmpopulardocstartdate')));
		}
		if(Input::has('topopulardocenddate'))
		{
			$endDate = date('Y-m-d', strtotime(Input::get('topopulardocenddate').' + 1 day'));
		}	
		
		$query = 'select content,document_ids,count(*) as doccnt from statistics where action=\'Opened\' 
		and action_on between \''.$stDate.'\' and \''.$endDate.'\'  group by document_ids order by doccnt desc LIMIT 50 OFFSET 0';
		$popularDocs = DB::select($query);
		log::info($popularDocs);
		
		$output=null;
		$output="#,Document Title,Document Count\n";
		foreach ($popularDocs as $index => $doc) 
		{
			$temp = array();
			 $temp[] = $index+1;
			 $temp[] = $doc->content;
			 $temp[] = $doc->doccnt;
			 $temp[] = "\n";
			 $res=  implode(",",$temp);
			 $output = $output.$res;
		}
		return $output;
	}
	
	public function exportUserStatistics()
	{
		$stDate = date('Y-m-d', strtotime(0));
		$tmp_Date = date('Y-m-d');
		$endDate = date('Y-m-d', strtotime($tmp_Date . ' + 1 day'));
		
		if(Input::has('frmuserstatstartdate'))
		{
			$d=strtotime(Input::get('frmuserstatstartdate'));
			log::info($d);
			$stDate = date('Y-m-d', $d);
		}
		if(Input::has('enduserstatstartdate'))
		{
			
			$endDate = date('Y-m-d', strtotime(Input::get('enduserstatstartdate').' + 1 day'));
		}	
		log::info($stDate);
		log::info($endDate);
		$stats = array();
		$stats = Statistics::where('is_deleted', 0)
							 ->whereBetween('action_on', array($stDate,$endDate))->get();
		log::info($stats);
		
		
		$output="Date,IP Address,Username,Page,Action\n";
		foreach ($stats as $stat) 
		{
			$temp = array();
			 $temp[] = date('Y-m-d h:i:s',strtotime($stat->action_on));
			// $temp[] = date('G-i-s',strtotime($stat->action_on));
			 $temp[] = $stat->ip_address;
			 $temp[] = User::find($stat->user_id)->email;
			 $temp[] = "".$stat->content."";
			 $temp[] = $stat->action;
			 $temp[] = "\n";
			 $res=  implode(",",$temp);
			 $output = $output.$res;
		}
		return $output;
		
		/*$output=array();
		foreach ($stats as $stat) 
		{
			log::info('inside for loop');
			$temp = array();
			 $temp[] = $stat->action_on;
			 $temp[] = $stat->ip_address;
			 $temp[] = User::find($stat->user_id)->email;
			 $temp[] = $stat->content;
			 $temp[] = $stat->action;
			 $temp[] = "\n";
			 $res=  implode(",",$temp);
			 $output[] = $res;
		}
		$finoutput=implode(",",$output); */
    //return $finoutput;
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
