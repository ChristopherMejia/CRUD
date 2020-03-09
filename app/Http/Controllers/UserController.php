<?php

namespace App\Http\Controllers;

use App\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // public function webservice(Request $request)
    // {
        
    //     $client   = $request['input'];
    //     $password = $request['pass']; 
    // }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard',
        [
            'users' => Client::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request -> validate ([
            'nombre' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'uid'  => ['required', 'string', 'unique:users'],
        ]);


        $client = new Client();
        $client->name = $validator['nombre'];
        $client->email = $validator['email'];
        $client->uid = $validator['uid'];
        $client->save();
        return redirect('/home/create')->with('success','Added User');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        
        $validate = $request->validate([ 
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]); 

        
        $client = Client::where('uid','=',$request['uidKey'])->update($validate);
        return redirect('/home/usuarios');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //dd($request->all());
        
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //dd($request->all());
        $client = Client::where('uid','=',$request['uidKey'])->delete();

        return redirect('/home/usuarios')->with('delete','Usuario Eliminado');
    }

    public function confirmDelete()
    {
        return view('user.confirmDelete',
        [
            'users' => Client::all()
        ]);
    }   


}
