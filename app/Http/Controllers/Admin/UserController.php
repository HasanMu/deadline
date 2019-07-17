<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<button type="button" class="edit-user-per-id btn btn-primary btn-sm" data-toggle="modal" data-target="#edit-user" data-id="'.$row->id.'"><i class="fa fa-edit"></i></button>';
                           $btn = $btn.' <button type="button" class="hapus-user-per-id btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus-user" data-id="'.$row->id.'" data-nama="'.$row->name.'"><i class="fa fa-trash-o"></i></button>';
     
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.users.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->dob = $request->dob;
        $user->gender = $request->gender;
        $user->password = bcrypt($request->password);
        $user->save();

        $response = [
            'success'   => true,
            'data'      => $user,
            'message'   => 'Berhasil ditampilkan!'
        ];

        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        $response = [
            'success'   => true,
            'data'      => $user,
            'message'   => 'Berhasil diitampilkan!'
        ];

        return response()->json($response, 200);
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

        $user->name = $request->name;
        $user->email = $request->email;
        $user->dob = $request->dob;
        $user->gender = $request->gender;
        if(!$request->password) {
            $user->password = bcrypt($request->password);
        } else {
            $user->password = $user->password;
        }
        $user->save();

        $response = [
            'success'   => true,
            'data'      => $user,
            'message'   => 'Berhasil diubah!'
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
        $user = User::findOrFail($id)->delete();

        $response = [
            'success'   => true,
            'data'      => $user,
            'message'   => 'Berhasil dihapus!'
        ];

        return response()->json($response, 200);
    }
}
