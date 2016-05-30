<?php

namespace HepC\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use HepC\Http\Requests;
use HepC\Http\Controllers\Controller;
use HepC\Models\Tips;
use HepC\Models\CategoriesTips;

class TipsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // 1) get the tips
        $tips = Tips::all();

        foreach ($tips as $key => $value) {
            $tips[$key]['media_path'] = !empty($value['media_path']) ? url().$value['media_path'] : '';
        }

        return \Response::json(json_decode($tips, true), 200);
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
        try{
            // 1) get the tip
            $tip = Tips::findOrFail($id);

            $tip['media_path'] = !empty($tip['media_path']) ? url().$tip['media_path'] : '';;

            // 2) load the categories
            $tip->load('categories_tips');

            $tip['categories_tips']['icon_path'] = url().$tip['categories_tips']['icon_path'];
            
            return \Response::json(json_decode($tip, true), 200);
        }
        catch (ModelNotFoundException $e){
            return \Response::json(array('error'=>$e->getCode(), 'error_description' => $e->getMessage()), 500);
        }
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
