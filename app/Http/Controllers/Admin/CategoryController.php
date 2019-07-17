<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<button type="button" class="edit-kategori-per-id btn btn-primary btn-sm" data-toggle="modal" data-target="#edit-kategori" data-id="'.$row->id.'"><i class="fa fa-edit"></i></button>';
                           $btn = $btn.' <button type="button" class="hapus-kategori-per-id btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus-kategori" data-id="'.$row->id.'" data-nama="'.$row->nama.'"><i class="fa fa-trash-o"></i></button>';
     
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.categories.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $catt = Category::all();
        $cat = new Category;

        foreach($catt as $c) {
            if($request->nama ==  $c->nama) {
                $response = [
                    'success' => false,
                    'message' => 'Data Kategori tidak boleh ada yang sama!'
                ];
        
                return response()->json($response, 200);
            }
        }
        
        $cat->nama = $request->nama;
        $cat->save();

        $response = [
            'success' => true,
            'data'  => $cat,
            'message' => 'Berhasil disimpan!'
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
        $data = Category::findOrFail($id);

        $response = [
            'success'   => true,
            'data'      => $data,
            'message'   => 'Berhasil ditampilkan!'
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
        $cat = Category::findOrFail($id);

        $cat->nama = $request->nama;
        $cat->save();

        $response = [
            'success' => true,
            'data'  => $cat,
            'message' => 'Berhasil diubah!'
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
        $cat = Category::findOrFail($id)->delete();

        $response = [
            'success'   => true,
            'data'      => $cat,
            'message'   => 'Berhasil dihapus!'
        ];

        return response()->json($response, 200);
    }
}
