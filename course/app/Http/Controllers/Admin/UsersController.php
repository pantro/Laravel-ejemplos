<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\User;

//use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
//use Request;

use Illuminate\Routing\Redirector;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller {

	public function __construct(){
		
		$this -> middleware('auth');
		$this -> beforeFilter('@findUser', ['only' => ['show', 'edit','update','destroy']]);
	}

	public function findUser(Route $route){
		$this -> user = User::findOrFail($route->getParameter('users'));//Si no hay usuario manda un error 404
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{

		$users = User::filterAndPaginate($request->get('name'),$request->get('type'));

		return view('admin.users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateUserRequest $request)
	{
		
		$user = User::create($request -> all());

		//return $redirect -> route('admin.users.index');
		//return \Redirect::route('admin.users.index');
		return redirect() -> route('admin.users.index');
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
		return view('admin.users.edit')->with('user',$this->user);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(EditUserRequest $request, $id)
	{
		$this->user -> fill($request->all());
		$this->user -> save();

		return redirect() -> back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id, Request $request)
	{
		
		$this->user -> delete();

		$message = $this->user->full_name.' fue eliminado de nuestros registros';

		if ($request -> ajax()) {
			return response()->json([
					'id'     => $this->user->id,
					'message'=> $message
				]);
		}

		Session::flash('message', $message);

		return redirect()->route('admin.users.index');
	}

}
