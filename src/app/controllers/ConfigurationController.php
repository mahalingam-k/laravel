<?php

class ConfigurationController extends \BaseController {

    private $icon = 'configuration';

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
        $states = State::where('id','>',0)->orderBy('name','asc')->get();
		$stArray = array();
		$stArray[0] = 'Select One';
		foreach($states as $state)
		{
			$stArray[$state->id] = $state->name;
		}
		$configurations = Configuration::all();
		
		//$institutions = Institution::all();
		$institutions = Institution::whereNotIn('name', ['Treaty Collection', 'Commentary Collection'])
		->orderBy('name','asc')->get();
		$instArray = array();
		$instArray[0] = 'Select Institution';
		$subinstituteArray = array();
		$subinstituteArray[0] = 'Select Sub-Institution';
		$subinstitutions = array();
		
		foreach($institutions as $institute)
		{
			$instArray[$institute->id] = $institute->name;
			$subdivisions = InstitutionSubdivision::where('institution_id', $institute->id)
			->orderBy('name','asc')->get();
			$tempArray = array();
			foreach($subdivisions as $subdivision)
			{
				$tempArray[$subdivision->id] = $subdivision->abbreviation;
			}
			$subinstitutions[$institute->id] = $tempArray;
		}
		
		//log::info($subinstitutions);
		
		$abbreviation = array();
		$abbreviation[0] = 'Select Abbreviation';
		
		// $project = Configuration::getValue('projectAbbreviation');
		
		$footers = Footer::all();
		$newFooters = array();
		
		foreach($footers as $index => $footer)
		{
			$newFooters[$footer->type] = $footer;
		}

		if(array_key_exists('about', $newFooters) == false)
		{
			$footer = new Footer();
			$footer->content = '';			
			$newFooters['about'] = $footer;

		}
		if(array_key_exists('termsandconditions', $newFooters) == false)
		{
			$footer = new Footer();
			$footer->content = '';			
			$newFooters['termsandconditions'] = $footer;

		}

		if(array_key_exists('help', $newFooters) == false)
		{
			$footer = new Footer();
			$footer->content = '';			
			$newFooters['help'] = $footer;

		}

		
		$_SESSION["currentlink"] = 4; 
                return View::make('admin.configuration.index', 
		['footers' => $newFooters, 
		'inst' => $institutions,
		'configurations' => $configurations, 
		'states' => $stArray,
		'institutions'=>$instArray,
		'subinstitutions' => $subinstituteArray,
		'subinstitutionsValues' => json_encode($subinstitutions),		
		'abbreviation' => $abbreviation,
		'icon' => $this->icon]);
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
		$_SESSION["currentlink"] = 4; 
        return View::make('admin.configuration.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $configuration = new Configuration();

        $configuration->name = Input::get('name');
        $configuration->value = Input::get('value');
        $configuration->save();
		
				$_SESSION["currentlink"] = 4; 
        return Redirect::to('/admin/configuration');
	}
	
	public function saveFooterProperties()
	{
		log::info('Inside saveFooterProperties');
		
		$about = Input::get('about');
		$termsAndConditions = Input::get('termsandconditions');
		$help = Input::get('help');
		
		$footers = Footer::where('type', 'about')->get();
		if(count($footers) > 0)
		{
			$footer = $footers[0];
			$footer->content = $about;
			$footer->save();
		}
		else
		{
			$footer = new Footer();
			$footer->type = 'about';
			$footer->content = $about;
			$footer->save();
		}
		
		$footers = Footer::where('type', 'termsandconditions')->get();
		if(count($footers) > 0)
		{
			$footer = $footers[0];
			$footer->content = $termsAndConditions;
			$footer->save();
		}
		else
		{
			$footer = new Footer();
			$footer->type = 'termsandconditions';
			$footer->content = $termsAndConditions;
			$footer->save();
		}
		
		$footers = Footer::where('type', 'help')->get();
		if(count($footers) > 0)
		{
			$footer = $footers[0];
			$footer->content = $help;
			$footer->save();
		}
		else
		{
			$footer = new Footer();
			$footer->type = 'help';
			$footer->content = $help;
			$footer->save();
		}
	
		
		$_SESSION["currentlink"] = 4;
		return View::make('admin.index');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $configuration = Configuration::find($id);

		
		$_SESSION["currentlink"] = 4; 
        return View::make('admin.configuration.edit', [ 'configuration' => $configuration ]);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
       
		$configuration = Configuration::find($id);
		
        $configuration->value = Input::get('value');
        $configuration->save();
		
		
		$_SESSION["currentlink"] = 4; 
        return Redirect::to('/admin/configuration');
	}

	public function updateDBAbbreviation()
	{
		//log::info('Inside updateDBAbbreviation method of config controller');
		$id = $_POST['id'];
		$val = $_POST['value'];
		//log::info($id);
		//log::info($val);
		if($id!=0)
{
		$configuration = Configuration::find($id);
				
        $configuration->value = $val;
        $configuration->save();
}
else
{
$configuration = new Configuration();
				
        $configuration->value = $val;
        $configuration->save();

}

        
		$_SESSION["currentlink"] = 4; 
		return Redirect::to('/admin/configuration');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        Configuration::destroy($id);

        
		$_SESSION["currentlink"] = 4; 
		return Redirect::to('/admin/configuration');
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
