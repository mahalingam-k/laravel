<?php

class SolrController extends FrontendController {

    /**
     * @var The SOLR client.
     */
    protected $client;

    // fields needed for sorting
    protected $sortParam = 'title';
    protected $sortField = 'title';
    protected $sortDirection = 'asc';
    protected $currentPage = 0;

    const RESULTS_PER_PAGE = 20;

    // --------------------------

    protected $uri = 'browse';

    /**
     * Constructor
     **/
    public function __construct()
    {
        // handle default behaviour
        parent::__construct();

        // create a client instance
        $this->client = new \Solarium\Client(Config::get('solr'));

        // create a ping query
        $ping = $this->client->createPing();

        // execute the ping query
        try {
            $result = $this->client->ping($ping);
        } catch (Solarium\Exception $e) {
            // the SOLR server is inaccessible, do something more meaningful
            error_log('Solr is not accessible!');
        }
    }

    public function getSearch($sortParam = 'title', $direction = 'asc', $page = 1) {
        $this->uri = 'search';
        $this->sortParam = $sortParam;
        $this->sortDirection = $direction;
        $this->currentPage = $page;
		//log::info('Inside get search');
        return $this->getIndex();
    }

    public function getIndex()
    {
      //  log::info('Inside get Index method');
		session_start();
  
              
		 
		$institutions = Institution::whereNotIn('name', ['Treaty Collection', 'Commentary Collection'])->get();
		$sortedInstitutions = array();
		//log::info($institutions);
		$institutionArray = array();
		foreach($institutions as $institution)
		{
		//	log::info($institution);
			$sortedInstitutions[$institution->name] = array(
			'id' => $institution->id,
			'name' => $institution->name,
			'document_count' => $institution->document_count);
			if(count($institution->subdivisions) == 0)
			{
				$institutionArray[$institution->name] = $institution->abbreviation;
			}
			else
			{
				$institutionArray[$institution->name] = $institution->abbreviation." ".$institution->subdivisions[0]->abbreviation;
			}
			//log::info(count($institution->subdivisions));
		}
		
		ksort($sortedInstitutions);
		//log::info($sortedInstitutions);
		$treatyAndCommentaryCollection = Institution::whereIn('name', ['Treaty Collection', 'Commentary Collection'])->get();
		//log::info($treatyAndCommentaryCollection);
		//$foo = MyModel::where('user_id', '=', $user_id)->whereNotIn( 'id', [1, 2, 7])->get();
        $selectedInstitutions = array();
		$searchString = "";
		$searchStringArray = array();
		for($i=1;$i<9; $i++)
		{
			$searchStringArray[$i] = '';
		}
		if(Input::has('searchstring'))
		{
			//log::info(Input::get('searchCriteriaArray'));
			$actualSearchString = Input::get('searchstring');
			//log::info($actualSearchString);
			$resArray = explode(',,',$actualSearchString);
			//log::info($resArray);
			foreach($resArray as $index => $res)
			{
				$splitArray = explode('*',$res);
				//log::info($splitArray);
				if($splitArray[0] == '1')
				{
					$searchStringArray[1] = $splitArray[1];
				}
				if($splitArray[0] == '2')
				{
					$searchStringArray[2] = $splitArray[1];
				}
				if($splitArray[0] == '3')
				{
					$searchStringArray[3] = $splitArray[1];
				}
				if($splitArray[0] == '4')
				{
					$searchStringArray[4] = $splitArray[1];
				}
				if($splitArray[0] == '5')
				{
					$searchStringArray[5] = $splitArray[1];
				}
				if($splitArray[0] == '6')
				{
					$searchStringArray[6] = $splitArray[1];
				}
				if($splitArray[0] == '7')
				{
					$searchStringArray[7] = $splitArray[1];
				}
				if($splitArray[0] == '8')
				{
					$searchStringArray[8] = $splitArray[1];
				}
			}			
		}
		//log::info($searchStringArray);
        if (Input::has('q') || Input::has('doctype') || Input::has('judges') || Input::has('judges') || Input::has('citation') || Input::has('parties') || Input::has('title')
		  || Input::has('from') || Input::has('to')) {

            $this->handleSortParams();
			$queryString = null;
			$filterQueryString = null;
            // Create a search query
            $query = $this->client->createSelect();
            // set sort direction and column + select specified amount of documents
            $query->setSorts(array($this->sortField => $this->sortDirection));
            $query->setStart(($this->currentPage - 1) * static::RESULTS_PER_PAGE);
            $query->setRows(static::RESULTS_PER_PAGE);

            $string = Input::get('q');
			$searchString = "1*".$string;
            $queryParams[] = $string;
            $filterQueryParams = array();

            if(Input::has('institution')) {
                $selectedInstitutions = Input::get('institution');
                $institutionSearch ='';

                $count = 0;
                foreach($selectedInstitutions as $institution) {
                    $institutionObject = Institution::find($institution);
                    if($institutionObject) {
                        $institutionSearch .= ($institutionSearch ? ' OR ' : '') . sprintf(sprintf('institution_s:"%s"', $institutionObject->name));
                        $count++;
                    }
                }
                if($count > 1) {
                    $institutionSearch = '(' . $institutionSearch . ')';
                }
                if($count) {
                    $queryParams[] = $institutionSearch;
                }
            }

            if(Input::has('doctype')) {
                $filterQueryParams[] = sprintf('document_type:%s', Input::get('doctype'));
				$doctype = Input::get('doctype');
				$searchString = $searchString.",,6*".$doctype;
            }
			
			if(Input::has('judges')) {
                $filterQueryParams[] = sprintf('decided_by:%s', Input::get('judges'));
				//$filterQueryParams[] = sprintf('represented_by:%s', Input::get('judges'));
				$judges = Input::get('judges');
				$searchString = $searchString.",,5*".$judges;
            }

            if(Input::has('citation')) {
                $filterQueryParams[] = sprintf('citation:%s', Input::get('citation'));
				$citation = Input::get('citation');
				$searchString = $searchString.",,4*".$citation;
            }

            if(Input::has('parties')) {
                $filterQueryParams[] = sprintf('victims:%s', Input::get('parties'));
				$parties = Input::get('parties');
				$searchString = $searchString.",,3*".$parties;
            }

            if(Input::has('title')) {
                $filterQueryParams[] = sprintf('search_title:%s', Input::get('title'));
				$title = Input::get('title');
				$searchString = $searchString.",,2*".$title;
            }
			
            if (Input::has('from') || Input::has('to')) {

                if(Input::has('from') && Input::has('to')) {
					$fromDt = Input::get('from');
					$toDt = Input::get('to');
					$searchString = $searchString.",,7*".$fromDt.",,8*".$toDt;
                    // use provided date range
                    $filterQueryParams[] = sprintf(
                        'dates:[%s TO %s]',
                        Document::convertDateToSolrFormat(Input::get('from')),
                        Document::convertDateToSolrFormat(Input::get('to'))
                    );
                } elseif(Input::has('from')) {
					$fromDt = Input::get('from');
					$searchString = $searchString.",,7*".$fromDt." ";
                    // from provided date until now (there are no future rulings here)
                    $filterQueryParams[] = sprintf(
                        'dates:[%s TO %s]',
                        Document::convertDateToSolrFormat(Input::get('from')),
                        Document::convertDateToSolrFormat(date('Y-m-d'))
                    );
                } else {
                    // search up until now (assumed lowest date 1. Jan 1800 )
					$toDt = Input::get('to');
					$searchString = $searchString.",, ,,8*".$toDt;
                    $filterQueryParams[] = sprintf(
                        'dates:[%s TO %s]',
                        Document::convertDateToSolrFormat('1800-01-01'),
                        Document::convertDateToSolrFormat(Input::get('to'))
                    );
                }
            }
			//log::info('search string is: ');
			//log::info($searchString);
            if($queryParams && Input::has('q')) {
                $queryString = implode(' AND ', $queryParams);
            } else {
                $queryString = '*:*';
            }
            $query->setQuery($queryString);

            log::info($filterQueryParams);
			if($filterQueryParams) {
                $filterQueryString = implode(' AND ', $filterQueryParams);
					if(Input::has('judges')) {
						//$filterQueryParams[] = sprintf('decided_by:%s', Input::get('judges'));
						$filterQueryString = $filterQueryString." ".sprintf('OR represented_by:%s', Input::get('judges'));
						
					}
					if(Input::has('parties'))
					{
						$filterQueryString = $filterQueryString." ".sprintf('OR applicant:%s', Input::get('parties'));
						$filterQueryString = $filterQueryString." ".sprintf('OR respondent:%s', Input::get('parties'));
					}
				log::info($filterQueryString);
                $query->createFilterQuery('fq')->setQuery($filterQueryString);
            }

            $query->addField(sprintf("hits:termfreq(text,'%s')", $string));

            $hl = $query->getHighlighting();
            $hl->setFields(array('search_title, body, institution'));
            $hl->setSnippets(10000);
            $hl->setFragSize(300);
            $hl->setSimplePrefix('<span class="highlight">');
            $hl->setSimplePostfix('</span>');
			
            $resultset = $this->client->select($query);
			//log::info('resultscount');
			
			log::info($resultset->getNumFound());
			$ids = null;
			$i=1;
			$hits =null;
			foreach($resultset->getDocuments() as $doc)
			{
				
				if($i < $resultset->getNumFound())
				{
					//log::info('true');
					$ids = $ids.$doc->id.',';
					$hits =$hits.$doc->hits.',';
				}
				else
				{
					//log::info('false');
					$ids = $ids.$doc->id;
					$hits =$hits.$doc->hits;
				}
				
				$i++;
			}
			//log::info($ids);
			//log::info($hits);
			
			$searchedTerm = null;
			
			if(Auth::check())
			{
				$newResultSet = $this->fullSearch($queryString,$filterQueryString,$resultset->getNumFound());
				$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			//	log::info($actual_link);
				
				if (strpos($actual_link,'search/title/asc') !== false) 
				{
					log::info('coming from second page');
					$searchedTerm = new SearchedTerms();
					
					$searchedTerm->id = Input::get('searchTermId');
					$searchedTerm->alert_flag = Input::get('alertFlag');
					$stid = $_SESSION["searchTermId"];
					$af = $_SESSION["alertFlag"];
				//	log::info($stid);
				//	log::info($af);
				}
				else
				{
					log::info('coming from first page');
					$searchedTerm = $this->saveSearchedTerms($newResultSet);
					$_SESSION["fullSearchResults"] = $newResultSet;
					$_SESSION["searchTermId"] = $searchedTerm->id;
					$_SESSION["alertFlag"] = $searchedTerm->alert_flag;
				}
				
			}
			else
			{
				$_SESSION["alertFlag"] = 0;
				$_SESSION["searchTermId"] = 0;
			}
            $highlighting = $resultset->getHighlighting();
            $highlights = array();
            foreach($highlighting as $id => $highlight) {
				$tempArray = array();
			//	log::info($highlighting->getResult($id)->getField('body'));
				foreach($highlighting->getResult($id)->getField('body') as $snippet)
				{
					log::info($snippet);
					$resArray =  $this->getTaggedString($snippet);
					 $tempArray[] = $resArray;
				}
               $highlights[$id] = array(
                   'search_title' => $highlighting->getResult($id)->getField('search_title'),
                   'body' => preg_replace('~\{(.+?)\}~', '', $tempArray),
                   'institution' => $highlighting->getResult($id)->getField('institution')
               );
			
            }
			//print_r($highlights); exit;
			log::info($highlights);
			//log::info('search string');
			//log::info($searchString);
			$finalSearchString = $this->prepareSearhString($searchString, $resultset->getNumFound());
			$_SESSION["finalSearchString"] = $finalSearchString;
			$_SESSION["documentCnt"] = $resultset->getNumFound();
			$_SESSION["searchstring"] = $searchString;
			$_SESSION["searchterm"] = Input::get('q');
			$_SESSION["search_page"] = 'true';
			$_SESSION["institutionArray"] = $institutionArray;
			log::info($this->getPagination($resultset->getNumFound()));
            // Pass the resultset to the view and return.
            return View::make('search.searchresults', array(
                'resultset' => $resultset,
				'searchedTerm' => $searchedTerm,
				'ids' => $ids,
				'hits' => $hits,
                'highlights' => $highlights,
				'treatyAndCommentaryCollection' => $treatyAndCommentaryCollection,
                'institutions' => $sortedInstitutions,
                'selectedInstitutions' => $selectedInstitutions,
                'sortParam' => $this->sortField,
                'tableHeader' => $this->getTableHeader(),
                'pagination' => $this->getPagination($resultset->getNumFound()),
            ));

        }
		
		if(isset($_SESSION['resettoken']) == false)
		{
			$_SESSION['resettoken'] = '';
		}
		if((Session::get('from'))!='fromexternallink')
		{
			Session::flash('userconfirmed', 'no');
			Session::flash('passwordresetted', 'no');
		}
		else
		{
			Session::flash('userconfirmed', 'yes');
			if(Session::get('passwordresetted') == 'yes')
			{
				log::info('passwordresetted');
				Session::flash('passwordresetted', 'yes');
			}
			if(Session::get('reset') == 'yes')
			{
				log::info('reset');
				Session::flash('passwordresetted', 'no');
				Session::flash('reset', 'yes');
				Session::flash('userconfirmed', 'no');
			}
		}
		
		$_SESSION['searchstring'] = '';
		$_SESSION['documentCnt'] = '';
		$_SESSION['alertFlag'] = 0;
		$_SESSION["searchterm"] = '';
        return View::make('search.index', array('searchStringArray' => $searchStringArray,'treatyAndCommentaryCollection' => $treatyAndCommentaryCollection,'institutions' => $sortedInstitutions));    }
	
	public function prepareSearhString($actualString,$cnt)
	{
		//log::info($actualString);
		$finalString = $cnt.' documents found for ';
		$resultStringArray = explode(',,', $actualString);
		foreach($resultStringArray as $result)
		{
			if($result!='empty')
			{
				$res=explode('*', $result);
				if($res[0] == '1')
				{
					
					if($res[1] != '')
					{
					$finalString = $finalString."\"".$res[1]."\"";
					}
				}
				if($res[0] == '2')
				{
					if(Input::has('q') || Input::has('parties') || Input::has('citation') || Input::has('judges') || Input::has('doctype'))
					{
					$finalString = $finalString." + Title: ".$res[1];
					}
					else
					{
						$finalString = $finalString." Title: ".$res[1];
					}
				}
				if($res[0] == '3')
				{
					if(Input::has('q') || Input::has('citation') || Input::has('judges') || Input::has('doctype'))
					{
						$finalString = $finalString." + Parties: ".$res[1];
					}
					else
					{
						$finalString = $finalString." Parties: ".$res[1];
					}
				}
				if($res[0] == '4')
				{
					if(Input::has('q') || Input::has('judges') || Input::has('doctype'))
					{
						$finalString = $finalString." + Citation: ".$res[1];
					}
					else
					{
						$finalString = $finalString." Citation: ".$res[1];
					}
				}
				if($res[0] == '5')
				{
					if(Input::has('q') || Input::has('doctype'))
					{
						$finalString = $finalString." + Judge/Counsel: ".$res[1];
					}
					else
					{ 
						$finalString = $finalString." Judge/Counsel: ".$res[1];
					}
				}
				if($res[0] == '6')
				{
					if(Input::has('q'))
					{
						$finalString = $finalString." + Document Type: ".$res[1];
					}
					else
					{
						$finalString = $finalString." Document Type: ".$res[1];
					}
				}
				if($res[0] == '7')
				{
					if(Input::has('q') || Input::has('title') || Input::has('parties') || Input::has('citation') || Input::has('judges') || Input::has('doctype'))
					{
						$finalString = $finalString." + Dates: ".$res[1];
					}
					else
					{
						$finalString = $finalString." Dates: ".$res[1];
					}
				}
				if($res[0] == '8')
				{
					if(Input::has('from'))
					{
						$finalString = $finalString." to ".$res[1];
					}
					else if(Input::has('q') || Input::has('title') || Input::has('parties') || Input::has('citation') || Input::has('judges') || Input::has('doctype'))
					{
						$finalString = $finalString." + Dates: ".$res[1];
					}
					else
					{
						$finalString = $finalString." Dates: ".$res[1];
					}
				}
				//$finalString = $finalString." ".$result;
			}
		}
		
		//log::info($finalString);
		return $finalString;
	}
	
	public function getTaggedString($string)
	{
	
		$newString = $string; 
		if(strpos($newString,'<span') !== false)
		{
			$newString = str_replace('<span class="highlight">','',$newString);
		}
		if(strpos($newString,'<p>') !== false)
		{
			$newString = str_replace('<p>','',$newString);
		}
		if(strpos($newString,'<br>') !== false)
		{
			$newString = str_replace('<br>','',$newString);
		}
		
		if(strpos($newString,'</span>') !== false)
		{
			$newString = str_replace('</span>','',$newString);
		}
		
		preg_match_all("/<(.*?)>/", $newString, $results);
		
		$linkAddedBody = $newString;
		
		$i=0;
		$documentReferences = DocumentReferences::all();
		$name = null;
		foreach($results['0'] as $val)
		{
			
			foreach($documentReferences as $ref)
			{			
				$res = strcmp($ref->key_name,$results[1][$i]);
				if($res==0)
				{
					if($ref->value_name!=null)
					{
						
						$myArray = explode(',', $ref->key_name);
						if(count($myArray)==1)
						{
							
							preg_match("/{(.*)}/", $ref->key_name, $curlyBracketContent);
							
							$contentAfterCurlyBracket = explode('}', $ref->key_name);
							
							if(isset($contentAfterCurlyBracket[1])){
								$name = preg_replace('/\s+/', '', $contentAfterCurlyBracket[1]);
							}else{	
								$name = '';
							}	
							//$url = $ref->value_name.'/'.$name;
							$url = 'document/'.$ref->value_name;
							$content = '<a href="javascript:void(0)" onclick="window.open(\''.$url.'\',\'real title\',\'width=800,height=400,menubar=yes,status=yes,location=yes,toolbar=yes,scrollbars=yes\')">'.$name.'</a>';
							
							$linkAddedBody = str_replace($val,$content,$linkAddedBody);
							break;
						}
						else
						{
							$url = 'document/'.$ref->value_name;
							$content = '<a href="javascript:void(0)" onclick="window.open(\''.$url.'\',\'real title\',\'width=800,height=400,menubar=yes,status=yes,location=yes,toolbar=yes,scrollbars=yes\')">'.$results[1][$i].'</a>';
							
							$linkAddedBody = str_replace($val,$content,$linkAddedBody);
							break;
						}
					}
					else
					{
						$linkAddedBody = str_replace($val,$results[1][$i],$linkAddedBody);
						break;
					}
					
				}
				else
				{
					
				}
			}		
			
			$i++;
		}
		
		preg_match_all('/<span class="highlight">(.*?)<\/span>/', $string, $newResults);
		//log::info($newResults);
		
		$i=0;
		foreach($newResults['1'] as $tags)
		{
			//log::info($tags);
			if(strpos($linkAddedBody,$newResults['1'][$i]) !== false)
			{
				$linkAddedBody = str_replace($newResults['1'][$i],$newResults['0'][$i],$linkAddedBody);
			}
			$i++;
		}
		
		return $linkAddedBody;
	}
	
	public function fullSearch($queryString,$filterQueryString,$numOfResults)
	{
		log::info('Inside full search');
		$this->handleSortParams();

		// Create a search query
		$query = $this->client->createSelect();
		// set sort direction and column + select specified amount of documents
		$query->setSorts(array($this->sortField => $this->sortDirection));
		$query->setStart(($this->currentPage - 1) * static::RESULTS_PER_PAGE);
		$query->setRows($numOfResults);

		$string = Input::get('q');    
		$query->setQuery($queryString);
		$query->createFilterQuery('fq')->setQuery($filterQueryString);
	   

		$query->addField(sprintf("hits:termfreq(text,'%s')", $string));

		$hl = $query->getHighlighting();
		$hl->setFields(array('title, body, institution'));
		$hl->setSnippets(10000);
		$hl->setFragSize(300);
		$hl->setSimplePrefix('<span class="highlight">');
		$hl->setSimplePostfix('</span>');

		$resultset = $this->client->select($query);
		//log::info($resultset->getNumFound());
		log::info('end of full research method');
		
		return $resultset;
		/*foreach($resultset->getDocuments() as $doc)
		{
			log::info($doc->id);
		} */
	}

	public function saveSearchedTerms($res)
	{
		log::info('Inside saveSearchedTerms method');
		//log::info($res->getNumFound());
	//	log::info($res->getDocuments()['0']['id']);
		$doc_ids = null;
		$i=1;
		foreach($res->getDocuments() as $doc)
		{
			if($i < $res->getNumFound())
			{
				
				$doc_ids = $doc_ids.$doc->id.',';
			}
			else
			{
				
				$doc_ids = $doc_ids.$doc->id;
			}
			$i++;
		}
		//log::info($doc_ids);
		$searchedTerms = new SearchedTerms;
		$stats = new Statistics;
		
		$searchedTerms->document_count = $res->getNumFound();
		$stats->document_count = $res->getNumFound();
		
		$searchedTerms->document_ids = $doc_ids;
		$stats->document_ids = $doc_ids;
		
		$searchedTerms->searched_on = date('Y-m-d G:i:s');
		$stats->action_on = date('Y-m-d G:i:s');
		
		$searchedTerms->user_id = Auth::user()->id;
		$stats->user_id = Auth::user()->id;
		
		$filterQueryParams = array();
		$fDate=null;
		$tDate=null;
		if(Input::has('q'))
		{			
			$searchedTerms->search_term = Input::get('q');
			$filterQueryParams[] =  sprintf('Text=%s', '\''.Input::get('q').'\'');
			$stats->searchterm = Input::get('q');
		}
		if(Input::has('title'))
		{
			$searchedTerms->title = Input::get('title');	
			$filterQueryParams[] =  sprintf('Title=%s', '\''.Input::get('title').'\'');
		}
		if(Input::has('judges')) 
		{
			$searchedTerms->judges = Input::get('judges');
			$filterQueryParams[] =  sprintf('Judges=%s', '\''.Input::get('judges').'\'');
        }
		if(Input::has('citation')) 
		{
			$searchedTerms->citation = Input::get('citation');	
			$filterQueryParams[] =  sprintf('Citation=%s', '\''.Input::get('citation').'\'');			
		}
		if(Input::has('parties')) 
		{
			$searchedTerms->parties = Input::get('parties');
			$filterQueryParams[] =  sprintf('Parties=%s', '\''.Input::get('parties').'\'');			
		}
		if(Input::has('doctype')) 
		{
			$searchedTerms->parties = Input::get('doctype');
			$filterQueryParams[] =  sprintf('Doctype=%s', '\''.Input::get('doctype').'\'');			
		}	
		if (Input::has('from')) 
		{
			$searchedTerms->from_date = Input::get('from');	
			//$fDate = date('d-m-Y',Input::get('from'));
			$dateObj = DateTime::createFromFormat('Y-m-d', Input::get('from'));
			$fDate = $dateObj->format('d/m/Y');

		}
		if (Input::has('to')) 
		{
			$searchedTerms->to_date = Input::get('to');
			//$tDate = date('d-m-Y',Input::get('to'));
			$dateObj = DateTime::createFromFormat('Y-m-d', Input::get('to'));
			$tDate = $dateObj->format('d/m/Y');
		}
		/*if (Input::has('alert')) 
		{
			$searchedTerms->alert_flag = Input::get('alert');                        
		}
		else
		{ */
			$searchedTerms->alert_flag = 0 ;
		/*} */
		if($fDate!='' || $tDate!='')
		{
			$filterQueryParams[] = sprintf(
                        'Date=\'%s-%s\'', $fDate, $tDate);
		}
		
		$filterQueryString = implode(' AND ', $filterQueryParams);
		$stats->content = $filterQueryString;
		$stats->action='Search';
		$stats->is_deleted=0;
		$ip = $this->get_client_ip();
		$stats->ip_address = $ip;

		$stats->save();
		//log::info($filterQueryString);
		$foundUsers = $this->checkForDuplicateSearch($searchedTerms);
		if(count($foundUsers)>0)
		{
			log::info('updating same row');
			//log::info($foundUsers[0]->id);
			$searchedTerm = SearchedTerms::find($foundUsers[0]->id);
			//log::info($searchedTerm[0]->id);
			//$searchedTerm = $foundUsers[0];
			//$searchedTerm->id = $foundUsers[0]->id;
			$searchedTerm->document_ids = $doc_ids;
			$searchedTerm->document_count = $res->getNumFound();
			$searchedTerm->updated_at = date('Y-m-d G:i:s');
		//	$searchedTerm->save();
			$searchedTerms->save();
			
		}
		else
		{
			log::info('inserting new row');
			$searchedTerms->save();
			$searchedTerm = $searchedTerms;
		}
		
		return $searchedTerm;
	}
	
	public function checkForDuplicateSearch($searchedTerms)
	{
		$searchedUsers = SearchedTerms::where('alert_flag', 1)
		->where('search_term', $searchedTerms->search_term)
		->where('user_id', Auth::user()->id)
		->where('title', $searchedTerms->title)
		->where('parties', $searchedTerms->parties)
		->where('citation', $searchedTerms->citation)
		->where('judges', $searchedTerms->judges)
		->where('from_date', $searchedTerms->from_date)
		->where('to_date', $searchedTerms->to_date)->get();
		//log::info($searchedUsers);
		return $searchedUsers;
	}
	
	public function emailResults($res=null,$hits=null)
	{
		log::info('Inside email method');
		
		$cnt = $this->getFileInformation($res,$hits);
		
		$path='/srv/users/serverpilot/apps/laravel(demo)/app/storage/search_results_'.Auth::user()->email.'.rtf';
	//	$path='/var/www/laravel(demo)/app/storage/search_results_'.Auth::user()->email.'.rtf';
	//	$path='__DIR__'.'/../app/storage/search_results_'.Auth::user()->email.'.rtf';
		
		$user = Auth::user();
		$valuesArray = array();
		$usernotification = UserNotification::where('notification_code', 2)->get();
			//log::info($usernotification);
			if(count($usernotification) == 1)
			{
				$msg = $usernotification[0]->message;
				if($msg != '')
				{
					//$sub = $usernotification[0]->subject;
					
					$valuesArray['email'] = $user->email;
					$valuesArray['viewpage'] = 'emails.resultsdelivery';
					$valuesArray['subject'] = $usernotification[0]->subject;
					$valuesArray['path'] = $path;
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
										
					$data = array('email'=>$user->email,'path'=>$path);
			
					Mail::send('emails.resultsdelivery', $data, function($message) use($data)
					{
						$message->to($data['email'], $data['email'])->subject('Delivery document of Searched Results!');
						$message->attach($data['path']);
					});
				}
				
			}
			else
			{
				$data = array('email'=>$user->email,'path'=>$path);
		
				Mail::send('emails.resultsdelivery', $data, function($message) use($data)
				{
					$message->to($data['email'], $data['email'])->subject('Delivery document of Searched Results!');
					$message->attach($data['path']);
				});
			}
		
		
		
	/*	Mail::send('emails.resultsdelivery', array('firstname'=>Auth::user()->first_name), function($message)use ($path) 
		{
			$message->to(Auth::user()->email, Auth::user()->first_name)->subject('Delivery document of Searched Results!');
			$message->attach($path);

		}); */ 
		
		$stats = new Statistics;
		$stats->document_count = $cnt;
		$stats->document_ids = $res;
		$stats->action_on = date('Y-m-d G:i:s');
		$stats->user_id = Auth::user()->id;
		$stats->content = $_SESSION["searchterm"];
		$stats->is_deleted=0;
		$stats->action='Emailed';
		$ip = $this->get_client_ip();
		$stats->ip_address = $ip;
		$stats->save();
		
	}
	
	public function saveDownloadStatisticsForResults($res=null,$hits=null)
	{
		$cnt = $this->getFileInformation($res,$hits);
		$stats = new Statistics;
		$stats->document_count = $cnt;
		$stats->document_ids = $res;
		$stats->action_on = date('Y-m-d G:i:s');
		$stats->user_id = Auth::user()->id;
		$stats->content = $_SESSION["searchterm"];
		$stats->is_deleted=0;
		$stats->action='Downloaded';
		$ip = $this->get_client_ip();
		$stats->ip_address = $ip; 
		$stats->save();
			
	}
	
	public function saveDownloadStatisticsForDocument($id=0)
	{
		$query = $this->client->createRealtimeGet();
		$query->addId($id);
		$resultset = $this->client->select($query);
		$document = $resultset->getDocuments()[0];
		
		$stats = new Statistics;
		$stats->document_count = 1;
		$stats->document_ids = $document->id;
		$stats->action_on = date('Y-m-d G:i:s');
		$stats->user_id = Auth::user()->id;
		$stats->content = $document->title;
		$stats->action='Downloaded';
		$ip = $this->get_client_ip();
		$stats->ip_address = $ip;
		$stats->is_deleted=0;
		$stats->save();
	}
	
	public function downloadResults($res=null,$hits=null)
	{
		
		$cnt = $this->getFileInformation($res,$hits);
		log::info('before returning');
		/*$stats = new Statistics;
		$stats->document_count = $cnt;
		$stats->document_ids = $res;
		$stats->action_on = date('Y-m-d G:i:s');
		$stats->user_id = Auth::user()->id;
		$stats->content = $_SESSION["searchterm"];
		$stats->is_deleted=0;
		$stats->action='Downloaded';
		$ip = $this->get_client_ip();
		$stats->ip_address = $ip; 
		$stats->save(); */
		
		//$path='/var/www/laravel(demo)/app/storage/search_results_'.Auth::user()->email.'.rtf';
		//$path='/var/www/laravel(demo)/app/storage/search_results_'.Auth::user()->email.'.rtf';
		$path='/srv/users/serverpilot/apps/laravel(demo)/app/storage/search_results_'.Auth::user()->email.'.rtf';
			  
        $headers = array(
              'Content-Type: text/rtf',
			  'charset:us-ascii'
            );
        return Response::download($path, 'search_results_'.Auth::user()->email.'.rtf', $headers);
	}
	
	
	public function getFileInformation($res,$hits)
	{
		$docIdArray = explode(',', $res);
		$hitsArray = explode(',', $hits);
		$modifiedHitsArray = array();
		$filterQueryParams = array();
		$i=0;
		foreach($docIdArray as $docId)
		{
			if($docId != '')
			{
				$filterQueryParams[] = sprintf('id:%s', $docId);
				//$hitsArray[$docId]=$hitsArray[$i];
				$modifiedHitsArray[$docId]=$hitsArray[$i];
				$i++;
			}
		}
		 
		$query = $this->client->createSelect();
				
		if($filterQueryParams) 
		{
			$filterQueryString = implode(' & ', $filterQueryParams);
		//	log::info($filterQueryString);
			$query->createFilterQuery('fq')->setQuery($filterQueryString);
        }
		
		//$resultset = $this->client->select($query);
		session_start();
		$fullSearchResults = $_SESSION["fullSearchResults"];
		//$hitsArray = $_SESSION["searchHits"];
		$hitsForSearchResults = array();
		
		foreach($fullSearchResults->getDocuments() as $doc)
		{
			log::info($doc->hits);
			$hitsForSearchResults[$doc->id] =$doc->hits;
		}
		//log::info($fullSearchResults);
		//log::info($resultset->getDocuments());
		$this->getRTFContent($fullSearchResults->getDocuments(),$fullSearchResults->getNumFound(),$hitsForSearchResults);
		return count($docIdArray);
	}

	public function getRTFContent($documents,$docCount,$hitsArray)
	{
		
		$i = 2;
		$mainArray = array();
		$mainArray[1] = array(1=>'TITLE',2=>'DOCUMENT TYPE',3=>'DATABASE',4=>'DATE',5=>'HITS');
		$mainArray[2] = array(1=>'',2=>'',3=>'',4=>'',5=>'');
		log::info($_SESSION["institutionArray"]);
		foreach($documents as $doc)
		{
			
			$nestArray = array();
			$nestArray[1] = $doc->title;
			$nestArray[2] = $doc->document_type;
			if($doc->institution != '')
			{
				$nestArray[3] = $_SESSION["institutionArray"][$doc->institution];
			}
			else
			{
				$nestArray[3] = '';
			}
			$nestArray[4] = date('d-M-Y',strtotime(Document::convertDateFromSolrFormat($doc->date, Document::DATE_FORMAT_NICE)));
			$nestArray[5] = $hitsArray[$doc->id];
			$mainArray[$i+1] = $nestArray;
			$i++;
		}
		//log::info($mainArray);
		//log::info(__DIR__);
		
		//require_once '/var/www/laravel(demo)/vendor/phprtflite/phprtflite/lib/PHPRtfLite.php';
		require_once '/srv/users/serverpilot/apps/laravel(demo)/vendor/phprtflite/phprtflite/lib/PHPRtfLite.php';
		//require_once '__DIR__'.'/../vendor/phprtflite/phprtflite/lib/PHPRtfLite.php';
		$rowCount = $docCount+2;
		$rowHeight = 0.5;
		$columnCount = 5;
		$columnWidth = 3.5;
		PHPRtfLite::registerAutoloader();
		
		$rtf = new PHPRtfLite();
		$rtf->setMargins(3, 3, 3, 3);
		
		$sect = $rtf->addSection();
		$sect->setMargins(3, 3, 3, 3);

		//$sect->writeText('Delivery document for Search Results in RTF format', new PHPRtfLite_Font(), new PHPRtfLite_ParFormat());
		
		$rcnt=2;
		$rhgt=1;
		$table1 = $sect->addTable();
		$table1->addRows($rcnt, $rhgt);
		$table1->addColumnsList(array_fill(0, 1, 15));
		for($rindex = 1; $rindex < 3; $rindex++)
		{
			for ($cindex = 1; $cindex < 2; $cindex++) 
			{
				$cell = $table1->getCell($rindex, $cindex);
				if($rindex == 1)
				{
					$cell->writeText('<b> World</b>', new PHPRtfLite_Font(12, 'Calibri', '', ''));
					$cell->writeText('<b>Courts</b>', new PHPRtfLite_Font(12, 'Calibri', '#BDBDBD', ''));
				}
				else
				{
					//$str = ' Search String: "international law" + Inst: PCIJ + Judge/Counsel: Smith + Dates: 01-Jan-1929 to 03-Feb-1930<br>';
					$pos = strpos($_SESSION["finalSearchString"], '"');
				
					$cell->writeText('<br> Search String: '.substr($_SESSION["finalSearchString"],$pos).'<br>', new PHPRtfLite_Font(10, 'Times New Roman', '', ''));
					$cell->writeText(' Found: '.$docCount.' documents<br>', new PHPRtfLite_Font(10, 'Times New Roman', '', ''));
					$cell->writeText(' Date: '.date('d-M-Y G:i').'<br>', new PHPRtfLite_Font(10, 'Times New Roman', '', ''));
					$cell->writeText(' User: '.Auth::user()->email, new PHPRtfLite_Font(10, 'Times New Roman', '', ''));
				}
			}
			
		}
		
		$table = $sect->addTable();
		$table->addRows($rowCount, $rowHeight);
		//$table->addColumnsList(array_fill(0, $columnCount, $columnWidth));
		$table->addColumnsList(array(5,4,2,2,2));
		
		
		$parSimple = new PHPRtfLite_ParFormat('center');
	//	$par->setIndentLeft(10);
	//	$parSimple->setBackgroundColor('#BDBDBD');
	//	$par->setSpaceBetweenLines(2);

		for ($rowIndex = 1; $rowIndex <= $rowCount; $rowIndex++) {
			for ($columnIndex = 1; $columnIndex <= $columnCount; $columnIndex++) {
				$cell = $table->getCell($rowIndex, $columnIndex);
				//$cell->writeText("Cell $rowIndex:$columnIndex");
				if($rowIndex == 1)
				{
					$cell->writeText('<b>'.$mainArray[$rowIndex][$columnIndex].'</b>', new PHPRtfLite_Font(10, 'Times New Roman', '', ''), $parSimple);
					$cell->setBackgroundColor('#BDBDBD');
					$cell->setTextAlignment(PHPRtfLite_Table_Cell::TEXT_ALIGN_CENTER);
				}
				else
				{
					$cell->writeText($mainArray[$rowIndex][$columnIndex], new PHPRtfLite_Font(10, 'Times New Roman', '', '')) ;
					$cell->setTextAlignment(PHPRtfLite_Table_Cell::TEXT_ALIGN_CENTER);
				}
				
				$cell->setVerticalAlignment(PHPRtfLite_Table_Cell::VERTICAL_ALIGN_CENTER);
			}
		}

		$borderTop = new PHPRtfLite_Border($rtf);
	//	$borderTop->setBorderTop(new PHPRtfLite_Border_Format(2, '#f33'));
		$table->setBorderForCellRange($borderTop, 1, 1, 1, $columnCount);
		$borderBottom = new PHPRtfLite_Border($rtf);
	//	$borderBottom->setBorderBottom(new PHPRtfLite_Border_Format(2, '#33f'));
		$table->setBorderForCellRange($borderBottom, $rowCount, 1, $rowCount, $columnCount);

	//	$rtf->save('__DIR__'.'/../app/storage/search_results_'.Auth::user()->email.'.rtf');
		//$rtf->save('/var/www/laravel(demo)/app/storage/search_results_'.Auth::user()->email.'.rtf');
		$rtf->save('/srv/users/serverpilot/apps/laravel(demo)/app/storage/search_results_'.Auth::user()->email.'.rtf');
	}
	
	public function emailDocument($id=0)
	{
		log::info('Inside email document');
		
		$query = $this->client->createRealtimeGet();
		$query->addId($id);
		$resultset = $this->client->select($query);
		$document = $resultset->getDocuments()[0];
		//log::info($resultset->getDocuments());
		$this->getDocumentInRTFFormat($document);
		
		//$path='__DIR__'.'/../app/storage/searched_document.rtf';
		//$path='/var/www/laravel(demo)/app/storage/'.$document->short_citation.'.rtf';
		$path='/srv/users/serverpilot/apps/laravel(demo)/laravel(demo)/app/storage/'.$document->short_citation.'.rtf';
		//$path='__DIR__'.'/..//app/storage/'.$document->short_citation.'.rtf';
		
		$user = Auth::user();
		$valuesArray = array();
		$usernotification = UserNotification::where('notification_code', 3)->get();
			//log::info($usernotification);
			if(count($usernotification) == 1)
			{
				$msg = $usernotification[0]->message;
				if($msg != '')
				{
					//$sub = $usernotification[0]->subject;
					
					$valuesArray['email'] = $user->email;
					$valuesArray['viewpage'] = 'emails.documentdelivery';
					$valuesArray['subject'] = $usernotification[0]->subject;
					$valuesArray['path'] = $path;
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
					$data = array('email'=>$user->email,'path'=>$path);
			
					Mail::send('emails.documentdelivery', $data, function($message) use($data)
					{
						$message->to($data['email'], $data['email'])->subject('Delivery of searched document!');
						$message->attach($data['path']);
					});
				}
				
			}
			else
			{
				$data = array('email'=>$user->email,'path'=>$path);
			
				Mail::send('emails.documentdelivery', $data, function($message) use($data)
				{
					$message->to($data['email'], $data['email'])->subject('Delivery of searched document!');
					$message->attach($data['path']);
				});
			}
		
		/*
		Mail::send('emails.documentdelivery', array('firstname'=>Auth::user()->first_name), function($message)use ($path) 
		{
			$message->to(Auth::user()->email, Auth::user()->first_name)->subject('Delivery of searched document!');
			$message->attach($path);

		}); */
		
		$stats = new Statistics;
		$stats->document_count = 1;
		$stats->document_ids = $document->id;
		$stats->action_on = date('Y-m-d G:i:s');
		$stats->user_id = Auth::user()->id;
		$stats->content = $document->title;
		$stats->action='Emailed';
		$ip = $this->get_client_ip();
		$stats->ip_address = $ip;
		$stats->is_deleted=0;
		$stats->save();
		log::info('last line');
	}
	
	public function downloadDocument($id=0)
	{
		$query = $this->client->createRealtimeGet();
		$query->addId($id);
		$resultset = $this->client->select($query);
		$document = $resultset->getDocuments()[0];
		//log::info($resultset->getDocuments());
		
		$this->getDocumentInRTFFormat($document);
		
		$path='__DIR__'.'/../app/storage/searched_document.rtf';
		$path='/srv/users/serverpilot/apps/laravel(demo)/app/storage/'.$document->short_citation.'.rtf';
		//$path='/var/www/laravel(demo)/app/storage/'.$document->short_citation.'.rtf';
		//$path='__DIR__'.'/../app/storage/'.$document->short_citation.'.rtf';
		$headers = array(
              'Content-Type: application/rtf',
            );
		
		/*$stats = new Statistics;
		$stats->document_count = 1;
		$stats->document_ids = $document->id;
		$stats->action_on = date('Y-m-d G:i:s');
		$stats->user_id = Auth::user()->id;
		$stats->content = $document->title;
		$stats->action='Downloaded';
		$ip = $this->get_client_ip();
		$stats->ip_address = $ip;
		$stats->is_deleted=0;
		$stats->save();*/
		
        return Response::download($path, $document->short_citation.'.rtf', $headers); 
		
	}
	
	public function getDocumentInRTFFormat($doc)
	{ 
		$dir = dirname(__FILE__);
		require_once '/srv/users/serverpilot/apps/laravel(demo)/vendor/phprtflite/phprtflite/lib/PHPRtfLite.php';
		//require_once '/var/www/laravel(demo)/vendor/phprtflite/phprtflite/lib/PHPRtfLite.php';
		//require_once '__DIR__'.'/../vendor/phprtflite/phprtflite/lib/PHPRtfLite.php';
		PHPRtfLite::registerAutoloader();
		
		$times12 = new PHPRtfLite_Font(13, 'Times new Roman');
		$arial14 = new PHPRtfLite_Font(14, 'Arial', '#000066');

		$parFormat = new PHPRtfLite_ParFormat();

		//rtf document
		$rtf = new PHPRtfLite();
		$rtf->setMargins(2.5, 2.5, 2.5, 2.5);
		$sect2 = $rtf->addSection();
			
		$rcnt=1;
		$rhgt=0.25;
		$table1 = $sect2->addTable();
		$table1->addRows($rcnt, $rhgt);
		$table1->addColumnsList(array_fill(0, 1, 16));
	
		$cell = $table1->getCell(1, 1);
		$cell->writeText('<b>World</b>', new PHPRtfLite_Font(12, 'Calibri', '', ''));
		$cell->writeText('<b>Courts</b>', new PHPRtfLite_Font(12, 'Calibri', '#BDBDBD', ''));
		
		$par = new PHPRtfLite_ParFormat('right');
		$par->setIndentLeft(10);
		//$par->setBackgroundColor('#99ccff');
		$par->setSpaceBetweenLines(2);
		
		$centerpar = new PHPRtfLite_ParFormat('center');
		//$sect2 = $rtf->addSection();
		if($doc->type == 'decision')
		{
			
			$dt = date('d F Y',strtotime(Document::convertDateFromSolrFormat($doc->date, Document::DATE_FORMAT_NICE)));
			$sect2->writeText($dt, new PHPRtfLite_Font(12, 'Times New Roman'), $par);
			$sect2->writeText($doc->file_no, new PHPRtfLite_Font(12, 'Times New Roman'), $par);
			$sect2->writeText('<br/>', new PHPRtfLite_Font(12, 'Times New Roman'));
			$sect2->writeText('<b>'.strtoupper($doc->institution).'</b>', new PHPRtfLite_Font(12, 'Times New Roman'), $centerpar); 
			$sect2->writeText('<b>'.strtoupper($doc->institution_subdivision).'</b>', new PHPRtfLite_Font(12, 'Times New Roman'), $centerpar);
			$sect2->writeText('<br/>', new PHPRtfLite_Font(12, 'Times New Roman'));
			$sect2->writeText('<b>'.strtoupper($doc->title).'</b>', new PHPRtfLite_Font(12, 'Times New Roman'), $centerpar); 
			$sect2->writeText('<b>'.strtoupper($doc->title_short).'</b>', new PHPRtfLite_Font(12, 'Times New Roman'), $centerpar); 
			$sect2->writeText('<br/>', new PHPRtfLite_Font(12, 'Times New Roman'));
			$sect2->writeText('<b>'.strtoupper($doc->applicant).'</b>', new PHPRtfLite_Font(12, 'Times New Roman'), $centerpar); 
			$sect2->writeText('<b>v.</b>', new PHPRtfLite_Font(12, 'Times New Roman'), $centerpar);
			$sect2->writeText('<b>'.strtoupper($doc->respondent).'</b>', new PHPRtfLite_Font(12, 'Times New Roman'), $centerpar); 
			$sect2->writeText('<br/>', new PHPRtfLite_Font(12, 'Times New Roman'));
			
			$rowCount = 8;
			$rowHeight = 0.5;
			$columnCount = 2;
			$columnWidth = 8;
			$table = $sect2->addTable();
			$table->addRows($rowCount, $rowHeight);
			//$table->addColumnsList(array_fill(0, $columnCount, $columnWidth));
			$table->addColumnsList(array(4,12));
			
			$parSimple = new PHPRtfLite_ParFormat('center');
		//	$par->setIndentLeft(10);
		//	$parSimple->setBackgroundColor('#BDBDBD');
		//	$par->setSpaceBetweenLines(2);

			
			
			$mainArray = array();
			$mainArray[1] = array(1=>'Decided By:',2=>$doc->decided_by);
			$mainArray[2] = array(1=>'',2=>'');
			$mainArray[3] = array(1=>'Represented By:',2=>$doc->represented_by);
			$mainArray[4] = array(1=>'',2=>'');
			$mainArray[5] = array(1=>'Citation:',2=>$doc->citation);
			$mainArray[6] = array(1=>'Publication:',2=>$doc->publication);
			$mainArray[7] = array(1=>'PermaLink:',2=>'http://'.$_SERVER['HTTP_HOST'].'/d/'.$doc->short_citation);
			$mainArray[8] = array(1=>'Editor\'s Note:',2=>$doc->editors_note_public);
			
			
			for ($rowIndex = 1; $rowIndex <= $rowCount; $rowIndex++) {
				for ($columnIndex = 1; $columnIndex <= $columnCount; $columnIndex++) {
					$cell = $table->getCell($rowIndex, $columnIndex);
					//$cell->writeText("Cell $rowIndex:$columnIndex");
					
					$cell->writeText($mainArray[$rowIndex][$columnIndex], new PHPRtfLite_Font(12, 'Times New Roman', '', '')) ;
					$cell->setTextAlignment(PHPRtfLite_Table_Cell::TEXT_ALIGN_LEFT);
										
					$cell->setVerticalAlignment(PHPRtfLite_Table_Cell::VERTICAL_ALIGN_CENTER);
				}
			}

			$borderTop = new PHPRtfLite_Border($rtf);
		//	$borderTop->setBorderTop(new PHPRtfLite_Border_Format(2, '#f33'));
			$table->setBorderForCellRange($borderTop, 1, 1, 1, $columnCount);
			$borderBottom = new PHPRtfLite_Border($rtf);
		//	$borderBottom->setBorderBottom(new PHPRtfLite_Border_Format(2, '#33f'));
			$table->setBorderForCellRange($borderBottom, $rowCount, 1, $rowCount, $columnCount);
		}
		
		if($doc->type == 'commentary')
		{
			
			$dt = date('d F Y',strtotime(Document::convertDateFromSolrFormat($doc->date, Document::DATE_FORMAT_NICE)));
			$sect2->writeText($dt, new PHPRtfLite_Font(12, 'Times New Roman'), $par);
			$sect2->writeText('<br/>', new PHPRtfLite_Font(12, 'Times New Roman'));
			$sect2->writeText('<b>'.$doc->title.'</b>', new PHPRtfLite_Font(12, 'Times New Roman'), $centerpar); 
			$sect2->writeText('<br/>', new PHPRtfLite_Font(12, 'Times New Roman'));
			$sect2->writeText('<b>'.$doc->author.'</b>', new PHPRtfLite_Font(12, 'Times New Roman'), $centerpar);
			$sect2->writeText('<br/>', new PHPRtfLite_Font(12, 'Times New Roman'));
			$sect2->writeText('<b>'.$doc->publication.'</b>', new PHPRtfLite_Font(12, 'Times New Roman'), $centerpar); 
			$sect2->writeText('<br/>', new PHPRtfLite_Font(12, 'Times New Roman'));
			
			$rowCount = 7;
			$rowHeight = 0.5;
			$columnCount = 2;
			$columnWidth = 8;
			$table = $sect2->addTable();
			$table->addRows($rowCount, $rowHeight);
		//	$table->addColumnsList(array_fill(0, $columnCount, $columnWidth));
			$table->addColumnsList(array(4,12));
			
			$parSimple = new PHPRtfLite_ParFormat('center');
		//	$par->setIndentLeft(10);
		//	$parSimple->setBackgroundColor('#BDBDBD');
		//	$par->setSpaceBetweenLines(2);

			
			
			$mainArray = array();
			$mainArray[1] = array(1=>'Citation:',2=>$doc->citation);
			$mainArray[2] = array(1=>'PermaLink:',2=>'http://'.$_SERVER['HTTP_HOST'].'/d/'.$doc->short_citation);
			$mainArray[3] = array(1=>'Editor\'s Note:',2=>$doc->editors_note_public);
			$mainArray[4] = array(1=>'',2=>'');
			$mainArray[5] = array(1=>'Purchase Link:',2=>$doc->purchase_link);
			$mainArray[6] = array(1=>'Borrow Link:',2=>$doc->borrow_link);
			$mainArray[7] = array(1=>'View Link:',2=>$doc->view_link);
			
			
			for ($rowIndex = 1; $rowIndex <= $rowCount; $rowIndex++) {
				for ($columnIndex = 1; $columnIndex <= $columnCount; $columnIndex++) {
					$cell = $table->getCell($rowIndex, $columnIndex);
					//$cell->writeText("Cell $rowIndex:$columnIndex");
					
					$cell->writeText($mainArray[$rowIndex][$columnIndex], new PHPRtfLite_Font(12, 'Times New Roman', '', '')) ;
					$cell->setTextAlignment(PHPRtfLite_Table_Cell::TEXT_ALIGN_LEFT);
										
					$cell->setVerticalAlignment(PHPRtfLite_Table_Cell::VERTICAL_ALIGN_CENTER);
				}
			}

			$borderTop = new PHPRtfLite_Border($rtf);
		//	$borderTop->setBorderTop(new PHPRtfLite_Border_Format(2, '#f33'));
			$table->setBorderForCellRange($borderTop, 1, 1, 1, $columnCount);
			$borderBottom = new PHPRtfLite_Border($rtf);
		//	$borderBottom->setBorderBottom(new PHPRtfLite_Border_Format(2, '#33f'));
			$table->setBorderForCellRange($borderBottom, $rowCount, 1, $rowCount, $columnCount);
		}
		
		if($doc->type == 'treaty')
		{ 
			$dt = date('d F Y',strtotime(Document::convertDateFromSolrFormat($doc->date, Document::DATE_FORMAT_NICE)));
			$sect2->writeText($dt, new PHPRtfLite_Font(12, 'Times New Roman'), $par);
			$sect2->writeText($doc->file_no, new PHPRtfLite_Font(12, 'Times New Roman'), $par);
			$sect2->writeText('<br/>', new PHPRtfLite_Font(12, 'Times New Roman'));
			$sect2->writeText('<b>'.$doc->title.'</b>', new PHPRtfLite_Font(12, 'Times New Roman'), $centerpar); 
			$sect2->writeText('<br/>', new PHPRtfLite_Font(12, 'Times New Roman'));
			$sect2->writeText('<b>'.$doc->title_short.'</b>', new PHPRtfLite_Font(12, 'Times New Roman'), $centerpar);
			$sect2->writeText('<br/>', new PHPRtfLite_Font(12, 'Times New Roman'));
						
			$rowCount = 7;
			$rowHeight = 0.5;
			$columnCount = 2;
			$columnWidth = 8;
			$table = $sect2->addTable();
			$table->addRows($rowCount, $rowHeight);
		//	$table->addColumnsList(array_fill(0, $columnCount, $columnWidth));
			$table->addColumnsList(array(4,12));
			
			$parSimple = new PHPRtfLite_ParFormat('center');
		//	$par->setIndentLeft(10);
		//	$parSimple->setBackgroundColor('#BDBDBD');
		//	$par->setSpaceBetweenLines(2);

			
			$permaLink = 'http://'.$_SERVER['HTTP_HOST'].'/d/'.$doc->short_citation;
			$mainArray = array();
			$dt = date('d F Y',strtotime(Document::convertDateFromSolrFormat($doc->in_force_from, Document::DATE_FORMAT_NICE)));
			$dt1 = date('d F Y',strtotime(Document::convertDateFromSolrFormat($doc->in_force_until, Document::DATE_FORMAT_NICE)));
			$mainArray[1] = array(1=>'In Force From:',2=>$dt);
			$mainArray[2] = array(1=>'In Force Until:',2=>$dt);
			$mainArray[3] = array(1=>'',2=>'');
			$mainArray[4] = array(1=>'Citation:',2=>$doc->citation);
			$mainArray[5] = array(1=>'Publication:',2=>$doc->publication);
			$mainArray[6] = array(1=>'PermaLink:',2=>$permaLink);
			$mainArray[7] = array(1=>'Editor\'s Note:',2=>$doc->editors_note_public);
									
			
			for ($rowIndex = 1; $rowIndex <= $rowCount; $rowIndex++) {
				for ($columnIndex = 1; $columnIndex <= $columnCount; $columnIndex++) {
					$cell = $table->getCell($rowIndex, $columnIndex);
					//$cell->writeText("Cell $rowIndex:$columnIndex");
					
					$cell->writeText($mainArray[$rowIndex][$columnIndex], new PHPRtfLite_Font(12, 'Times New Roman', '', '')) ;
					$cell->setTextAlignment(PHPRtfLite_Table_Cell::TEXT_ALIGN_LEFT);
										
					$cell->setVerticalAlignment(PHPRtfLite_Table_Cell::VERTICAL_ALIGN_CENTER);
				}
			}

			$borderTop = new PHPRtfLite_Border($rtf);
		//	$borderTop->setBorderTop(new PHPRtfLite_Border_Format(2, '#f33'));
			$table->setBorderForCellRange($borderTop, 1, 1, 1, $columnCount);
			$borderBottom = new PHPRtfLite_Border($rtf);
		//	$borderBottom->setBorderBottom(new PHPRtfLite_Border_Format(2, '#33f'));
			$table->setBorderForCellRange($borderBottom, $rowCount, 1, $rowCount, $columnCount);
		}
		
		
		$bodyFont = new PHPRtfLite_Font(12, 'Times new Roman');
		
		$doc_body = $doc->body;
		$custom_tags = array('p','h1','h2','h3','table','br','tr','td','a','br ','para1','para2','para3','/h1','/h2','/h3','/table','/br','/p','/tr','/td','/a','para1/','Para2/','para3/','Para1/','Para2/','Para3/');
		$tags_length = sizeof($custom_tags);
		for ($i = 0; $i < $tags_length; $i++) {
			$doc_body = str_replace("<" . $custom_tags[$i] . ">", "", $doc_body);
		}
		$doc_body = preg_replace('~\{(.+?)\}~', '', $doc_body);
		$doc_body = preg_replace('~\<(.+?)/\>~', '', $doc_body);
		//$doc_body = preg_replace('/<+\>/i', '', $doc_body);
		$doc_body = str_replace("<","",$doc_body);
		$doc_body = str_replace(">","",$doc_body);
		$sect2->writeText($doc_body, $bodyFont, new PHPRtfLite_ParFormat(PHPRtfLite_ParFormat::TEXT_ALIGN_JUSTIFY));
		
		if($doc->type == 'treaty')
		{
			/*$par3 = new PHPRtfLite_ParFormat('left');
		$par3->setIndentLeft(10);
		//$par->setBackgroundColor('#99ccff');
		$par3->setSpaceBetweenLines(2);
			$sect2->writeText('RATIFICATIONS & SIGNATURES', new PHPRtfLite_Font(12, 'Times New Roman'), $par3); */
			
			$sect2->writeText('<br/><br/><b>RATIFICATIONS & SIGNATURES</b><br/>',new PHPRtfLite_Font(12, 'Times New Roman'), new PHPRtfLite_ParFormat());
			
			$count=count($doc->ratifications_signatures);
			
			$rowCount = $count+1;
			$rowHeight = 0.5;
			$columnCount = 4;
			$columnWidth = 4;
			$table = $sect2->addTable();
			$table->addRows($rowCount, $rowHeight);
			$table->addColumnsList(array_fill(0, $columnCount, $columnWidth));
			
			
			$parSimple = new PHPRtfLite_ParFormat('center');
		//	$par->setIndentLeft(10);
		//	$parSimple->setBackgroundColor('#BDBDBD');
		//	$par->setSpaceBetweenLines(2);

			
			
			$mainArray = array();
			$mainArray[1] = array(1=>'State',2=>'Signed',3=>'Ratified/Accessed', 4=>'Deposited');
			$ratifications_array=array();
			if($count > 0 )
			{
				for($i=1;$i<=$count;$i++){
					$ratifications_array[$i-1] = explode(",",$doc->ratifications_signatures[$i-1]);
					$ratifications_array[$i][0]=$ratifications_array[$i-1][0];
					$ratifications_array[$i][1] = date('Y-m-d',strtotime(Document::convertDateFromSolrFormat($ratifications_array[$i-1][1], Document::DATE_FORMAT_NICE)));
					$ratifications_array[$i][2] = date('Y-m-d',strtotime(Document::convertDateFromSolrFormat($ratifications_array[$i-1][2], Document::DATE_FORMAT_NICE)));
					$ratifications_array[$i][3] = date('Y-m-d',strtotime(Document::convertDateFromSolrFormat($ratifications_array[$i-1][3], Document::DATE_FORMAT_NICE)));
					$mainArray[$i+1] = array(1=>$ratifications_array[$i][0],2=>$ratifications_array[$i][1],3=>$ratifications_array[$i][2],4=>$ratifications_array[$i][3]);
				}
				//log::info($mainArray);
			}
			else
			{
				$mainArray[1] = array(1=>'',2=>'',3=>'',4=>'');
			}
			
			for ($rowIndex = 1; $rowIndex <= $rowCount; $rowIndex++) {
				for ($columnIndex = 1; $columnIndex <= $columnCount; $columnIndex++) {
					$cell = $table->getCell($rowIndex, $columnIndex);
					//$cell->writeText("Cell $rowIndex:$columnIndex");
					
					$cell->writeText($mainArray[$rowIndex][$columnIndex], new PHPRtfLite_Font(12, 'Times New Roman', '', '')) ;
					$cell->setTextAlignment(PHPRtfLite_Table_Cell::TEXT_ALIGN_CENTER);
										
					$cell->setVerticalAlignment(PHPRtfLite_Table_Cell::VERTICAL_ALIGN_CENTER);
				}
			}

			$borderTop = new PHPRtfLite_Border($rtf);
		//	$borderTop->setBorderTop(new PHPRtfLite_Border_Format(2, '#f33'));
			$table->setBorderForCellRange($borderTop, 1, 1, 1, $columnCount);
			$borderBottom = new PHPRtfLite_Border($rtf);
		//	$borderBottom->setBorderBottom(new PHPRtfLite_Border_Format(2, '#33f'));
			$table->setBorderForCellRange($borderBottom, $rowCount, 1, $rowCount, $columnCount);
			
			$sect2->writeText('<b>DECLARATIONS, RESERVATIONS & UNDERSTANDINGS</b><br/>', new PHPRtfLite_Font(12, 'Times New Roman'), new PHPRtfLite_ParFormat()); 
			
			$count_dec=count($doc->declarations);
			$rowCount = $count_dec;
			$rowHeight = 0.5;
			$columnCount = 2;
			$columnWidth = 8;
			$table = $sect2->addTable();
			$table->addRows($rowCount, $rowHeight);
			$table->addColumnsList(array(4,12));
			
			
			$parSimple = new PHPRtfLite_ParFormat('center');
		//	$par->setIndentLeft(10);
		//	$parSimple->setBackgroundColor('#BDBDBD');
		//	$par->setSpaceBetweenLines(2);
			
			$mainArray = array();
			$declarations_array=array();
			if($count_dec > 0 )
			{
				for($i=0;$i<$count_dec;$i++){			
					$declarations_array[$i] = explode("~",$doc->declarations[$i]);
					$declarations_array[$i][0]=$declarations_array[$i][0];
					$declarations_array[$i][1] = $declarations_array[$i][1];
					$mainArray[$i+1] = array(1=>$declarations_array[$i][0],2=>$declarations_array[$i][1]);
				}
				log::info($mainArray); 
			}	
			else
			{
				$mainArray[1] = array(1=>'',2=>'');
			}
									
			
			for ($rowIndex = 1; $rowIndex <= $rowCount; $rowIndex++) {
				for ($columnIndex = 1; $columnIndex <= $columnCount; $columnIndex++) {
					$cell = $table->getCell($rowIndex, $columnIndex);
					//$cell->writeText("Cell $rowIndex:$columnIndex");
					
					$cell->writeText($mainArray[$rowIndex][$columnIndex], new PHPRtfLite_Font(12, 'Times New Roman', '', '')) ;
					$cell->setTextAlignment(PHPRtfLite_Table_Cell::TEXT_ALIGN_LEFT);
										
					$cell->setVerticalAlignment(PHPRtfLite_Table_Cell::VERTICAL_ALIGN_CENTER);
				}
			}

			$borderTop = new PHPRtfLite_Border($rtf);
		//	$borderTop->setBorderTop(new PHPRtfLite_Border_Format(2, '#f33'));
			$table->setBorderForCellRange($borderTop, 1, 1, 1, $columnCount);
			$borderBottom = new PHPRtfLite_Border($rtf);
		//	$borderBottom->setBorderBottom(new PHPRtfLite_Border_Format(2, '#33f'));
			$table->setBorderForCellRange($borderBottom, $rowCount, 1, $rowCount, $columnCount);
		}
	//	$path='__DIR__'.'/../app/storage/'$document->short_citation.'.rtf';
		$rtf->save('/srv/users/serverpilot/apps/laravel(demo)/app/storage/'.$doc->short_citation.'.rtf');
		//$rtf->save('/var/www/laravel(demo)/app/storage/'.$doc->short_citation.'.rtf');
		//$rtf->save('__DIR__'.'/../app/storage/'.$doc->short_citation.'.rtf');		
	}
	
	function writeSectionText(PHPRtfLite_Container_Section $sect, $arial14, $times12, $doc) 
	{
		$times14 = new PHPRtfLite_Font(14, 'Times new Roman','#000066');
		$times13 = new PHPRtfLite_Font(13, 'Times new Roman','#000066');
		$times12 = new PHPRtfLite_Font(12, 'Times new Roman','#000066');
		$times10 = new PHPRtfLite_Font(10, 'Times new Roman','#000066');
		$bodyFont = new PHPRtfLite_Font(12, 'Times new Roman');
	//	$sect->writeText($doc->title, $times14, new PHPRtfLite_ParFormat());
	//	$sect->writeText($doc->citation, $times13, new PHPRtfLite_ParFormat());
	//	$sect->writeText($doc->document_type, $times12, new PHPRtfLite_ParFormat());
	//$sect->writeText($doc->institution, $times10, new PHPRtfLite_ParFormat());
	//	$sect->writeText($doc->institution_subdivision, $times10, new PHPRtfLite_ParFormat());
		$testContent = $doc->body;
		/* $modifiedBody = $this->modifyBodyContent($testContent);
		//$modifiedBody = $doc->body;
		log::info($doc->body);
		log::info('----------------');
		//log::info($modifiedBody); */
		//$sect->writeText($doc->body, $bodyFont, new PHPRtfLite_ParFormat(PHPRtfLite_ParFormat::TEXT_ALIGN_JUSTIFY));
	}
	
	public function modifyBodyContent($body)
	{
		preg_match_all("/<(.*?)>/", $body, $results);
		//log::info($results);
		$linkAddedBody = $body;
		
		$i=0;
		$documentReferences = DocumentReferences::all();
		$name = null;
		foreach($results['0'] as $val)
		{
			
			foreach($documentReferences as $ref)
			{			
				$res = strcmp($ref->key_name,$results[1][$i]);
				if($res==0)
				{
					if($ref->value_name!=null)
					{				
						$myArray = explode(',', $ref->key_name);
						if(count($myArray)==1)
						{
							
							preg_match("/{(.*)}/", $ref->key_name, $curlyBracketContent);
							$contentAfterCurlyBracket = explode('}', $ref->key_name);
							
							$content = $contentAfterCurlyBracket[1];
							
							$linkAddedBody = str_replace($val,$content,$linkAddedBody);
							break;
						}
						else
						{
							$content = $results[1][$i];
							
							$linkAddedBody = str_replace($val,$content,$linkAddedBody);
							break;
						}
					}
					else
					{
						$linkAddedBody = str_replace($val,$results[1][$i],$linkAddedBody);
						break;
					}
					
				}
				else
				{
					
				}
			}		
			if(strpos($val,'/') !== false)
			{
				$linkAddedBody = str_replace($val,'',$linkAddedBody);
			}
			$i++;
		} 
		//log::info($linkAddedBody);
		return $linkAddedBody;
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
	
	/**
     * autocmplete for search filed - searches over title field
     * @return mixed
     */
    public function getAutocomplete()
    {
        // get a suggester query instance
        $query = $this->client->createSuggester();
        $query->setQuery(strtolower(Input::get('term')));
        $query->setDictionary('suggest');
        $query->setOnlyMorePopular(true);
        $query->setCount(10);
        $query->setCollate(true);

        // this executes the query and returns the result
        $resultset = $this->client->suggester($query);

        $suggestions = array();

        foreach ($resultset as $term => $termResult) {
            foreach ($termResult as $result) {
                $suggestions[] = $result;
            }
        }

        return Response::json($suggestions);
    }


    /**
     * generate a link to the current page including all sort parameters as part of it
     * @param null $sortParam
     * @param null $sortDirection
     * @return string uri
     */
    protected function getLink($sortParam = null, $sortDirection = null, $pageParam = null) {

        $urlParams = array();
        foreach(Input::all() as $name => $value) {
		//log::info($value);
			if(is_array($value) == false)
			{
				$urlParams[] = sprintf('%s=%s', $name, $value);
			}
        }

        $linkParams = array(
            $this->uri,
            ($sortParam !== null) ? $sortParam : $this->sortParam,
            ($sortDirection !== null) ? $sortDirection : $this->sortDirection,
           // ($pageParam !== null) ? $pageParam : $this->currentPage
		   ($pageParam !== null) ? $pageParam : 1
        );

        if($urlParams) {
            $linkParams[] = '?' . implode('&', $urlParams);
        }

        return URL::to(implode('/', $linkParams));
    }

    /**
     * prepares pagination information for view based on provided total number of found items relative to the current search
     * @param int $totalNrOfItems
     * @return array
     */
    protected function getPagination($totalNrOfItems = 0) {

        $nrOfPages = ceil($totalNrOfItems/self::RESULTS_PER_PAGE);

        $pagination = array();

        // first check if we even need a pagination
        if(self::RESULTS_PER_PAGE < $totalNrOfItems) {
            for($i = 1; $i <= $nrOfPages; $i++) {

                // first element
                if($i == 1) {
                    $pagination[] = array(
                        'cssClass' => ($this->currentPage == 1) ? 'disabled' : '',
                        'link' => $this->getLink(null, null, $this->currentPage - 1),
                        'label' => '&laquo;'
                    );
                }

                // pages
				if($i == $this->currentPage)
				{
					$pagination[] = array(
                    'cssClass' => ($this->currentPage == $i) ? 'active' : '',
                    'link' => $this->getLink(null, null, $i),
                    'label' => '<u>'.$i.'</u>'
                );
				}
				else
				{
					$pagination[] = array(
                    'cssClass' => ($this->currentPage == $i) ? 'active' : '',
                    'link' => $this->getLink(null, null, $i),
                    'label' => $i
                );
				}
                

                // last element
                if ($i == $nrOfPages) {
                    $pagination[] = array(
                        'cssClass' => ($this->currentPage == $nrOfPages) ? 'disabled' : '',
                        'link' => $this->getLink(null, null, $this->currentPage + 1),
                        'label' => '&raquo;'
                    );
                }
            }
        }

        return $pagination;

    }

    protected function handleSortParams() {
        // make sure we only use valid/allowed sort fields
        switch($this->sortParam) {
            case 'date':
                $this->sortField = 'date';
                break;

            case 'institution':
                $this->sortField = 'institution';
                break;

            case 'type':
                $this->sortField = 'document_type';
                break;

            default:
                $this->sortField = 'title';
                break;
        }


        // make sure we only use valid sort directions
        if($this->sortDirection != 'asc' && $this->sortDirection != 'desc') {
            $this->sortDirection = 'asc';
        }
    }

    protected function getTableHeader() {

        // if you click on already selected field, then the sort should be reversed
        $newDirection = ($this->sortDirection == 'asc') ? 'desc' : 'asc';

        $tableHeaderData = array(
            'title' => array(
                'link' => $this->getLink('title', ($this->sortField == 'title') ? $newDirection : $this->sortDirection),
                'name' => 'Title',
                'cssClass' => 'fa-sort-' . $this->sortDirection
            ),
            'document_type' => array(
                'link' => $this->getLink('type', $this->sortField == 'document_type' ? $newDirection : $this->sortDirection),
                'name' => 'Type',
                'cssClass' => 'fa-sort-' . $this->sortDirection
            ),
            'date' => array(
                'link' => $this->getLink('date', $this->sortField == 'date' ? $newDirection : $this->sortDirection),
                'name' => 'Date',
                'cssClass' => 'fa-sort-' . $this->sortDirection
            ),
        );
		
        // insert institution field in 3rd column, if this is search results
        if($this->uri == 'search') {
            $tableHeaderData = array_slice($tableHeaderData, 0, 2, true) +
                array('institution' => array(
                    'link' => $this->getLink('institution', $this->sortField == 'institution' ? $newDirection : $this->sortDirection),
                    'name' => 'Institution',
                    'cssClass' => 'fa-sort-' . $this->sortDirection
                )) +
                array_slice($tableHeaderData, 2, count($tableHeaderData)-2, true);
        }
		
        return $tableHeaderData;
    }
}
