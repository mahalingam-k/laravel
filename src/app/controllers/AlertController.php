<?php

class AlertController extends SolrController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		log::info('Inside alert controller');
		$searchedResults = array();
		$searchedResults = SearchedTerms::where('alert_flag', 1)->get();
		//log::info($searchedResults);
		
		foreach($searchedResults as $result)
		{
			log::info('Searchedterm is');
			log::info($result->search_term);
			$filterQueryParams = array();
			$filterQueryParams[] = sprintf('titles:%s', $result->title);
			//$filterQueryParams[] = sprintf('id:%s', $result->search_term);
			$filterQueryParams[] = sprintf('parties:%s', $result->parties);
			$filterQueryParams[] = sprintf('citations:%s', $result->citation);
			$filterQueryParams[] = sprintf('judges:%s', $result->judges);
			
			if($result->to_date == null)
			{
				 $filterQueryParams[] = sprintf('dates:[%s TO %s]', 
				Document::convertDateToSolrFormat($result->from_date),
				Document::convertDateToSolrFormat(date('Y-m-d')));
				 
			}
			else
			{
				$filterQueryParams[] = sprintf('dates:[%s TO %s]', 
				Document::convertDateToSolrFormat($result->from_date),
				Document::convertDateToSolrFormat($result->to_date));
			}
			
			$query = $this->client->createSelect();
			$filterQueryString = '';	
			if($filterQueryParams) 
			{
				$filterQueryString = implode(' & ', $filterQueryParams);
				log::info($filterQueryString);
				$query->setQuery($result->search_term);
				$query->createFilterQuery('fq')->setQuery($filterQueryString);
			}
			$resultset = $this->client->select($query);
			log::info($resultset->getNumFound());
			
			$newResultSet = $this->fullsearch($result->search_term, $filterQueryString, $resultset->getNumFound());
			log::info($newResultSet->getNumFound());
			$newFilesAdded = $this->compareDocumentIDs($newResultSet,$result);
			log::info('new fields added');
			log::info($newFilesAdded);
			if(count($newFilesAdded)>0)
			{
				$newDocIds=$result->document_ids;
				foreach ($newFilesAdded as $index => $doc)
				{
					$newDocIds=$newDocIds.','.$doc;
				}
				log::info($newDocIds);
				$newCnt = $result->document_count + count($newFilesAdded);
				log::info($newCnt);
				$result->document_ids = $newDocIds;
				$result->document_count = $newCnt;
				$result->save();
			}
		}
	}
	
	public function compareDocumentIDs($resultset,$result)
	{
		//log::info($doc_ids);
		//$docIdArray = explode(',', $doc_ids);
		$integerIDs = array_map('intval', explode(',', $result->document_ids));
	//	log::info('integerIDs');
		log::info($integerIDs);
		
		$idCitationArray = array();
		foreach($resultset->getDocuments() as $doc)
		{		
			//log::info('doc id');
			//log::info($doc->id);
			$idCitationArray[$doc->id] = $doc->citation;
		}
		
	//	log::info('idCitationArray');
	//	log::info($idCitationArray);
		$idArray=array_keys($idCitationArray);
		
	//	log::info('idArray');
		log::info($idArray);
			
		$newFilesAdded = array_diff($idArray,$integerIDs);
	//	log::info('newFilesAdded');
	//	log::info($newFilesAdded);
		if(count($newFilesAdded)>0)
		{
			$finalAddedArray = array();
			$docs = null;
			$i=0;
			foreach($newFilesAdded as $newFile)
			{
				log::info($newFile);
				if(array_key_exists($newFile,$idCitationArray))
				{
					$finalAddedArray[$newFile] = $idCitationArray[$newFile];
					if($i<((count($newFilesAdded))-1))
					{
						$docs = $docs.$newFile.',';
					}
					else
					{
						$docs = $docs.$newFile;
					}
				}
				$i++;
			}
		//	log::info('finalAddedArray');
		//	log::info($finalAddedArray); 
			
			
			//log::info('unsubscribe id');
		//	log::info($result->id);
			//log::info(count($finalAddedArray));
			if(count($finalAddedArray)>0)
			{
				$protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https')=== FALSE ? 'http' : 'https';
				$host     = $_SERVER['HTTP_HOST'];
				$url = $protocol . '://' . $host;
				log::info($url);
				$st = $result->search_term;
				$user = User::find($result->user_id);
				if($user->is_banned == 0 && $user->is_deleted == 0 && $user->confirmed == 1)
				{
					$data = array('unsubscribeid' =>$result->id ,'firstname'=>$user->first_name, 'searchterm'=>$st,'docs'=>$finalAddedArray,'url'=>$url);
					log::info($data);
					
					 Mail::send('emails.alertfornewdocuments', $data, function($message)use($user) 
					{
						$message->to($user->email, $user->first_name)->subject('Alert for new documents added for your searched terms!');
						
					}); 
									
					$stats = new Statistics;
					$stats->document_count = count($finalAddedArray);
					$stats->document_ids = $docs;
					$stats->action_on = date('Y-m-d G:i:s');
					$stats->user_id = $user->id;
					$stats->content = $st;
					$stats->action='Alerts';
					$ip = $this->get_client_ip();
					$stats->ip_address = $ip;				
					$stats->is_deleted=0;
					$stats->save();
				}
				
			}
		}	
		return $newFilesAdded;
	}
	
	public function fullsearch($search_term,$filterQueryString,$numOfResults)
	{
		
		$query = $this->client->createSelect();
		
		$query->setQuery($search_term);
		$query->createFilterQuery('fq')->setQuery($filterQueryString);
			
		$query->setSorts(array($this->sortField => $this->sortDirection));
		$query->setStart(1);
		$query->setRows($numOfResults);
		
		$resultset = $this->client->select($query);
		
		return $resultset;
	}
	
	public function unSetAlerts($id=0)
	{
		log::info('Inside unSetAlerts');
		log::info($id);
		SearchedTerms::destroy($id);
		/*$st = SearchedTerms::find($id);
		$st->alert_flag = 0;
	//	$st->save();
		log::info($st->alert_flag); */
		Session::flash('unsetalert', 'yes');
		return Redirect::to('/');
	}

	public function get_client_ip()
	{
		$ipaddress = '';

		if (getenv('HTTP_CLIENT_IP'))
		{
			$ipaddress = getenv('HTTP_CLIENT_IP');
		}
		else if(getenv('HTTP_X_FORWARDED_FOR'))
		{
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		}
		else if(getenv('HTTP_X_FORWARDED'))
		{
			$ipaddress = getenv('HTTP_X_FORWARDED');
		}
		else if(getenv('HTTP_FORWARDED_FOR'))
		{
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		}
		else if(getenv('HTTP_FORWARDED'))
		{
			$ipaddress = getenv('HTTP_FORWARDED');
		}
		else if(getenv('REMOTE_ADDR'))
		{
			$ipaddress = getenv('REMOTE_ADDR');
		}
		else
		{
			$ipaddress = 'UNKNOWN';
		}
	
		return $ipaddress;
	}
	
	public function setAlertForUser()
	{
		log::info(Input::get('searchTermId'));
		session_start();
		$st = SearchedTerms::find($_SESSION["searchTermId"]);
		$st->alert_flag = 1;
		$st->save();
		$_SESSION["searchTermId"] = $st->id;
		$_SESSION["alertFlag"] = $st->alert_flag;
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
