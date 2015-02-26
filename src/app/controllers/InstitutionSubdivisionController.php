<?php

class InstitutionSubdivisionController extends \BaseController {

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
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
     * @param  int  $institutionId
	 * @return Response
	 */
	public function create()
	{
        $institutions = Institution::lists('name', 'id');
        $selectedInstitution = Input::get('institution');

        return View::make('admin.institution-subdivision.create', ['institutions' => $institutions, 'selected' => $selectedInstitution]);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $subdivision = new InstitutionSubdivision();

       /* $subdivision->name = Input::get('name');
        $subdivision->abbreviation = Input::get('abbreviation');
        $subdivision->institution_id = Input::get('institution_id'); */
		
		$subdivision->name = $_POST["name"];
        $subdivision->abbreviation = $_POST["abbreviation"];
        $subdivision->institution_id = $_POST["instituteid"];
		
        $subdivision->save();

       // return Redirect::to('/admin/institution');
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
        $subdivision = InstitutionSubdivision::find($id);

        $institutions = Institution::lists('name', 'id');

        return View::make('admin.institution-subdivision.edit', [ 'subdivision' => $subdivision, 'institutions' => $institutions ]);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $subdivision = InstitutionSubdivision::find($id);

        $subdivision->name = Input::get('name');
        $subdivision->abbreviation = Input::get('abbreviation');
        $subdivision->institution_id = Input::get('institution_id');
        $subdivision->save();

        return Redirect::to('/admin/institution');
	}

	public function updateSubInstitution($id)
	{
		
		$subdivision = InstitutionSubdivision::find($id);

        $subdivision->name = $_GET["name"];
        $subdivision->abbreviation = $_GET["abbreviation"];
        $subdivision->institution_id = $_GET["institution_id"];
        $subdivision->save();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		log::info('inside destroy method of subdivision');
		log::info($id);
		InstitutionSubdivision::destroy($id);
	}


}
