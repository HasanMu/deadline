<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PostQuestion;
use DataTables;
use File;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class PostQuestionController extends Controller
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
            $data = PostQuestion::with('user', 'category', 'tags')->latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<button type="button" class="edit-post-question-per-id btn btn-primary btn-sm" data-toggle="modal" data-target="#edit-post-question" data-id="'.$row->id.'"><i class="fa fa-edit"></i></button>';
                           $btn = $btn.' <button type="button" class="hapus-post-question-per-id btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus-post-question" data-id="'.$row->id.'" data-judul="'.$row->judul.'"><i class="fa fa-trash-o"></i></button>';

                            return $btn;
                    })
                    ->addColumn('img', function($row){

                            $img = '<img src="/assets/questions/img/'.$row->foto.'" class="margin" widht="100px" height="100px">';

                            return $img;
                    })
                    ->addColumn('tags', function(PostQuestion $pq) {
                        return $pq->tags->pluck('nama')->implode('<br>');
                    })
                    ->rawColumns(['action', 'tags', 'img'])
                    ->make(true);
        }

        return view('admin.postquestions.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pq = new PostQuestion;

        $pq->judul = $request->judul;
        $pq->slug = str_slug($request->judul);
        $pq->konten = $request->konten;
        $pq->user_id = $request->user_id;
        $pq->category_id = $request->category_id;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $destinationPatch = public_path().'/assets/questions/img/';
            $filename = str_random(6).'_'.$file->getClientOriginalName();
            $uploadSuccess = $file->move($destinationPatch, $filename);
            $pq->foto = $filename;
        }

        $pq->save();
        $pq->tags()->attach($request->tag_id);

        $response = [
            'success'   => true,
            'data'      => $pq,
            'message'   => 'Berhasil ditambah!'
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
        $pq = PostQuestion::findOrFail($id);

        $response = [
            'success'   => true,
            'data'      => $pq,
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pq = PostQuestion::findOrFail($id);

        if($pq->foto){
            $old_foto = $pq->foto;
            $filepath = public_path().'/assets/questions/img/'.$pq->foto;
            try {
                File::delete($filepath);
            } catch (FileNotFoundException $e) {
                //Exception $e;
            }
        }

        $pq->tags()->detach($pq);
        $pq->delete();

        $response = [
            'success'   => true,
            'data'      => $pq,
            'message'   => 'Berhasil dihapus!'
        ];

        return response()->json($response, 200);
    }
}
