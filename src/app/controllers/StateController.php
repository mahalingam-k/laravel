<?php

class StateController extends \BaseController {


    private $icon = 'map-marker';

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
        $states = State::all();
		session_start();
		$_SESSION['currentlink']  = 4;
        return View::make('admin.state.index', ['states' => $states, 'icon' => $this->icon]);
    }


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        session_start();
		$_SESSION['currentlink']  = 4;
		return View::make('admin.state.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        
		log::info('Inside store method of state controller');
		$state = new State();
		$state->name = $_POST["stval"];
      //  $state->name = Input::get('name');
        $state->save();
		session_start();
		$_SESSION['currentlink']  = 4;
        return Redirect::to('/admin/state');
	}



	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$state = State::find($id);
		session_start();
		$_SESSION['currentlink']  = 4;
        return View::make('admin.state.edit', [ 'state' => $state ]);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $state = State::find($id);
		log::info($id);
        $state->name = $_GET["tbval"];
		
		log::info($_GET["tbval"]);
        $state->save();
        session_start();
		$_SESSION['currentlink']  = 4;
		return Redirect::to('/admin/state');
	}
	
	public function updateState($id)
	{
		$state = State::find($id);
		log::info($id);
        $state->name = $_GET["tbval"];
		
		log::info($_GET["tbval"]);
        $state->save();
		
		$states = State::all();
        session_start();
		$_SESSION['currentlink']  = 4;
		return View::make('admin.state.index', ['states' => $states, 'icon' => $this->icon]);
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        log::info('inside destroy method');
		log::info($id);
		State::destroy($id);
		session_start();
		$_SESSION['currentlink']  = 4;
        //return Redirect::to('/admin/state');
	}


}
