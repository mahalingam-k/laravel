<?php

class DocumentReferenceController extends \BaseController {

	private $icon = 'document_references';
	const RESULTS_PER_PAGE = 20;

    public function __construct()
    {	
        $this->beforeFilter('auth');
	 //session_start();
    }
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//log::info('inside index method');
        $documentReferences = DocumentReferences::select('*')->orderBy('key_name', 'ASC')->get();
		
		$_SESSION["currentlink"] = 2;
		
		$this->preparePaginationArray($documentReferences);
		return $this->getPagination(1,'aa','');
       // return View::make('admin.reference.index', ['searchedTag' => '','documentReferences' => $documentReferences, 'icon' => $this->icon]);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.reference.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		 $documentReference = new DocumentReferences();

        $documentReference->value_name = Input::get('name');
       // $documentReference->save();
			$_SESSION["currentlink"] = 2; 
        return Redirect::to('/admin/reference');
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
		log::info('$id');
		//$documentReference = DocumentReferences::find($id);

        return View::make('admin.reference.edit', [ 'documentReference' => $documentReference ]);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		log::info('inside update');
		//log::info($id);
		//log::info(Input::get('name'.$id));
		$docRef = DocumentReferences::find($id);
        $docRef->value_name = Input::get('name'.$id);
        $docRef->save();
				$_SESSION["currentlink"] = 2; 
		return Redirect::to('/admin/reference');
	}
	
	public function updatetagvalues()
	{
		log::info('inside updatetagvalues of documentReferencecontroller');
		$tagsmap = $_POST["tagsmap"];
		//log::info($tagsmap);
		$tags = explode(',', $tagsmap);
		foreach($tags as $tag)
		{
			$pair = explode(':', $tag);
			if(count($pair)==2)
			{
				/*log::info($pair['0']);
				log::info($pair['1']); */
				$docRef = DocumentReferences::find($pair['0']);
				$docRef->value_name = $pair['1'];
				$index = 0;
				for($i=0; $i<strlen($pair['1']); $i++)
				{
					if(!is_numeric(substr($pair['1'], $i, 1)))
					{
						$index = $i;
						
						break;
					}
				}
				
				$docRef->referred_document_number = substr($pair['1'], 0, $index);
				
			    $docRef->save();
			}
		}
		
		
		$_SESSION["currentlink"] = 2; 
		return Redirect::to('/admin/reference');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		DocumentReferences::destroy($id);
		
				$_SESSION["currentlink"] = 2; 
        return Redirect::to('/admin/document-reference');
	}

	public function searchTags()
	{
		log::info('Inside searchTags');
		$tagName = Input::get('getTagName');
		$references = DocumentReferences::where('key_name','LIKE', '%'.$tagName.'%')->get();
		
		$_SESSION["currentlink"] = 2; 
		$this->preparePaginationArray($references);
		return $this->getPagination(1,'aa',$tagName);
	//	return View::make('admin.reference.index', ['searchedTag' => $tagName,'documentReferences' => $references, 'icon' => $this->icon]);	
	}
	
	public function searchByCharacter($searchedCharacter = null)
	{
		$references = DocumentReferences::where('key_name','LIKE', $searchedCharacter.'%')->get();
			
		
		$_SESSION["currentlink"] = 2;
		
		$this->preparePaginationArray($references);
		return $this->getPagination(1,$searchedCharacter,'');
	}
	
	public function preparePaginationArray($documentReferences)
	{
		log::info('Inside preparePaginationArray');
		
		$paginationArray = array();
		$paginationIndex = 1;
		$totalNrOfItems=0;
		$index = 0;
		$documentReferenceParts = array();
		foreach($documentReferences as $idx => $documentReference)
		{
			if($index != self::RESULTS_PER_PAGE)
			{
				$documentReferenceParts[$idx] = $documentReference;
			}
			else
			{
				$paginationArray[$paginationIndex] = $documentReferenceParts;
				$documentReferenceParts = array();
				$documentReferenceParts[$idx] = $documentReference;
				$paginationIndex++;
				$index = 0;
			}
			$index++;
			$totalNrOfItems++;
		}
		$paginationArray[$paginationIndex] = $documentReferenceParts;
		log::info($totalNrOfItems);
		//log::info($paginationArray);
		//session_start();
		$_SESSION["paginationArray"] = $paginationArray;
	}
	
	public function paginate($pageNum) {
	
		
		return $this->getPagination($pageNum,'aa','');
	}
	
	protected function getPagination($currentpg,$highlightLink,$searchedTag) {

        $paginationURL = '/admin/reference/pagination/';
		$paginationArray = array();
		$paginationArray = $_SESSION["paginationArray"];
		$documentReferencePart = $paginationArray[$currentpg];
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
					'label' => '<font color="black"><u>'.$i.'</font></u>'
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
		//$resultsAsArray = $this->getUserStats($usersPart);
		return View::make('admin.reference.index', ['pagination' => $pagination ,'highlightLink' => $highlightLink, 'references' => $documentReferencePart, 'searchedTag'=>$searchedTag,'icon' => $this->icon]);
		//return View::make('user.index', ['pagination' => $pagination ,'stats' => $statsPart, 'st_date' =>$s_date, 'end_date' =>$e_date]);
	}
}
