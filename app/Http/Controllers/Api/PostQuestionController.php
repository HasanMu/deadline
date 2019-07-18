<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PostQuestion;

class PostQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PostQuestion::with('user')->latest()->get();

        $response = [
            'success'   => true,
            'data'      => $data,
            'message'   => 'Data pertanyaan berhasil ditampilkan'
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
        //
    }
}
