<?php

class InstitutionController extends \BaseController {

    private $icon = 'institution';

    public function __construct()
    {
        $this->beforeFilter('auth');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $institutions = Institution::all();
		session_start();
		$_SESSION["currentlink"] = 4;
        return View::make('admin.institution.index', ['institutions' => $institutions, 'icon' => $this->icon]);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

        return View::make('admin.institution.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $institution = new Institution();

       // $institution->name = Input::get('name'); 
	   // $institution->abbreviation = Input::get('abbreviation');
		$institution->name = $_POST["name"];
        $institution->abbreviation = $_POST["abbreviation"];
        $institution->save();

        $institution->updateDocumentCount();
		session_start();
		$_SESSION["currentlink"] = 4;
		log::info('institution saved');
		return Redirect::to('/admin');
      //  return Redirect::to('/admin/institution');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $institution = Institution::find($id);
		session_start();
		$_SESSION["currentlink"] = 4;
        return View::make('admin.institution.edit', [ 'institution' => $institution ]);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $institution = Institution::find($id);

        $institution->name = Input::get('name');
        $institution->abbreviation = Input::get('abbreviation');
        $institution->save();

        $institution->updateDocumentCount();
		
		session_start();
		$_SESSION["currentlink"] = 4;
        return Redirect::to('/admin/institution');
	}
	
	public function updateInstitute($id)
	{
		$institution = Institution::find($id);
		log::info($id);
        $institution->name = $_GET["name"];
		$institution->abbreviation = $_GET["abbreviation"];
		log::info($_GET["name"]);
        $institution->save();
		
		//$institutions = Institution::all();
		$institutions = Institution::whereNotIn('name', ['Treaty Collection', 'Commentary Collection'])->get();
		session_start();
		log::info('institution updated');
		$_SESSION["currentlink"] = 4;
        return View::make('admin.index', ['institutions' => $institutions, 'icon' => $this->icon]);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        
		Institution::destroy($id);
		session_start();
		$_SESSION["currentlink"] = 4;
       // return Redirect::to('/admin/institution');
	}


}
