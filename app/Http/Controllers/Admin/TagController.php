<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;
use DataTables;

class TagController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:admin');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Tag::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<button type="button" class="edit-tag-per-id btn btn-primary btn-sm" data-toggle="modal" data-target="#edit-tag" data-id="'.$row->id.'"><i class="fa fa-edit"></i></button>';
                           $btn = $btn.' <button type="button" class="hapus-tag-per-id btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus-tag" data-id="'.$row->id.'" data-nama="'.$row->nama.'"><i class="fa fa-trash-o"></i></button>';
     
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.tags.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tag_all = Tag::all();
        $tag = new Tag;

        foreach($tag_all as $t) {
            if($request->nama ==  $t->nama) {
                $response = [
                    'success' => false,
                    'message' => 'Data Tag tidak boleh ada yang sama!'
                ];
        
                return response()->json($response, 200);
            }
        }

        $tag->nama = $request->nama;
        $tag->save();

        $response = [
            'success' => true,
            'data'  => $tag,
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
        $data = Tag::findOrFail($id);

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
        $tag_all = Tag::all();
        $tag = Tag::findOrFail($id);

        foreach($tag_all as $t) {
            if($request->nama ==  $t->nama) {
                $response = [
                    'success' => false,
                    'message' => 'Data Tag tidak boleh ada yang sama!'
                ];
        
                return response()->json($response, 200);
            }
        }

        $tag->nama = $request->nama;
        $tag->save();

        $response = [
            'success' => true,
            'data'  => $tag,
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
        $tag = Tag::findOrFail($id)->delete();

        $response = [
            'success'   => true,
            'data'      => $tag,
            'message'   => 'Berhasil dihapus!'
        ];

        return response()->json($response, 200);
    }
}
