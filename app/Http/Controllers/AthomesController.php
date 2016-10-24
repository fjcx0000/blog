<?php

namespace App\Http\Controllers;

use App\Athome;
use Dotenv\Validator;
use Illuminate\Support\Facades\Redirect;
use Response;
use Request;

use App\Http\Requests;

class AthomesController extends Controller
{
    public $restful = true;
    protected $athome;

    public function __construct(Athome $athome)
    {
        $this->athome = $athome;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return Response::json(Athome::all());
    }

    /**
     * show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('athome.create');
    }

    /**
     * Store a new resource in storage.
     * @return Response
     */
    public function store()
    {
        $rules = array(
            'led1' => 'required',
            'sensors1' => 'required|numeric|Min:-50|Max:80',
            'sensors2' => 'required|numeric|Min:-50|Max:80',
            'temperature' => 'required|numeric|Min:-50|Max:80',
        );

        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('athome/create')
                        ->withErrors($validator)
                        ->withInput(Request::except('password'));
        } else {
            //store
            $athome = new Athome();
            $athome->sensor1 = Requst::input('sensor1');
            $athome->sensor2 = Requst::input('sensor2');
            $athome->temperature = Request::input('temperature');
            $athome->ld1 = Request::input('led1');
            $athome->save();
        }
    }
    }

    /**
     * Display the specified resource.
     * @return Response
     */
    public function show($id)
    {
        //
        $athome = Athome::find($id);
        return Response::json($athome);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $athome = Athome::find($id);

        return view('athome.edit')->with('athome', $athome);
    }

    /**
     * Update the specified resource in storage
     */
    public function update($id)
    {
        $rules = array(
            'led1' => 'required',
            'sensors1' => 'required|numeric|Min:-50|Max:80',
            'sensors2' => 'required|numeric|Min:-50|Max:80',
            'temperature' => 'required|numeric|Min:-50|Max:80',
        );

        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('athome/edit')
                ->withErrors($validator)
                ->withInput(Request::except('password'));
        } else {
            //store
            $athome = Athome::find($id);
            $athome->sensor1 = Requst::input('sensor1');
            $athome->sensor2 = Requst::input('sensor2');
            $athome->temperature = Request::input('temperature');
            $athome->ld1 = Request::input('led1');
            $athome->save();

            //redirect
            Session::flash('message', 'Successful updated athome!');
            return Redirect::to('athome');
        }
    }

    /**
     * Remove the specified resource in storate.
     */
    public function destroy($id)
    {
        $athome = Athome::find($id);
        if (is_null($athome)) {
            return Response::json('Todo not found', 404);
        }
        $athome->delete();
        //Redirect
        Session::flash('message', 'Successful deleted Athome!');
        return Redirect::to('athome');
    }
}
