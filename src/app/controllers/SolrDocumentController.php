<?php

class SolrDocumentController extends \BaseController {

    /**
     * type constants
     * TODO: move to a more appropriate location
     */
    const TYPE_DECISION = 'decision';
    const TYPE_TREATY = 'treaty';
    const TYPE_COMMENTARY = 'commentary';
  
    
    private $types = array(
        self::TYPE_DECISION,
        self::TYPE_TREATY,
        self::TYPE_COMMENTARY,
    );

    private $formTypeFields = array(
        'all' => array(
            'type' => array(
                'order' => 1,
                'type' => 'select',
                'label' => 'Type of document',
                'data' => 'types'
            ),
            'title' => array(
                'order' => 4,
                'type' => 'text',
                'label' => 'Document View Title',
                'placeholder' => 'Title'
            ),
	     'search_title' => array(
                'order' => 7,
                'type' => 'text',
                'label' => 'Search Result Title',
                'placeholder' => 'Title'
            ),
            'title_short' => array(
                'order' => 7,
                'type' => 'text',
                'label' => 'Short Title',
                'placeholder' => 'Short Title'
            ),
            'document_type' => array(
                'order' => 8,
                'type' => 'text',
                'label' => 'Document type',
                'placeholder' => 'Document type'
            ),
            'file_no' => array(
                'order' => 12,
                'type' => 'text',
                'label' => 'File No.',
                'placeholder' => 'File No.'
            ),
	     'citation_lbl' => array(
                'order' => 13,
                'type' => 'label',
                'label' => 'WC CITATION REF.:'
            ),
            'citation_short' => array(
                'order' => 14,
                'type' => 'text',
                'label' => 'Citation',
                'placeholder' => 'Citation'
            ),
            'date' => array(
                'order' => 9,
                'type' => 'date',
                'label' => 'Date',
                'placeholder' => 'YYYY-MM-DD'
            ),
            'tags' => array(
                'order' => 15,
                'type' => 'text',
                'label' => 'Tags',
                'placeholder' => 'Tags'
            ),
            'body' => array(
                'order' => 30,
                'type' => 'textarea',
                'label' => 'Text of the Document',
                'rows' => 15
            ),
            'editors_note_public' => array(
                'order' => 21,
                'type' => 'textarea',
                'label' => 'Public Editor\'s Note',
                'rows' => 2
            ),
            'editors_note_private' => array(
                'order' => 22,
                'type' => 'textarea',
                'label' => 'Private Editor\'s Note',
                'rows' => 2
            ),
            'publication' => array(
                'order' => 15,
                'type' => 'text',
                'label' => 'Publication',
                'placeholder' => 'Publication'
            ),
            'serial' => array(
                'order' => 27,
                'type' => 'hidden',
                'update' => false
            ),
            'created' => array(
                'order' => 28,
                'type' => 'hidden',
                'update' => false
            )
        ),
        self::TYPE_DECISION => array(
            'institution' => array(
                'order' => 2,
                'group' => true,
                'type' => 'select',
                'label' => 'Institution',
                'data' => 'institutions',
                'class' => 'Institution',
                'selected' => 'selectedInstitution'
            ),
            'institution_subdivision' => array(
                'order' => 3,
                'group' => true,
                'type' => 'select',
                'label' => 'Institution subdivision',
                'data' => 'institutionSubdivisions',
                'class' => 'InstitutionSubdivision',
                'selected' => 'selectedSubdivision'
            ),
            'applicant' => array(
                'order' => 5,
                'type' => 'text',
                'label' => 'Applicant(s)',
                'placeholder' => 'Applicant'
            ),
            'respondent' => array(
                'order' => 6,
                'type' => 'text',
                'label' => 'Respondent(s)',
                'placeholder' => 'Respondent'
            ),
            /*'victims' => array(
                'order' => 9,
                'type' => 'text',
                'label' => 'Victims',
                'placeholder' => 'Victims'
            ),*/
            'represented_by' => array(
                'order' => 10,
                'type' => 'textarea',
                'label' => 'Represented by',
                'placeholder' => 'Represented by',
				'rows' => 7
            ),
            'decided_by' => array(
                'order' => 11,
                'type' => 'textarea',
                'label' => 'Decided by',
                'rows' => 7
            ),
            'previous_link' => array(
                'order' => 15,
                'type' => 'text',
                'label' => 'Previous link',
                'placeholder' => 'Previous link'
            ),
        ),
        self::TYPE_TREATY => array(
            'in_force_from' => array(
                'order' => 16,
                'type' => 'date',
                'label' => 'In force from',
                'placeholder' => 'YYYY-MM-DD'
            ),
            'in_force_until' => array(
                'order' => 17,
                'type' => 'date',
                'label' => 'In force until',
                'placeholder' => 'YYYY-MM-DD'
            ),
            'ratifications_signatures' => array(
                'order' => 18,
                'type' => 'multi',
                'label' => 'Ratifications & Signatures',
            ),
            'declarations' => array(
                'order' => 19,
                'type' => 'multi',
                'label' => 'Declarations, Reservations & Understandings',
            ),

        ),
        self::TYPE_COMMENTARY => array(
            'author' => array(
                'order' => 20,
                'type' => 'text',
                'label' => 'Author',
                'placeholder' => 'Author'
            ),
            'purchase_link' => array(
                'order' => 24,
                'type' => 'text',
                'label' => 'Purchase link',
                'placeholder' => 'Purchase link'
            ),
            'borrow_link' => array(
                'order' => 25,
                'type' => 'text',
                'label' => 'Borrow link',
                'placeholder' => 'Borrow link'
            ),
            'view_link' => array(
                'order' => 26,
                'type' => 'text',
                'label' => 'View link',
                'placeholder' => 'View link'
            ),
        ),
    );

    /**
     * @var string default
     */
    protected $layout = 'layouts.master';

    /**
     * @var The SOLR client.
     */
    protected $client;

    /**
     * @var string - used to display a nice icon in admin next to the name of the page
     */
    private $icon = 'database';


    public function __construct()
    {
		//session_start();
        $this->beforeFilter('auth');

        // create a client instance
        $this->client = new \Solarium\Client(Config::get('solr'));
	
        // create a ping query
        $ping = $this->client->createPing();

        // execute the ping query
        try {
            $result = $this->client->ping($ping);
        } catch (Solarium\Exception $e) {
            // TODO: the SOLR server is inaccessible, do something more meaningful
            error_log('Solr is not accessible!');
        }
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $viewParams = array();

        $page = 0;
        $pageSize = 50;

        // Create a search query
        $query = $this->client->createSelect();
        $query->setStart($page);
        $query->setRows($pageSize);

        if (Input::has('q')) {

            // Set the query string
            $query->setQuery('%P1%', array(Input::get('q')));

            // Execute the query and return the result
            $resultset = $this->client->select($query);

            // Pass the resultset to the view and return.
            $viewParams =  array(
                'q' => Input::get('q'),
                'resultset' => $resultset,
            );
        } else {

            // Set the query string
            $query->setQuery('*:*');

            // Execute the query and return the result
            $resultset = $this->client->select($query);

            $viewParams =  array(
                'resultset' => $resultset,
            );

        }

        $viewParams['icon'] = $this->icon;
		
		$_SESSION["currentlink"] = 3; 
        return View::make('admin.document.index', $viewParams);
	}

    /**
     * handles admin document ajax requests
     * @param string $type
     * @param int $id
     * @return string mixed json/HTML
     */
    public function ajax($type = '', $id = 0) {
	
        $return = array();
        if($type == 'institution' && is_numeric($id) && $id > 0) {

            $return = array(0 => '-- Select subdivision --') + Institution::find($id)->subdivisions()->lists('name', 'id');
        } elseif ($type == 'declaration' && $id > 0) {
            $rowNumber = $id;
            $states = array(0 => '-- Select state --') + State::lists('name', 'id');

            return View::make('admin.document.partial.declaration', array('i' => $rowNumber, 'states' => $states));
        } elseif ($type == 'ratification' && $id > 0) {
            $rowNumber = $id;
            $states = array(0 => '-- Select state --') + State::lists('name', 'id');

            return View::make('admin.document.partial.ratification', array('i' => $rowNumber, 'states' => $states, 'definition' => 'ratifications_signatures'));
        }
        return json_encode($return);
    }


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $filteredInstitutions = Institution::whereNotIn('name', ['Treaty Collection', 'Commentary Collection'])->get();
		//$institutions = array(0 => '-- Select institution --') + Institution::lists('name', 'id');
		
		$institutions = array(0 => '-- Select institution --');
		$abbreviationArray = array();
		
		foreach($filteredInstitutions as $institution)
		{
			$institutions[$institution->id] = $institution->name;
			$abbreviationArray[$institution->id] = $institution->abbreviation;
		}
		
        $institutionSubdivision = array(0 => '<- Select institution');

        $states = array(0 => '-- Select state --') + State::lists('name', 'id');
		
		$nextDocumentId = $this->getNextId();
		
		//log::info($this->formTypeFields);
		$configurations = Configuration::all();
		$projectAbbreviation = '';
		//log::info($configurations);
		if(count($configurations) > 0)
		{
			$projectAbbreviation = $configurations[0]->value;
		}
		
	//	log::info($projectAbbreviation);
        $viewParameters = array(
            'types' => $this->getTypes(),
            'fieldDefinitions' => $this->formTypeFields,
            'fieldMapping' => $this->getFormTypeFieldsMapping(),
            'icon' => $this->icon,
            'institutions' => $institutions,
			'abbreviation' => json_encode($abbreviationArray),
			'projectAbbreviation' => $projectAbbreviation,
            'institutionSubdivisions' => $institutionSubdivision,
			'nextId' => $nextDocumentId,
            'states' => $states
        );

		
		$_SESSION["currentlink"] = 1;
        return View::make('admin.document.create', $viewParameters);
	}

	/**
	 * Store document
     * if $documentId is provided we are updating an existing document otherwise saving a new one
	 *
	 * @return Response
	 */
	public function store($documentId = 0)
	{
        // TODO: add input validation
		log::info('inside store method');
		log::info(Input::get('finalcitation'));
		//print_r(Input::get('finalcitation')); exit;
		//log::info($documentId);
		//log::info(Input::get('citation_short'));
		// store document to solr DB
        $update = $this->client->createUpdate();
        $doc = $update->createDocument();
		$doc->citation = Input::get('citation_short');		
		log::info($doc->citation);
        $doc->type = Input::get('type');
        $typeFields = $this->getFormTypeFields($doc->type);
		//log::info($this->formTypeFields['all']['body']);
        foreach($typeFields as $field => $fieldData) {
		if($field == 'body')
		{
			$abc = Input::get($field);
			
			preg_match_all("/<(.*?)>/", $abc, $results);
			
				
			$to_remove = array('p','h1','h2','h3','table','br','tr','td','a','br ','para1','para2','para3','/h1','/h2','/h3','/table','/br','/p','/tr','/td','/a','para1/','Para2/','para3/','Para1/','Para2/','Para3/');
			$result = array_diff($results[1], $to_remove);
			
				foreach($results['1'] as $val)
				{
					$ret =5;
					//log::info($val);
					if($documentId)
					{
						$documentReferences = DocumentReferences::select('id', 'key_name')->where('reference_document_number' , $documentId)->get();
						if(count($documentReferences)>0)
						{
							foreach($documentReferences as $dRef)
							{
								$ret = strcmp($dRef->key_name,$val);
								if($ret == 0)
								{
									break;
								}
							}
						}	
						log::info($ret);
						if($ret == 0)
						{
							
						}
						else
						{   //log::info($val);
							if (strpos($val,'/') !== false || strpos($val,'h1') !== false || strpos($val,'h2') !== false || strpos($val,'h3') !== false
							 || strpos($val,'table') !== false || strpos($val,'br') !== false || ($val == 'p') || ($val == 'tr') || ($val == 'td') || ($val == 'a'))
							{
									
							}
							else
							{   
								$docRef = new DocumentReferences;
								$docRef->key_name = $val;
								$docRef->reference_document_number = $documentId;
								$docRef->save();
							}
						}							
					}else{
						if (strpos($val,'/') !== false || strpos($val,'h1') !== false || strpos($val,'h2') !== false || strpos($val,'h3') !== false
							 || strpos($val,'table') !== false || strpos($val,'br') !== false || ($val == 'p') || ($val == 'tr') || ($val == 'td') || ($val == 'a'))
						{
								
						}
						else
						{   
							$docRef = new DocumentReferences;
							$docRef->key_name = $val;
							$docRef->reference_document_number = $this->getNextId();
							$docRef->save();
						}
					}	
				}
				if($documentId){
					$key_name=array();
					$referrenceDocuments = DocumentReferences::select('id', 'key_name')->where('reference_document_number' , $documentId)->get();
					foreach($referrenceDocuments as $refdoc){
						$key_name[$refdoc->id]=$refdoc->key_name;
					}
					$remove_list = array_diff($key_name, $result);
					if(count($remove_list)>0){
						foreach($remove_list as $key => $value){
							$deleteDocuments = DocumentReferences::where('id' , $key)->delete();		
						}
					}
				}	
		}
		
            // skip document type, it does not need to be converted
            if($field == 'type') {
                continue;
            }
            switch($fieldData['type']) {

                case 'select':
                    if(Input::get($field)) {
                        $doc->$field = $fieldData['class']::find(Input::get($field))->name;
                    }
                    break;

                case 'date':
                    $doc->$field = Document::convertDateToSolrFormat(Input::get($field));
                    break;

                case 'multi':
                    $data = array();
                    if($field == 'ratifications_signatures') {
                        $nrOfRows = Input::get('nr_of_ratifications');

                        for($i=1; $i <= $nrOfRows; $i++) {
                            if($state = Input::get($field . '-state-' . $i)) {
                                $signed = Document::convertDateToSolrFormat(Input::get($field . '-signed-'. $i));
                                $ratified = Document::convertDateToSolrFormat(Input::get($field . '-ratified-' . $i));
                                $accessed = Document::convertDateToSolrFormat(Input::get($field . '-accessed-' . $i));
                                $stateObject = State::find(intval($state));

                                if($stateObject) {
                                    $data[] = sprintf('%s,%s,%s,%s', $stateObject->name, $signed, $ratified, $accessed);
                                }
                            }
                        }
                    } elseif($field == 'declarations') {
                        $nrOfRows = Input::get('nr_of_declarations');

                        for($i=1; $i <= $nrOfRows; $i++) {
                            if($state = Input::get($field . '-state-' . $i)) {
                                $text = Input::get($field . '-text-'. $i);
                                $stateObject = State::find(intval($state));

                                if($stateObject) {
                                    $data[] = sprintf('%s~%s', $stateObject->name, $text);
                                }
                            }
                        }
                    }
                    $doc->$field = $data;
                    break;

                default:
                    $doc->$field = Input::get($field);
            }

            if($field == 'tags') {
                $doc->$field = explode(',', $doc->$field);
            }

        }
        $year = intval(date('Y', strtotime(Input::get('date'))));
		
        $institution = Input::get('institution');
        $subdivision = Input::get('institution_subdivision');

        // only get new serial number if we are saving a new document
        if(!$documentId) {
		
		$_SESSION["currentlink"] = 1; 
            $document = new Document();
            $serial = $document->getNextSerialForYear($doc->type, $year);

			
            // get next document id from index
            $doc->id = $this->getNextId();

        } else {
            $serial = Input::get('serial');
            $doc->id = $documentId;
	
			$_SESSION["currentlink"] = 3; 
        }
		$doc->auto_citation = Input::get('finalcitation');
        $doc->serial = $serial;
    //    $doc->citation = $this->getCitation($doc->citation_short, $doc->type, $year, $serial, $institution, $subdivision);
		//$doc->citation = Input::get('citation_short');
		
	    $doc->short_citation = $this->getShortCitation($year,$doc->type,$institution, $serial);
        $update->addDocument($doc);
        $update->addCommit();

        $result = $this->client->update($update);
        // TODO: handle error exception if update fails

        // if we are creating a new decision document we need to also update document count for selected institution
        if($doc->type == self::TYPE_DECISION) {
            $institution = Institution::findByName($doc->institution);
            $institution->updateDocumentCount();
        }
		else if($doc->type == self::TYPE_TREATY)
		{
			$institution = Institution::findByName('Treaty Collection');
			if(count($institution) == 0)
			{
				$institution = new Institution();
				$institution->name = 'Treaty Collection';
				$institution->abbreviation = 'TC';
				$institution->document_count = 1;
				$institution->save();
				
			}
			else
			{
				if(!$documentId) {
					$institution->document_count = $institution->document_count +1;
					$institution->save();
				}	
			}
		}
		else if($doc->type == self::TYPE_COMMENTARY)
		{
			$institution = Institution::findByName('Commentary Collection');
			if(count($institution) == 0)
			{
				$institution = new Institution();
				$institution->name = 'Commentary Collection';
				$institution->abbreviation = 'CC';
				$institution->document_count = 1;
				$institution->save();
				
			}
			else
			{
				if(!$documentId) {
					$institution->document_count = $institution->document_count +1;
					$institution->save();
				}	
			}
		}
		else
		{
		}

        //return Redirect::to('/admin/document');
		return Redirect::to('/admin');
    }
	
	public function getSerial()
	{
		//log::info('inside getSerial');
		$type = $_POST['type'];
		$year = $_POST['year'];
		$document = new Document();
        $serial = $document->getNextSerialForYear($type, $year);
	//	log::info($serial);
		return $serial;
	}

    /**
     * Update the specified user in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        log::info('Inside update method');
		return $this->store($id);
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        //$document
        $query = $this->client->createRealtimeGet();
        $query->addId($id);
        $resultset = $this->client->select($query);

        $document = $resultset->getDocuments()[0];

        $selectedInstitution = Institution::findByName($document->institution);

        $selectedSubdivision = InstitutionSubdivision::findByName($document->institution_subdivision);
        // TODO: handle loading of ratifications and declarations!
        $viewParameters = array(
            'types' => $this->getTypes(),
            'fieldDefinitions' => $this->formTypeFields,
            'fieldMapping' => $this->getFormTypeFieldsMapping(),
            'document' => $document,
            'icon' => $this->icon,
            'institutions' => array(0 => '-- Select institution --') + Institution::lists('name', 'id'),
            'institutionSubdivisions' => array(0 => '-- Select subdivision --') + InstitutionSubdivision::lists('name', 'id', 'institution_id'),
            'selectedInstitution' => ($selectedInstitution) ? $selectedInstitution->id : 0,
            'selectedSubdivision' => ($selectedSubdivision) ? $selectedSubdivision->id : 0,
            'states' => array(0 => '-- Select state --') + State::lists('name', 'id')
        );


        return View::make('admin.document.edit', $viewParameters);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destorydoc()
	{
        $id = $_POST['docid'];
		$instid = $_POST['instid'];
		$typeid = $_POST['typeid'];
		$this->deleteDeadLinksForDocument($id,$instid,$typeid);
		// TODO: update document count for institution when deleting a document

        // get an update query instance
        $update = $this->client->createUpdate();

        // add the delete query and a commit command to the update query
        $update->addDeleteQuery('id:' . $id);
        $update->addCommit();

        // this executes the query and returns the result
        $result = $this->client->update($update);
        // TODO: check for error in case ID does not exist

       // return Redirect::to('/admin/document');
	}
	
	public function deleteDeadLinksForDocument($documentId,$instid='',$typeid='')
	{
		$referredDocuments = DocumentReferences::where('referred_document_number' , $documentId)->get();
		
		foreach($referredDocuments as $referenceDocument)
		{
			DocumentReferences::destroy($referenceDocument->id);
			
		}

        /** reduce count in institution table**/
        if($typeid=='decision'){
			$institution = Institution::findByName($instid);
			$institution->document_count = $institution->document_count -1;
			$institution->save();
		}elseif($typeid=='treaty'){
			$institution = Institution::findByName('Treaty Collection');
			$institution->document_count = $institution->document_count -1;
			$institution->save();
        }else{
			$institution = Institution::findByName('Commentary Collection');
			$institution->document_count = $institution->document_count -1;
			$institution->save();
        }		
		
	}

    /**
     * generates document citation out of given parameters
     * Definition:
     * Citation field will consist of several elements:
     *   1) short title of the case - entered manually (text field);
     *   2) Auto-generated part that will consists of three elements:
     *      - Year (from date field) +
     *      - Abbreviation for the project name (set in the Settings, for example WC) +
     *      - For decisions: abbreviation of the institution, and sub-institution (set in the Setting); For treaties: word “Treaties”; For commentaries: set manually in the document +
     *      - Serial number (auto-generated) by the system which shows the order of the decision/treaty in the year for that specific institution/sub-institution (based on when it was entered into the system).
     *
     *     Example: Some citation text, 1994 WC ICTY 4939 or 1994 WC Treaty 48.

     * @param $text
     * @param $type
     * @param $year
     * @param $serial
     * @param null $institution
     * @param null $subdivision
     * @return string
     */
    private function getCitation($text, $type, $year, $serial, $institution = null, $subdivision = null) {

        $project = Configuration::getValue('projectAbbreviation');
		$dot = '.';
        $abbreviation = '';

        if($type == self::TYPE_DECISION) {
            if($institution) {
                $abbreviation = ' ' . Institution::find($institution)->abbreviation;
            }

            if($subdivision) {
                $abbreviation .= '/' . InstitutionSubdivision::find($subdivision)->abbreviation;
            }
        } elseif($type == self::TYPE_TREATY) {
            $abbreviation = ' ' . ucfirst(self::TYPE_TREATY);
        }
		elseif($type == self::TYPE_COMMENTARY) {
            $abbreviation = ' ' . ucfirst(self::TYPE_COMMENTARY);
        }

        if(!empty($text)) {
            $text .= ', ';
        }

        $citation = sprintf('%s%s %s%s%s %s',$text, $year, $project, $dot, $abbreviation, $serial);

        return $citation;
    }
	
	 private function getShortCitation($year,$type, $institution = null, $serial) {

        $abbreviation = '';

        if($type == self::TYPE_DECISION) {
            if($institution) {
                $abbreviation = Institution::find($institution)->abbreviation;
            }
        } elseif($type == self::TYPE_TREATY) {
            $abbreviation = self::TYPE_TREATY;
        }
		elseif($type == self::TYPE_COMMENTARY) {
            $abbreviation = self::TYPE_COMMENTARY;
        }
	//	$test = $year.$abbreviation.$serial;
	//	log::info($test);
        $shortCitation = sprintf('%s%s%s',$year,strtolower($abbreviation), $serial);
		log::info($shortCitation);
        return $shortCitation;
    }

    /**
     * query the index for current max index and return the next index
     * @return int
     */
    private function getNextId() {

        $query = $this->client->createSelect();

        $query->setQuery('*:*');
        $query->setFields(array('id'));
        $query->setSorts(array('id' => 'desc'));
        $query->setRows(1);

        // Execute the query and return the result
        $resultset = $this->client->select($query);

        try {
            $documentId = $resultset->getDocuments()[0]->id;
            $documentId++;
        } catch (ErrorException $e) {
            // this only happens if the index does not exist
            // TODO: do something with the error
            $documentId = 1;
        }

        return $documentId;
    }

    /**
     * convert available document types into an array that can be used for a drop down selector
     * @return array
     */
    private function getTypes() {
        $types = array();
        foreach($this->types as $type) {
            $types[$type] = ucfirst($type);
        }
        return $types;
    }

    private function getFormTypeFieldsMapping() {
        $result = array();
        $order = array();
        foreach($this->formTypeFields as $type => $data) {
            foreach($data as $key => $value) {
                $result[$key] = $type;
                $order[$key] = $value['order'];
            }

        }

        // sort the keys according to order
        asort($order);

        // reorder output array
        $tmp = array();
        foreach($order as $field => $number) {
            $tmp[$field] = $result[$field];
        }

        $result = $tmp;
        return $result;
    }
	
	public function editIndex()
	{
		 log::info('Inside editIndex method');
		// $institutions = array(0 => '-- Select institution --') + Institution::lists('name', 'id');
        $institutionSubdivision = array(0 => '<- Select institution');

		$filteredInstitutions = Institution::whereNotIn('name', ['Treaty Collection', 'Commentary Collection'])->get();
		//$institutions = array(0 => '-- Select institution --') + Institution::lists('name', 'id');
		
		$institutions = array(0 => '-- Select institution --');
		foreach($filteredInstitutions as $institution)
		{
			$institutions[$institution->id] = $institution->name;
		}
		
        $states = array(0 => '-- Select state --') + State::lists('name', 'id');

        $viewParameters = array(
            'types' => $this->getTypes(),
            'fieldDefinitions' => $this->formTypeFields,
            'fieldMapping' => $this->getFormTypeFieldsMapping(),
            'icon' => $this->icon,
            'institutions' => $institutions,
            'institutionSubdivisions' => $institutionSubdivision,
			'showEdit' => 0,
			'idNotFound' => 0,
            'states' => $states
        );
				$_SESSION["currentlink"] = 3;
        return View::make('admin.document.edit', $viewParameters);
	}
	
	public function getDocument()
	{ 
		$id = Input::get('docnumtb');
		$query = $this->client->createRealtimeGet();
        $query->addId($id);
        $resultset = $this->client->select($query);
		if(count($resultset->getDocuments()) > 0)
		{
			$document = $resultset->getDocuments()[0];
			
			/** new code **/
			$ratifications_array=array();
			log::info($document->ratifications_signatures);
			$count=count($document->ratifications_signatures);
			for($i=0;$i<$count;$i++){			
				$ratifications_array[$i] = explode(",",$document->ratifications_signatures[$i]);
				$ratifications_array[$i][0]=array_search($ratifications_array[$i][0],State::lists('name', 'id'));
				$ratifications_array[$i][1] = date('Y-m-d',strtotime(Document::convertDateFromSolrFormat($ratifications_array[$i][1], Document::DATE_FORMAT_NICE)));
				$ratifications_array[$i][2] = date('Y-m-d',strtotime(Document::convertDateFromSolrFormat($ratifications_array[$i][2], Document::DATE_FORMAT_NICE)));
				$ratifications_array[$i][3] = date('Y-m-d',strtotime(Document::convertDateFromSolrFormat($ratifications_array[$i][3], Document::DATE_FORMAT_NICE)));
			}
			if($count>5){ $ratification_count=$count; }else{ $ratification_count=5; }
			
			$declarations_array=array();
			$count_dec=count($document->declarations);
			for($i=0;$i<$count_dec;$i++){			
				$declarations_array[$i] = explode("~",$document->declarations[$i]);
				$declarations_array[$i][0]=array_search($declarations_array[$i][0],State::lists('name', 'id'));
				$declarations_array[$i][1] = $declarations_array[$i][1];
			}
			
			if($count_dec>5){ $declaration_count=$count_dec; }else{ $declaration_count=5; }
			/** new code ends **/
		
			$selectedInstitution = Institution::findByName($document->institution);

			$selectedSubdivision = InstitutionSubdivision::findByName($document->institution_subdivision);
			// TODO: handle loading of ratifications and declarations!
			$viewParameters = array(
				'types' => $this->getTypes(),
				'fieldDefinitions' => $this->formTypeFields,
				'fieldMapping' => $this->getFormTypeFieldsMapping(),
				'document' => $document,
				'icon' => $this->icon,
				'institutions' => array(0 => '-- Select institution --') + Institution::lists('name', 'id'),
				'institutionSubdivisions' => array(0 => '-- Select subdivision --') + InstitutionSubdivision::lists('name', 'id', 'institution_id'),
				'selectedInstitution' => ($selectedInstitution) ? $selectedInstitution->id : 0,
				'selectedSubdivision' => ($selectedSubdivision) ? $selectedSubdivision->id : 0,
				'showEdit' => 1,
				'idNotFound' => 0,
				'states' => array(0 => '-- Select state --') + State::lists('name', 'id'),
				'ratifications_array' => $ratifications_array,
				'declarations_array' => $declarations_array,
				'ratification_count' => $ratification_count,
				'declaration_count' => $declaration_count
			);
			
		}
		else
		{
			$institutions = array(0 => '-- Select institution --') + Institution::lists('name', 'id');
			$institutionSubdivision = array(0 => '<- Select institution');

			$states = array(0 => '-- Select state --') + State::lists('name', 'id');

			$viewParameters = array(
				'types' => $this->getTypes(),
				'fieldDefinitions' => $this->formTypeFields,
				'fieldMapping' => $this->getFormTypeFieldsMapping(),
				'icon' => $this->icon,
				'institutions' => $institutions,
				'institutionSubdivisions' => $institutionSubdivision,
				'showEdit' => 0,
				'idNotFound' => 1,
				'states' => $states
			);		
        
		}
		
	
		$_SESSION["currentlink"] = 3; 
		return View::make('admin.document.edit', $viewParameters);
        
	}


    private function getFormTypeFields($type = null) {
        $data = array(
            self::TYPE_DECISION => $this->formTypeFields['all'] + $this->formTypeFields[self::TYPE_DECISION],
            self::TYPE_TREATY => $this->formTypeFields['all'] + $this->formTypeFields[self::TYPE_TREATY],
            self::TYPE_COMMENTARY => $this->formTypeFields['all'] + $this->formTypeFields[self::TYPE_COMMENTARY],
        );

        if($type && ($type == self::TYPE_DECISION || $type == self::TYPE_TREATY || $type == self::TYPE_COMMENTARY)) {
            return $data[$type];
        }

        return $data;
    }
}
