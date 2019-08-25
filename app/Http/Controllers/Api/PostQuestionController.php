<?php

namespace App\Http\Controllers\Api;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PostQuestion;
use App\Tag;

class PostQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PostQuestion::with('user', 'category', 'tags')->latest()->get();

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
        $data = PostQuestion::with('user', 'category', 'tags')->findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();

        $response = [
            'success'   => true,
            'data'      => $data,
            'data_cat'  => $categories,
            'data_tag'  => $tags,
            'message'   => 'Data postingan '.$data->judul
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
        $update_post = PostQuestion::findOrFail($request->id);

        $update_post->status = $request->status_pq;
        $update_post->judul = $request->judul_pq;
        if($request->konten_pq==''):
            $update_post->konten = $update_post->konten;
        else:
            $update_post->konten = $request->konten_pq;
        endif;
        $update_post->category_id = $request->category_pq;
        $update_post->save();

        $update_post->tags()->sync($request->tags);


        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = PostQuestion::findOrFail($id)->delete();

        return ['message' => 'Postingan berhasil dihapus!'];
    }
}
