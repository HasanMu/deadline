<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::latest()->get();

        $response = [
            'success'   => true,
            'data'      => $user,
            'message'   => 'Data users berhasil ditampilkan'
        ];

        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->email;
        $user->address = $request->address;
        $user->bio = $request->bio;
        $user->dob = $request->dob;
        $user->save();

        $response = [
            'success'   => true,
            'data'      => $user,
            'message'   => 'Data berhasil di update'
        ];

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function isLogged(){
        $isLogged = Auth::check();
        $user = true;

        if(!$isLogged){
            $user = [
                'id'  => Auth::user()
            ];
        }

        $response = [
            'stats' => $isLogged,
            'user'  => $user
        ];

        return response()->json($response, 200);
    }
}
