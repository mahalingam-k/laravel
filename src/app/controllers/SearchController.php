<?php

class SearchController extends SolrController {

    protected $yearFilter = 0;
    protected $letterFilter = null;
    protected $insitutionId = 0;
	
	  protected $sortParam = 'title';
    protected $sortField = 'title';
    protected $sortDirection = 'asc';
    protected $currentPage = 0;

    const RESULTS_PER_PAGE = 10;
	/*public function openDocument($id,$name) {
	log::info('Inside openDocument');
	log::info($id);
	
	log::info($name);
	$query = $this->client->createRealtimeGet();

	// Set the query string
	$query->addId($id);

	// Execute the query and return the result
	$resultset = $this->client->select($query);

	$document = $resultset->getDocuments()[0];
	$linkAddedBody = $document->body;
	$title =  $document->title;
	$citation = $document->citation;
	$docType = $document->document_type;
	$institution = $document->institution;
	$institution_subdivision = $document->institution_subdivision;
	return View::make('document.index', ['name'=>$name,'title' => $title,'citation'=>$citation,'docType'=>$docType,'institution'=> $institution,'institution_subdivision'=>$institution_subdivision,'linkBody' => $linkAddedBody]);
	} */

    public function showDocumentByPermaLink($shortlink)
	{
		//log::info('inside showDocumentByPermaLink method');
		//log::info($shortlink);
		
		$query = null;
		$query = $this->client->createSelect();

		$query->setQuery('short_citation:'.$shortlink);
		$hl = $query->getHighlighting();
		$hl->setFields(array('body','title','citation'));
		$hl->setSnippets(10000);
		$hl->setFragSize(300);
		$hl->setSimplePrefix('<span class="highlight">');
		$hl->setSimplePostfix('</span>');
		
		// Execute the query and return the result
		$resultset = $this->client->select($query);
		if($resultset->getNumFound() > 0)
		{
		$document = $resultset->getDocuments()[0];
		
		session_start();
		$_SESSION["document"] = $document;
		
		$highlights = array();
		$highlighting = $resultset->getHighlighting();
		foreach($highlighting as $id => $highlight) 
		{
			/*
			//log::info($highlighting->getResult($id)->getField('body'));
			$hitsArray = $highlighting->getResult($id)->getField('body');
			foreach($highlighting->getResult($id)->getField('body') as $snippet)
			{
				//log::info($snippet);
			} */
			
			$highlights[$id] = array(
                   'title' => $highlighting->getResult($id)->getField('title'),
                   'body' => $highlighting->getResult($id)->getField('body'),
                   'institution' => $highlighting->getResult($id)->getField('institution')
               );
		}
		
		$docPropertiesArray = array();
		$docPropertiesArray[1] = $document->title;
		$docPropertiesArray[2] = $document->citation;
		$docPropertiesArray[3] = $document->file_no;
		$docPropertiesArray[4] = $document->type;
		$docPropertiesArray[5] = '';
		$docPropertiesArray[6] = '';
		$docPropertiesArray[9] = date("d M Y", strtotime(Document::convertDateFromSolrFormat($document->date, Document::DATE_FORMAT_NICE)));
		
		if(Input::get('dctype') == 'decision')
		{
			$docPropertiesArray[5] = $document->decided_by;
			$docPropertiesArray[6] = $document->represented_by;
		}
		if(Input::get('dctype') == 'treaty')
		{
			
			/** old code 
			$ratSigns = $document->ratifications_signatures[0];
			$ratifications_signatures = explode(',', $ratSigns);
			$_SESSION["ratifications_signatures"] = $ratifications_signatures;
			**/
			/** new code **/
			$ratifications_array=array();
			log::info($document->ratifications_signatures);
			$count=count($document->ratifications_signatures);
			for($i=0;$i<$count;$i++){			
				$ratifications_array[$i] = explode(",",$document->ratifications_signatures[$i]);
				$ratifications_array[$i][0]=$ratifications_array[$i][0];
				$ratifications_array[$i][1] = date('Y-m-d',strtotime(Document::convertDateFromSolrFormat($ratifications_array[$i][1], Document::DATE_FORMAT_NICE)));
				$ratifications_array[$i][2] = date('Y-m-d',strtotime(Document::convertDateFromSolrFormat($ratifications_array[$i][2], Document::DATE_FORMAT_NICE)));
				$ratifications_array[$i][3] = date('Y-m-d',strtotime(Document::convertDateFromSolrFormat($ratifications_array[$i][3], Document::DATE_FORMAT_NICE)));
			}
			$_SESSION["ratifications_signatures"]=$ratifications_array;
			$_SESSION["ratifications_count"]=$count;
			
			/** new code ends **/	
			/**old code	
			$declarations = $document->declarations[0];
			log::info($declarations);
			$declarationsValues = explode(',', $declarations);
			$_SESSION["declarationsValues"] = $declarationsValues;
			**/
			/** new code **/
			$declarations_array=array();
			$count_dec=count($document->declarations);
			for($i=0;$i<$count_dec;$i++){			
				$declarations_array[$i] = explode("~",$document->declarations[$i]);
				$declarations_array[$i][0]=$declarations_array[$i][0];
				$declarations_array[$i][1] = $declarations_array[$i][1];
			}
			
			$_SESSION["declarationsValues"]=$declarations_array;
			$_SESSION["declarations_count"]=$count_dec;
			/** new code ends **/
			
		}
		$docPropertiesArray[7] = $document->editors_note_public;
		$docPropertiesArray[8] = $document->publication;
		$docPropertiesArray[11] = $document->document_type;
		
		//log::info($resultset->getDocuments()[0]->id);
	   $valuesArray = array();
	   $valuesArray['alertFlag'] = Input::get('alertFlag');
	   $valuesArray['searchTermId'] = Input::get('searchTermId');
	   $valuesArray['noteup'] = 'false';
	   $valuesArray['highlight'] = $highlights;
	   $valuesArray['docPropertiesArray'] = $docPropertiesArray;
	   $valuesArray['st'] = '';
	   $valuesArray['permalink'] = 'http://'.$_SERVER['HTTP_HOST'].'/d/'.$document->short_citation;
	   //$valuesArray['permalink'] = 'http://example.com/d/'.$document->short_citation;
	   $valuesArray['prevDoc'] = 0;
	   $valuesArray['nextDoc'] = 0;
	   $valuesArray['hits'] = '';
	   $valuesArray['maxhit'] = 0;
	   $valuesArray['ids'] = '';
	   $valuesArray['id'] = $document->id;
	   $valuesArray['name'] = '';
	   $valuesArray['institution'] = $document->institution;
	   $valuesArray['institution_subdivision'] = $document->institution_subdivision;
	   $valuesArray['linkBody'] = $document->body;
	   $valuesArray['showdocument'] = 1;
	   }
	    else
	   {
		$valuesArray = array();
		$valuesArray['alertFlag'] = 0;
		$valuesArray['id'] = 0;
		$valuesArray['maxhit'] =0;
		$valuesArray['searchTermId'] = 0;
		$valuesArray['showdocument'] = 0;
	   }
	   return View::make('document.index',['valuesArray' => $valuesArray]);
	}
	
	/**
     * single document view
     * @param $id
     * @return mixed
     */
    public function showDocument($id) { 
		log::info('show doc');
		session_start();
		
		//log::info(Input::get('ids'));
		$ids = Input::get('ids');
		$hits = Input::get('hits');
		//$searchString = Input::get('searchstring');
		$finalSearchString = '';
	//	$_SESSION['searchstring'] = '';
	//	$finalSearchString = $this->getSearchString($_SESSION['searchstring'],$_SESSION['documentCnt']);
	//	$_SESSION["finalSearchString"] = $finalSearchString;
	//	log::info($searchString);
			
	//	log::info($finalSearchString);
		$idsArray = array_map('intval', explode(',', $ids));
		$hitsArray = array();
		//$hitsArray =array_map('intval', explode(',', $hits));
		$idPos = array_search($id, $idsArray);
		$hitsPos = array_search($id, $hitsArray);
		
	//	log::info($idPos);
	//	log::info($hitsPos);
		$prevDocs = array_slice($idsArray, 0, $idPos);
		$nextDocs = array_slice($idsArray, ($idPos+1));
	//	log::info($prevDocs);
	//	log::info($nextDocs);
		$prevDoc=0;
		if(count($prevDocs)!=0)
		{
			$prevDoc = $idsArray[$idPos-1];
		}
		
		$nextDoc=0;
		if(count($nextDocs)!=0)
		{
			$nextDoc = $idsArray[$idPos+1];
		}
		
		$containString = false;
		$query = null;
		$query = $this->client->createSelect();
		$docId = null;
		$splittedVal = null;
		$Index = 0;
		for($i=0; $i<strlen($id); $i++)
		{
			if(!is_numeric(substr($id, $i, 1)))
			{
				$Index = $i;
				$containString = true;
				break;
			}
		}
		
		$sterm = '';
		if (isset($_SESSION['searchterm'])) 
		{
			$sterm = $_SESSION["searchterm"];
		}
		if (isset($_SESSION["finalSearchString"]) == false) 
		{
			$_SESSION["finalSearchString"] = '';;
		}
		
		if($containString == true)
		{
			log::info('containString is true');
			$docId = substr($id, 0, $Index);
			$splittedVal = substr($id, $Index, strlen($id));
		//  $query = $this->client->createRealtimeGet();
		//	$query->addId($docId);
			$query->setQuery('*:*');
			
			//$query->setFields(array('body','title','citation'));
			$filterQueryString = 'id:'.$docId;
			$query->createFilterQuery('fq')->setQuery($filterQueryString);
		}
		else
		{
			log::info('containString is false');
		//	log::info(Input::get('q'));
		//	$query = $this->client->createRealtimeGet();
		//	$query->addId($id);
			log::info($sterm);
			log::info($id);
			if($sterm=='')
			{
				$query->setQuery('*');
			}
			else
			{
				$query->setQuery($sterm);
			}
			if(Input::get('dctype') == 'decision')
			{
				//$query->setFields(array('id','body','institution','institution_subdivision','title','title_short','citation','file_no','publication','type','editors_note_public','decided_by','represented_by','date'));
			}
			else
			{
				//$query->setFields(array('id','body','institution','title','citation', 'file_no','publication','type','editors_note_public','date'));
			}
			$filterQueryString = 'id:'.$id;
			$query->createFilterQuery('fq')->setQuery($filterQueryString);
		}
		
		$hl = $query->getHighlighting();
		$hl->setFields(array('title, body, institution'));
		$hl->setSnippets(10000);
		$hl->setFragSize(300);
		$hl->setSimplePrefix('<span class="highlight">');
		$hl->setSimplePostfix('</span>');
		
		// Execute the query and return the result
		$resultset = $this->client->select($query);
		if($resultset->getNumFound() > 0)
		{
		$document = $resultset->getDocuments()[0];
		$_SESSION["document"] = $document;
		//log::info('author');
		//log::info(strlen($_SESSION["document"]->author));
		//log::info($document->body);
		//preg_match_all("/Doc/", $document->body, $abc);
		//preg_match_all("/<(.*?)>/", $document->body, $results);
		//log::info($abc);
		$highlights = array();
		$highlighting = $resultset->getHighlighting();
		foreach($highlighting as $id => $highlight) 
		{
			//log::info($highlighting->getResult($id)->getField('body'));
			$hitsArray = $highlighting->getResult($id)->getField('body');
			foreach($highlighting->getResult($id)->getField('body') as $snippet)
			{
				//log::info($snippet);
			}
			
			$highlights[$id] = array(
                   'title' => $highlighting->getResult($id)->getField('title'),
                   'body' => $highlighting->getResult($id)->getField('body'),
                   'institution' => $highlighting->getResult($id)->getField('institution')
               );
		}
		//log::info($hitsArray['0']);
		
		$prevhit=0;
		$nexthit=0;
		if($hits!=0)
		{
			$prevhit = ($hits-1);
			
		}
		if(count($hitsArray)!=0)
		{
			$nexthit = $hits+1;
		}
		if((count($hitsArray)-1)==$hits)
		{
			$nexthit = 0;
		}
		if(Auth::check())
		{
			$stats = new Statistics;
			$stats->document_count = 1;
			$stats->document_ids = $document->id;
			$stats->action_on = date('Y-m-d G:i:s');
			$stats->user_id = Auth::user()->id;
			$stats->content = $document->title;
			$stats->action='Opened';
			$ip = $this->get_client_ip();
			$stats->ip_address = $ip;
			$stats->is_deleted=0;
			$stats->save();
		}
		else
		{
			$_SESSION["alertFlag"] = 0;
		}

		$docPropertiesArray = array();
		$docPropertiesArray[1] = $document->title;
		$docPropertiesArray[2] = $document->citation;
		$docPropertiesArray[3] = $document->file_no;
		$docPropertiesArray[4] = $document->type;
		$docPropertiesArray[5] = '';
		$docPropertiesArray[6] = '';
		$docPropertiesArray[9] = date("d M Y", strtotime(Document::convertDateFromSolrFormat($document->date, Document::DATE_FORMAT_NICE)));
		
		if($document->type == 'decision')
		{
			$docPropertiesArray[5] = $document->decided_by;
			$docPropertiesArray[6] = $document->represented_by;
		}
		if($document->type == 'treaty')
		{
		/** old code 
			$ratSigns = $document->ratifications_signatures[0];
			$ratifications_signatures = explode(',', $ratSigns);
			$_SESSION["ratifications_signatures"] = $ratifications_signatures;
		**/
		/** new code **/
			$ratifications_array=array();
			log::info($document->ratifications_signatures);
			$count=count($document->ratifications_signatures);
			for($i=0;$i<$count;$i++){			
				$ratifications_array[$i] = explode(",",$document->ratifications_signatures[$i]);
				$ratifications_array[$i][0]=$ratifications_array[$i][0];
				$ratifications_array[$i][1] = date('Y-m-d',strtotime(Document::convertDateFromSolrFormat($ratifications_array[$i][1], Document::DATE_FORMAT_NICE)));
				$ratifications_array[$i][2] = date('Y-m-d',strtotime(Document::convertDateFromSolrFormat($ratifications_array[$i][2], Document::DATE_FORMAT_NICE)));
				$ratifications_array[$i][3] = date('Y-m-d',strtotime(Document::convertDateFromSolrFormat($ratifications_array[$i][3], Document::DATE_FORMAT_NICE)));
			}
			$_SESSION["ratifications_signatures"]=$ratifications_array;
			$_SESSION["ratifications_count"]=$count;
			
		/** new code ends **/	
		/** old code	
			$declarations = $document->declarations[0];
			log::info($declarations);
			$declarationsValues = explode(',', $declarations);
			$_SESSION["declarationsValues"] = $declarationsValues;
		**/
		/** new code **/
			$declarations_array=array();
			$count_dec=count($document->declarations);
			for($i=0;$i<$count_dec;$i++){			
				$declarations_array[$i] = explode("~",$document->declarations[$i]);
				$declarations_array[$i][0]=$declarations_array[$i][0];
				$declarations_array[$i][1] = $declarations_array[$i][1];
			}
			
			$_SESSION["declarationsValues"]=$declarations_array;
			$_SESSION["declarations_count"]=$count_dec;
		/** new code ends **/
		
		}
		$docPropertiesArray[7] = $document->editors_note_public;
		$docPropertiesArray[8] = $document->publication;
		$docPropertiesArray[11] = $document->document_type;
		
		
		

		$institution = $document->institution;
		$institution_subdivision = $document->institution_subdivision;
		log::info($institution);
		$modifiedBody = $this->getModifiedBodyForInterLinking($document->body,$hitsArray);
		$modifiedBody = preg_replace('~\{(.+?)\}~', '', $modifiedBody);
	   // return View::make('document.index', ['document' => $document]);
	   
	   $valuesArray = array();
	   $valuesArray['alertFlag'] = Input::get('alertFlag');
	   $valuesArray['searchTermId'] = Input::get('searchTermId');
	   $valuesArray['noteup'] = 'false';
	   $valuesArray['highlight'] = $highlights;
	   $valuesArray['docPropertiesArray'] = $docPropertiesArray;
	   $valuesArray['st'] = $sterm;
	   $valuesArray['permalink'] = 'http://'.$_SERVER['HTTP_HOST'].'/d/'.$document->short_citation;
          //$valuesArray['permalink'] = 'http://example.com/d/'.$document->short_citation;
	   $valuesArray['prevDoc'] = $prevDoc;
	   $valuesArray['nextDoc'] = $nextDoc;
	   $valuesArray['hits'] = $hits;
	   $valuesArray['maxhit'] = $_SESSION["maxhit"];
	   $valuesArray['ids'] = $ids;
	   $valuesArray['id'] = $id;
	   $valuesArray['name'] = $splittedVal;
	   $valuesArray['institution'] = $institution;
	   $valuesArray['institution_subdivision'] = $institution_subdivision;
	   $valuesArray['linkBody'] = $modifiedBody;
	   $valuesArray['showdocument'] = 1;
	   }
	   else
	   {
		$valuesArray = array();
		$valuesArray['alertFlag'] = 0;
		$valuesArray['id'] = 0;
		$valuesArray['maxhit'] =0;
		$valuesArray['searchTermId'] = 0;
		$valuesArray['showdocument'] = 0;
	   }
	   return View::make('document.index',['valuesArray' => $valuesArray]);
		//return View::make('document.index', ['noteup' => 'false','finalSearchString' => $finalSearchString,'searchString' => $searchString,'docPropertiesArray' => $docPropertiesArray, 'st'=>Input::get('q'),'prevDoc'=>$prevDoc,'nextDoc'=>$nextDoc,'hits'=>$hits,'maxhit'=>$i,'ids'=>$ids,'id'=>$id,'name'=>$splittedVal,'institution'=> $institution,'institution_subdivision'=>$institution_subdivision,'linkBody' => $modifiedBody]);	
    }
	
	public function getModifiedBodyForInterLinking($actualBody,$hitsArray)
	{
		//log::info('Inside getModifiedBodyForInterLinking');
		preg_match_all("/<(.*?)>/", $actualBody, $results);
		
		$linkAddedBody = $actualBody;
		//$linkAddedBody = $modifiedBody;
		$i=0;
		$documentReferences = DocumentReferences::all();
		$name = null;
		foreach($results['0'] as $val)
		{
			//log::info($val);
			//log::info($results[1][$i]);
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
							log::info('inside my array');
							log::info($ref->key_name);
							preg_match("/{(.*)}/", $ref->key_name, $curlyBracketContent);
							$contentAfterCurlyBracket = explode('}', $ref->key_name);
							if(isset($contentAfterCurlyBracket[1])){
								$name=$contentAfterCurlyBracket[1];
							}else{
								$url = $ref->value_name;
								log::info('inside else');
								log::info($ref->value_name);
								$content = '<a href="javascript:void(0)" onclick="window.open(\''.$url.'\',\'_self\',\'real title\',\'\menubar=yes,status=yes,location=yes,toolbar=yes,scrollbars=yes\')">'.$results[1][$i].'</a>';
							
								$linkAddedBody = str_replace($val,$content,$linkAddedBody);
								break;
							}	
							//$name = preg_replace('/\s+/', '', $contentAfterCurlyBracket[1]);
							//$url = $ref->value_name.'/'.$name;
							$url = $ref->value_name;
							$content = '<a href="javascript:void(0)" onclick="window.open(\''.$url.'\',\'_self\',\'real title\',\'menubar=yes,status=yes,location=yes,toolbar=yes,scrollbars=yes\')">'.$name.'</a>';
							
							$linkAddedBody = str_replace($val,$content,$linkAddedBody);
							break;
						}
						else
						{
							$url = $ref->value_name;
							log::info('inside else');
							log::info($ref->value_name);
							$content = '<a href="javascript:void(0)" onclick="window.open(\''.$url.'\',\'_self\',\'real title\',\'menubar=yes,status=yes,location=yes,toolbar=yes,scrollbars=yes\')">'.$results[1][$i].'</a>';
							
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
					
					//$linkAddedBody = str_replace($val,$results[1][$i],$linkAddedBody);
				}
			}		
			
			$i++;
		} 
		log::info('End of show document method true');
		//log::info($linkAddedBody);
		log::info('...........');
		$modifiedBody = $linkAddedBody;
		//log::info('Before body was..');
		//log::info($modifiedBody);
		$i=0;
		$j=0;
		foreach($hitsArray as $ind => $hit)
		{
			//log::info('Before hit was..');
			//log::info($hit);
			$cntnt = '<span class="highlight">';
			preg_match_all("/".$cntnt."(.*?)<\/span>/", $hit, $results);
		//	log::info($results['1']);
			foreach($results['1'] as $cnt =>$value)
			{
				//log::info($i);
				$pos = $this->strposnth($modifiedBody, $value,$i+1, 0);
		//		log::info($pos);
		//		log::info(strlen($value));
				//$value=strtolower($value);
				$repString = '<hlgt class="highlight'.$i.'"/><span class="highlight">'.$value.'</span>';
				$modifiedBody = substr_replace($modifiedBody, $repString, $pos, strlen($value));
				//$hit = preg_replace('<span class="highlight">','hlgt class="highlight'.$i.'"/><span class="highlight"',$hit,1);
								
				$i++;
			}
			
			//$hit = str_replace('<span class="highlight">','<span class="highlight'.$ind.'">',$hit);
			/* log::info($hit);
			$modifiedHit = $hit;
			log::info('Modified hit is');
			log::info($modifiedHit);
			$modifiedHit2 = $modifiedHit;
			foreach($results['1'] as $cnt =>$value)
			{
				if(strpos($modifiedHit2,'<span') !== false)
				{
					$modifiedHit2 = str_replace('<hlgt class="highlight'.$j.'"/><span class="highlight">','',$modifiedHit2);
				}
				if(strpos($modifiedHit2,'</span>') !== false)
				{
					$modifiedHit2 = str_replace('</span>','',$modifiedHit2);
				} 
				$j++;
			}
				log::info('modifiedHit2 is..');
				log::info($modifiedHit2);
				//log::info('modifiedHit is..');
				//log::info($modifiedHit);
		//	$modifiedBody = str_replace($modifiedHit2,$modifiedHit,$modifiedBody);
			//	log::info('After replace modified body is..');
				//log::info($modifiedBody); */
		}
		$_SESSION["maxhit"] = $i;
		//log::info('After body is..');
		//log::info($modifiedBody);
		
		return $modifiedBody;
	}

	public function strposnth($haystack, $needle, $nth, $insenstive)
	 {
		//if its case insenstive, convert strings into lower case
		if ($insenstive) {
			$haystack=strtolower($haystack);
			$needle=strtolower($needle);
		}
		//count number of occurances
		$count=substr_count($haystack,$needle);
		
		//first check if the needle exists in the haystack, return false if it does not
		//also check if asked nth is within the count, return false if it doesnt
		if ($count<1 || $nth > $count) return false;

		
		//run a loop to nth number of accurance
		//start $pos from -1, cause we are adding 1 into it while searchig
		//so the very first iteration will be 0
		for($i=0,$pos=0,$len=0;$i<$nth;$i++)
		{    
			//get the position of needle in haystack
			//provide starting point 0 for first time ($pos=0, $len=0)
			//provide starting point as position + length of needle for next time
			$pos=strpos($haystack,$needle,$pos+$len);

			//check the length of needle to specify in strpos
			//do this only first time
			if ($i==0) $len=strlen($needle);
		  }
		
		//return the number
		return $pos;
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
	
	public function getNoteUpList()
	{
		session_start();
		log::info('inside getNoteUpList');
		//log::info($docid);
		$did = Input::get('docid');
		$searchString = Input::get('searchString');
		$st = Input::get('st');
		$prevDoc = Input::get('prevDoc');
		$nextDoc = Input::get('nextDoc');
		$hits = Input::get('hits');
		$maxhit = Input::get('maxhit');
		$ids = Input::get('ids');
		
		log::info('st is');
		log::info($st);
		/*log::info($did);
		log::info($searchString);		
		log::info($st);		
		log::info($prevDoc);		
		log::info($nextDoc);		 
		log::info($hits);		
		log::info($maxhit);		
		log::info($ids); */		
		
		$docRefs = DocumentReferences::where('referred_document_number', $did)
                ->groupBy('reference_document_number')->get();
		//log::info(count($docRefs));
		$queryString = '';
		
		
		foreach($docRefs as $docRef)
		{
			$queryString = $queryString.'id:'.$docRef->reference_document_number.' & ';
		}
		
		$query1 = $this->client->createSelect();
		
		/*$query->setSorts(array($this->sortField => $this->sortDirection));
		$query->setStart(($this->currentPage - 1) * static::RESULTS_PER_PAGE);
		$query->setRows($numOfResults); */

		
		//$query->setQuery('id:1 & id:2'); 
		if(count($docRefs)>0)
		{
			$query1->setQuery('*');
			$query1->createFilterQuery('fq')->setQuery($queryString);
		}
		else
		{
			//log::info('here coming');
			$query1->setQuery('');
			$query1->createFilterQuery('fq')->setQuery('');
		}
		$query1->addField(sprintf("hits:termfreq(text,'%s')", $st));
		$hl = $query1->getHighlighting();
        $hl->setFields(array('search_title, body, institution'));
        $hl->setSnippets(10000);
        $hl->setFragSize(300);
        $hl->setSimplePrefix('<span class="highlight">');
        $hl->setSimplePostfix('</span>');
		$resultset = $this->client->select($query1);
		
		//log::info($resultset->getNumFound());
		
		$hitsForSearchResults =null;
		$i=1;
		$highlight_array=array();
		foreach($resultset->getDocuments() as $doc)
		{
			if($i < $resultset->getNumFound())
			{
				$hitsForSearchResults =$hitsForSearchResults.$doc->hits.',';
			}
			else
			{
				$hitsForSearchResults =$hitsForSearchResults.$doc->hits;
			}
			/* New code for getting key name */
			
			$docRefernces = DocumentReferences::where('referred_document_number', $did)->get();
			
			if(count($docRefernces)>0){
				foreach($docRefernces as $docref){
					if($docref->reference_document_number == $doc->id){
						$key_val = $docref->key_name;
						$highlight_string=$this->limitstring($doc->body,$key_val,20);
						$custom_tags = array('p','h1','h2','h3','table','br','tr','td','a','br ','para1','para2','para3','/h1','/h2','/h3','/table','/br','/p','/tr','/td','/a','para1/','Para2/','para3/','Para1/','Para2/','Para3/');
						$tags_length = sizeof($custom_tags);
						for ($i = 0; $i < $tags_length; $i++) {
							$highlight_string = str_replace("<" . $custom_tags[$i] . ">", "", $highlight_string);
						}
						$highlight_string = preg_replace('~\<(.+?)/\>~', '', $highlight_string);
						$highlight_string = str_replace('<', '', $highlight_string); 
						$highlight_string = str_replace('>', '', $highlight_string);
						$content='<span class="highlight">'.$key_val.'</span>';
						//$highlight_string = preg_replace('~\{(.+?)\}~', '', $highlight_string);
						$docbody=str_replace($key_val,$content,$highlight_string);
						$highlight_array[] = array(
							'doc_id'=> $doc->id,
							'body' => preg_replace('~\{(.+?)\}~', '', $docbody)
						);
					}
				}
			}
			
			/** New code ends **/
			
			$i++;
		}
		//print_r($hitsForSearchResults); exit;
		$highlighting = $resultset->getHighlighting();	
		$highlights = array();
		foreach($highlighting as $id => $highlight) {
			$tempArray = array();
		//	log::info($highlighting->getResult($id)->getField('body'));
			foreach($highlighting->getResult($id)->getField('body') as $snippet)
			{
				//log::info($snippet);
				$resArray =  $this->getTaggedString($snippet);
				 $tempArray[] = $resArray;
			}
		   $highlights[$id] = array(
			   'title' => $highlighting->getResult($id)->getField('search_title'),
			   'body' => $tempArray,
			   'institution' => $highlighting->getResult($id)->getField('institution')
		   );
		  
		}
		
		$query = $this->client->createSelect();
		//log::info($st);
		if($st != '')
		{
			$query->setQuery($st); 
		}
		else
		{
			$query->setQuery('*'); 
		}
		$filterQueryString = 'id:'.$did;
		$query->createFilterQuery('fq')->setQuery($filterQueryString);
		$query->addField(sprintf("hits:termfreq(text,'%s')", $st));
		$hl = $query->getHighlighting();
		$hl->setFields(array('body'));
		$hl->setSnippets(10000);
		$hl->setFragSize(300);
		$hl->setSimplePrefix('<span class="highlight">');
		$hl->setSimplePostfix('</span>');
		$resultset1 = $this->client->select($query);
		
		$document = $resultset1->getDocuments()[0];
		if($resultset1->getNumFound() > 0)
		{
		$highlights1 = array();
		$hitsArray = array();
		$highlighting1 = $resultset1->getHighlighting();
		foreach($highlighting1 as $id => $highlight) 
		{
			//log::info($highlighting1->getResult($id)->getField('body'));
			$hitsArray = $highlighting1->getResult($id)->getField('body');
			foreach($highlighting1->getResult($id)->getField('body') as $snippet)
			{
				//log::info($snippet);
			}
		}
		$docPropertiesArray = array();
		$docPropertiesArray[1] = $document->title;
		$docPropertiesArray[2] = $document->citation;
		$docPropertiesArray[3] = $document->file_no;
		$docPropertiesArray[4] = $document->type;
		$docPropertiesArray[5] = '';
		$docPropertiesArray[6] = '';
		$docPropertiesArray[9] = date("d M Y", strtotime(Document::convertDateFromSolrFormat($document->date, Document::DATE_FORMAT_NICE)));
		
		if($document->type == 'decision')
		{
			$docPropertiesArray[5] = $document->decided_by;
			$docPropertiesArray[6] = $document->represented_by;
		}
		$docPropertiesArray[7] = $document->editors_note_public;
		$docPropertiesArray[8] = $document->publication;
		
		//$citation_string = date("Y", strtotime(Document::convertDateFromSolrFormat($document->date, Document::DATE_FORMAT_NICE)))." WC";
		
		//$cita_string = $this->getnexttwowords($document->citation,$citation_string,2);
		//echo $cita_string; exit;
		if($document->auto_citation == ''){
			$finalSearchString = 'Noting Up: ['.$document->citation.']';
		}else{
			$finalSearchString = 'Noting Up: ['.$document->auto_citation.']';
		}	
		$_SESSION["noteupSearchString"] = $finalSearchString;
		$modifiedBody = $this->getModifiedBodyForInterLinking($document->body,$hitsArray);
		$modifiedBody = preg_replace('~\{(.+?)\}~', '', $modifiedBody);
		
	   $valuesArray = array();
	   $valuesArray['alertFlag'] = Input::get('alertFlag');
	   $valuesArray['searchTermId'] = Input::get('searchTermId');
	   $valuesArray['noteup'] = 'true';
	   $valuesArray['resultset'] = $resultset;
	   $valuesArray['highlights'] = $highlights;
	   $valuesArray['searchString'] = $searchString;
	   $valuesArray['docPropertiesArray'] = $docPropertiesArray;
	   $valuesArray['st'] = $st;
	   $valuesArray['q'] = $st;
	   $valuesArray['prevDoc'] = $prevDoc;
	   $valuesArray['nextDoc'] = $nextDoc;
	   $valuesArray['hits'] = $hits;
	   $valuesArray['maxhit'] = $maxhit;
	   $valuesArray['hitsForSearchResults'] = $hitsForSearchResults;
	   $valuesArray['ids'] = $ids;
	   $valuesArray['id'] = $did;
	   $valuesArray['name'] = '';
	   $valuesArray['institution'] = $document->institution;
	   $valuesArray['institution_subdivision'] = $document->institution_subdivision;
	   $valuesArray['linkBody'] = $modifiedBody;
	   $valuesArray['showdocument'] = 1;
	   $valuesArray['hightlight_array'] = $highlight_array;
	   }
	    else
	   {
		$valuesArray = array();
		$valuesArray['alertFlag'] = 0;
		$valuesArray['id'] = 0;
		$valuesArray['maxhit'] =0;
		$valuesArray['searchTermId'] = 0;
		$valuesArray['showdocument'] = 0;
	   }
	   
	   return View::make('document.index',['valuesArray' => $valuesArray]);
		 
		/* return View::make('document.index', array('noteup' => 'true',
		'resultset' => $resultset,
		'highlights' => $highlights,
		'finalSearchString' => $finalSearchString,
		'searchString' => $searchString,
		'docPropertiesArray' => $docPropertiesArray, 
		'st'=>$st,
		'q'=>$st,
		'prevDoc' => $prevDoc,
		'nextDoc' => $nextDoc,
		'hits' => $hits,
		'hitsForSearchResults' => $hitsForSearchResults,
		'maxhit'=>$maxhit,
		'ids'=>$ids,
		'id'=>$did,
		'name'=>'',
		'institution'=> $document->institution,
		'institution_subdivision'=>$document->institution_subdivision,
		'linkBody' => $modifiedBody
		)); */
		//return View::make('document.index', []);
	}

    public function showBrowse($institutionId = 0, $sortParam = 'title', $direction = 'asc', $page = 1, $year = 0, $letter = null) {
		session_start();
		$_SESSION["finalSearchString"] = '';
		$_SESSION["search_page"] = 'false';
		$this->insitutionId = $institutionId;
        $this->sortParam = $sortParam;
        $this->sortDirection = $direction;
        $this->currentPage = $page;
        $this->letterFilter = $letter;
        $this->yearFilter = $year;

        // validate letter input
        if(!in_array($this->letterFilter, range('a', 'z'))) {
            $this->letterFilter = null;
        }

        $this->handleSortParams();

        // alphabet menu
        $alphabet = array();

        foreach(range('A', 'Z') as $char ) {
            $alphabet[$char] = array(
                'link' => $this->getLink(null, null, null, null, strtolower($char)),
                'active' => (strtolower($char) == $this->letterFilter) ? true : false
            );
        }
        // add a reset button for letters
        $alphabet['Reset'] = array(
            'link' => $this->getLink(null, null, null, null, ''),
            'active' => false
        );

        // years menu
        $years = array();

        if($year != 0)
		{
			//log::info('session value is');
			//log::info($_SESSION["instituteYears"]);
			$decadeYear = ((floor($year/10)) * (10));
			// TODO: fix year range
			//foreach(range($decadeYear, ($decadeYear+9)) as $dyear ) {
			foreach($_SESSION["instituteYears"] as $dyear ) {
				//log::info($dyear);
				if($dyear['actualYear'] == $year)
				{
					$years[$dyear['actualYear']] = array(
						'link' => $this->getLink(null, null, null, $dyear['actualYear']),
						//'active' => ($dyear == $this->yearFilter) ? true : false,
						'active' => true,
						'year' => '<font color="red">'.$dyear['actualYear'].'</font>',
						'actualYear' => $dyear['actualYear']
					);
				}
				elseif($dyear['active'] == 'true')
				{
					$years[$dyear['actualYear']] = array(
						'link' => $this->getLink(null, null, null, $dyear['actualYear']),
						//'active' => ($dyear == $this->yearFilter) ? true : false,
						'active' => true,
						'year' => '<font color="black">'.$dyear['actualYear'].'</font>',
						'actualYear' => $dyear['actualYear']
					);
				}
				else
				{
					$years[$dyear['actualYear']] = array(
						'link' => $this->getLink(null, null, null, $dyear['actualYear']),
						'active' => ($dyear == $this->yearFilter) ? true : false,
						'year' => '<font color="#C0C0C0">'.$dyear['actualYear'].'</font>',
						'actualYear' => $dyear['actualYear']
					);
				}
			} 
		}

        // Create a search query
        $query = $this->client->createSelect();
        $query->setSorts(array($this->sortField => $this->sortDirection));
        $query->setStart(($page - 1) * static::RESULTS_PER_PAGE);
        $query->setRows(static::RESULTS_PER_PAGE);

        $queryParams = array();
		
        if($this->yearFilter) 
		{
            $startDate = $this->yearFilter.'-01-01';
			$endDate = ($this->yearFilter).'-12-31';
			
			$queryParams[] = sprintf(
                'date:[%s TO %s]',
                //Document::convertDateToSolrFormat($this->yearFilter . '-01-01'),
				Document::convertDateToSolrFormat(date('Y-m-d',strtotime($startDate))),
				Document::convertDateToSolrFormat(date('Y-m-d',strtotime($endDate)))
				
               // Document::convertDateToSolrFormat(($this->yearFilter + 1) . '-01-01')
            );
        }
		
        if($this->letterFilter) {
            $queryParams[] = sprintf('title_letter:"%s"', strtoupper($this->letterFilter));
        }
		
        $institution = Institution::find($this->insitutionId);
		
		$_SESSION["instituteId"] = $institution;
		//log::info($_SESSION['instituteId']->name);
        if($_SESSION["instituteId"]->name == 'Treaty Collection')
		{
			 $queryParams[] = sprintf('type:%s', 'treaty');
			$query->setQuery('type:treaty');
			if($queryParams) {
				$queryString = implode(' AND ', $queryParams);
			} else {
				$queryString = 'type:treaty';
			}
			//log::info($queryString);
			$query->setQuery($queryString);
		}
		else if($institution->name == 'Commentary Collection')
		{
			$queryParams[] = sprintf('type:%s', 'commentary');
			$query->setQuery('type:commentary');
			if($queryParams) {
				$queryString = implode(' AND ', $queryParams);
			} else {
				$queryString = 'type:commentary';
			}
			$query->setQuery($queryString);
		}
		else
		{
			if($institution) {
				$queryParams[] = sprintf('institution_s:"%s"', $institution->name);
			}
			
			if($queryParams) {
				$queryString = implode(' AND ', $queryParams);
			} else {
				$queryString = '*:*';
			}
			$query->setQuery($queryString);
		}
        	
			
		// Execute the query and return the result
        $resultset = $this->client->select($query);
		//log::info($resultset->getNumFound());
		
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
		
		$decadesArray = array();
		if($year == 0)
		{
			foreach($resultset->getDocuments() as $doc)
			{
				$yr = date('Y',strtotime(Document::convertDateFromSolrFormat($doc->date, Document::DATE_FORMAT_NICE)));
				//$decadesArray[$yr] = $yr;
				$decadeYear = ((floor($yr/10)) * (10));
				$decadesArray[$decadeYear] = $decadeYear;
				
				if(array_key_exists($yr, $years) == false)
				{
					$years[$yr] = array(
					'link' => $this->getLink(null, null, null, $yr),
					'active' => true,
					'year' => '<font color="black">'.$yr.'</font>',
					'actualYear' => $yr);
				}
			}
			//log::info($decadesArray);
			//log::info($years);
			foreach($decadesArray as $decade)
			{
				$endDecadeYear = $decade + 9;
				
				for($i = $decade; $i <= $endDecadeYear; $i++)
				{
					//log::info($i);
					$dt = '01-01-'.$i;
					//log::info($dt); 
					$yr = date('Y',strtotime($dt));
					//log::info($yr);
					if(array_key_exists($yr, $years) == false)
					{
					
						$years[$yr] = array(
						'link' => $this->getLink(null, null, null, 0),
						'active' => false,
						'year' => '<font color="#C0C0C0">'.$yr.'</font>',
						'actualYear' => $yr);
					}
				}
			}
			//log::info(count($years));
			$_SESSION["instituteYears"] = $years;
		}
		ksort($years);
		// add a reset button for years
		/*
		foreach($tempArray as $temp)
		{
			log::info($temp);
			$years[$temp] = array(
					'link' => $this->getLink(null, null, null, $temp),
					'active' => ($temp == $this->yearFilter) ? true : false,
					'year' => $temp );
		} */
		
       /* $years[] = array(
            'link' => $this->getLink(null, null, null, 0),
            'active' => true,
            'year' => '<font color="black">Reset</font>'
        ); */
		
		//log::info($years);	
        $viewParams =  array(
            'alphabet' => $alphabet,
			'ids' => $ids,
			'hits' => $hits,
            'years' => $years,
            'institution' => $institution,
            'resultset' => $resultset,
            'sortParam' => $this->sortField,
            'tableHeader' => $this->getTableHeader(),
            'pagination' => $this->getPagination($resultset->getNumFound()),
            'currentLink' => $this->getLink(),
            //'activePage' => $this->activePage
        );

        return View::make('document.browse', $viewParams);
    }
	
	/*public function browseTreatyDocuments($sortParam = 'title', $direction = 'asc', $page = 1, $year = 0, $letter = null)
	{
		
        $this->sortParam = $sortParam;
        $this->sortDirection = $direction;
        $this->currentPage = $page;
        $this->letterFilter = $letter;
        $this->yearFilter = $year;

        // validate letter input
        if(!in_array($this->letterFilter, range('a', 'z'))) {
            $this->letterFilter = null;
        }

        $this->handleSortParams();

        // alphabet menu
        $alphabet = array();

        foreach(range('A', 'Z') as $char ) {
            $alphabet[$char] = array(
                'link' => $this->getLink(null, null, null, null, strtolower($char)),
                'active' => (strtolower($char) == $this->letterFilter) ? true : false
            );
        }
        // add a reset button for letters
        $alphabet['Reset'] = array(
            'link' => $this->getLink(null, null, null, null, ''),
            'active' => false
        );

        // years menu
        $years = array();

        // TODO: fix year range
        foreach(range(2000, 2014) as $year ) {
            $years[] = array(
                'link' => $this->getLink(null, null, null, $year),
                'active' => ($year == $this->yearFilter) ? true : false,
                'year' => $year
            );
        }
        // add a reset button for years
        $years[] = array(
            'link' => $this->getLink(null, null, null, 0),
            'active' => false,
            'year' => 'Reset'
        );
		
		$query = $this->client->createSelect();
		// set sort direction and column + select specified amount of documents
		$query->setSorts(array($this->sortField => $this->sortDirection));
        $query->setStart(($page - 1) * static::RESULTS_PER_PAGE);
        $query->setRows(static::RESULTS_PER_PAGE); 
   
		$queryParams = array();

        if($this->yearFilter) {
            $queryParams[] = sprintf(
                'date:[%s TO %s]',
                Document::convertDateToSolrFormat($this->yearFilter . '-01-01'),
                Document::convertDateToSolrFormat(($this->yearFilter + 1) . '-01-01')
            );
        }

        if($this->letterFilter) {
            $queryParams[] = sprintf('title_letter:"%s"', strtoupper($this->letterFilter));
        }
		$query->setQuery('type:treaty');
		
	   

		/*$query->addField(sprintf("hits:termfreq(text,'%s')", $string));

		$hl = $query->getHighlighting();
		$hl->setFields(array('title, body, institution'));
		$hl->setSnippets(10000);
		$hl->setFragSize(300);
		$hl->setSimplePrefix('<span class="highlight">');
		$hl->setSimplePostfix('</span>'); 

		$resultset = $this->client->select($query);
		log::info($resultset->getNumFound());
		
		$institution = Institution::findByName('Treaty Collection');
		
		$viewParams =  array(
            'alphabet' => $alphabet,
            'years' => $years,
            'institution' => $institution,
            'resultset' => $resultset,
            'sortParam' => $this->sortField,
            'tableHeader' => $this->getTableHeader(),
            'pagination' => $this->getPagination($resultset->getNumFound()),
            'currentLink' => $this->getLink(),
            //'activePage' => $this->activePage
        );

        return View::make('document.browse', $viewParams);
	}*/

    /**
     * @param null $sortParam
     * @param null $sortDirection
     * @param null $yearParam
     * @param null $letterParam
     * @return string uri
     */
    protected function getLink($sortParam = null, $sortDirection = null, $pageParam = null, $yearParam = null, $letterParam = null) {
      //  log::info('inside getLink');
	  
		$linkParams = array(
            $this->uri,
			 $this->insitutionId,
            ($sortParam !== null) ? $sortParam : $this->sortParam,
            ($sortDirection !== null) ? $sortDirection : $this->sortDirection,
            ($pageParam !== null) ? $pageParam : $this->currentPage,
            ($yearParam !== null) ? $yearParam : $this->yearFilter,
            ($letterParam !== null) ? $letterParam : $this->letterFilter
        );

        return URL::to(implode('/', $linkParams));
    }
	
	protected function getPagination($totalNrOfItems = 0) {

      //  log::info('inside getPagination');
		//log::info($totalNrOfItems);
		$nrOfPages = ceil($totalNrOfItems/self::RESULTS_PER_PAGE);

        $pagination = array();

        // first check if we even need a pagination
        if(self::RESULTS_PER_PAGE < $totalNrOfItems) {
            for($i = 1; $i <= $nrOfPages; $i++) {

                // first element
                if($i == 1) {
                    $pagination[] = array(
                        'cssClass' => ($this->currentPage == 1) ? 'disabled' : '',
                        'link' => $this->getPaginationLink(null, null, $this->currentPage - 1),
                        'label' => '&laquo;'
                    );
                }

                // pages
				if($i == $this->currentPage)
				{
					$pagination[] = array(
                    'cssClass' => ($this->currentPage == $i) ? 'active' : '',
                    'link' => $this->getPaginationLink(null, null, $i),
                    'label' => '<u>'.$i.'</u>'
                );
				}
				else
				{
					$pagination[] = array(
                    'cssClass' => ($this->currentPage == $i) ? 'active' : '',
                    'link' => $this->getPaginationLink(null, null, $i),
                    'label' => $i
                );
				}
                

                // last element
                if ($i == $nrOfPages) {
                    $pagination[] = array(
                        'cssClass' => ($this->currentPage == $nrOfPages) ? 'disabled' : '',
                        'link' => $this->getPaginationLink(null, null, $this->currentPage + 1),
                        'label' => '&raquo;'
                    );
                }
            }
        }

        return $pagination;

    }
	
	protected function getPaginationLink($sortParam = null, $sortDirection = null, $pageParam = null) {

       // log::info('inside getPaginationLink');
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
			$_SESSION["instituteId"]->id,
            ($sortParam !== null) ? $sortParam : $this->sortParam,
            ($sortDirection !== null) ? $sortDirection : $this->sortDirection,
            ($pageParam !== null) ? $pageParam : $this->currentPage
        );

        if($urlParams) {
            $linkParams[] = '?' . implode('&', $urlParams);
        }

        return URL::to(implode('/', $linkParams));
    }
	
	public function getTaggedString($string)
	{
	
		$newString = $string; 
		if(strpos($newString,'<span') !== false)
		{
			$newString = str_replace('<span class="highlight">','',$newString);
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
							
							$name = preg_replace('/\s+/', '', $contentAfterCurlyBracket[1]);
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
	
	public function getSearchString($searchString,$docCnt)
	{
		log::info($searchString);
		$finalSearchString='';
		$resArray = explode(',,',$searchString);
			log::info($resArray);
			foreach($resArray as $index => $res)
			{
				$splitArray = explode('*',$res);
				log::info($splitArray);
				if($splitArray[0] == '1')
				{
					$searchStringArray[1] = $splitArray[1];
					if($splitArray[1]!='')
					{
						$finalSearchString = $docCnt.' documents found for "'.$splitArray[1].'"';
					}
					else
					{
						$finalSearchString = $docCnt.' documents found for ';
					}
				}
				if($splitArray[0] == '2')
				{
					$searchStringArray[2] = $splitArray[1];
					$finalSearchString = $finalSearchString." + Title: ".$splitArray[1];
				}
				if($splitArray[0] == '3')
				{
					$searchStringArray[3] = $splitArray[1];
					$finalSearchString = $finalSearchString." + Parites: ".$splitArray[1];
				}
				if($splitArray[0] == '4')
				{
					$searchStringArray[4] = $splitArray[1];
					$finalSearchString = $finalSearchString." + Citation: ".$splitArray[1];
				}
				if($splitArray[0] == '5')
				{
					$searchStringArray[5] = $splitArray[1];
					$finalSearchString = $finalSearchString." + Judges/Counsel: ".$splitArray[1];
				}
				if($splitArray[0] == '6')
				{
					$searchStringArray[6] = $splitArray[1];
					$finalSearchString = $finalSearchString." + Document Type: ".$splitArray[1];
				}
				if($splitArray[0] == '7')
				{
					$searchStringArray[7] = $splitArray[1];
					$finalSearchString = $finalSearchString." + Dates: ".$splitArray[1];
				}
				if($splitArray[0] == '8')
				{
					$searchStringArray[8] = $splitArray[1];
					$finalSearchString = $finalSearchString." to ".$splitArray[1];
				}
			}
		return $finalSearchString;	
	}
	
	function limitstring($str, $query, $numOfWordToAdd) {
		list($before, $after) = explode($query, $str);

		//$before = rtrim($before);
		//$after  = ltrim($after);

		$beforeArray = array_reverse(explode(" ", $before));
		$afterArray  = explode(" ", $after);

		$countBeforeArray = count($beforeArray);
		$countAfterArray  = count($afterArray);

		$beforeString = "";
		if($countBeforeArray < $numOfWordToAdd) {
			$beforeString = implode(' ', $beforeArray);
		}
		else {
			for($i = 0; $i < $numOfWordToAdd; $i++) {
				$beforeString = $beforeArray[$i] . ' ' . $beforeString; 
			}
		}

		$afterString = "";
		if($countAfterArray < $numOfWordToAdd) {
			$afterString = implode(' ', $afterArray);
		}
		else {
			for($i = 0; $i < $numOfWordToAdd; $i++) {
				$afterString = $afterString . $afterArray[$i] . ' '; 
			}
		}

		$string = $beforeString . $query . ' ' . $afterString;

		return $string;
	}
	
	function getnexttwowords($str, $query, $numOfWordToAdd) {
		list($before, $after) = explode($query, $str);

		//$before = rtrim($before);
		//$after  = ltrim($after);

		$beforeArray = array_reverse(explode(" ", $before));
		$afterArray  = explode(" ", $after);

		$countBeforeArray = count($beforeArray);
		$countAfterArray  = count($afterArray);

		$beforeString = "";
		if($countBeforeArray < $numOfWordToAdd) {
			$beforeString = implode(' ', $beforeArray);
		}
		else {
			for($i = 0; $i < $numOfWordToAdd; $i++) {
				$beforeString = $beforeArray[$i] . ' ' . $beforeString; 
			}
		}

		$afterString = "";
		if($countAfterArray < $numOfWordToAdd) {
			$afterString = implode(' ', $afterArray);
		}
		else {
			for($i = 0; $i < $numOfWordToAdd; $i++) {
				$afterString = $afterString . $afterArray[$i] . ' '; 
			}
		}

		$string = $query . ' ' . $afterString;

		return $string;
	}
}
