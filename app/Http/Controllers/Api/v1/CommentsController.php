<?php

namespace HepC\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use DB;

use HepC\Http\Controllers\Controller;
use HepC\Models\Comments;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // 1) get the Comments
        $comments = Comments::all();
        $comments = DB::table('comments')->select('id', 'name')->get();

        return \Response::json($comments, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return \Response::json('Not Implemented', 501);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        return \Response::json('Not Implemented', 501);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return \Response::json('Not Implemented', 501);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return \Response::json('Not Implemented', 501);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        return \Response::json('Not Implemented', 501);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        return \Response::json('Not Implemented', 501);
    }
}
