<?php

namespace HepC\Http\Controllers\Api\v1;

use Illuminate\Http\Request;

use HepC\Http\Requests;
use HepC\Http\Controllers\Controller;
use HepC\Models\CategoriesTips;
use HepC\Models\Tips;

class CategoriesTipsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // 1) get the categories
        $categories = CategoriesTips::all();

        foreach ($categories as $key => $value) {
            $categories[$key]['icon_path'] = !empty($value['icon_path']) ? url().$value['icon_path'] : '';
        }
        
        return \Response::json(json_decode($categories, true), 200);
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
     * Display all the tips by any specific category.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    { 

        try{
            // 1) get the tips by a specific category
            $tipsByCategory = Tips::where('categories_id', '=', $id)->get();

            $categories = CategoriesTips::all()->keyBy('id');

            //2) Add the category name to the array
            foreach ($tipsByCategory->toArray() as $key => $value) {
                $tipsByCategory[$key]['category_name']  = $categories[$value['categories_id']]['title'];
                $tipsByCategory[$key]['media_path'] = !empty($value['media_path']) ? url().$value['media_path'] : '';
            }

            return \Response::json(json_decode($tipsByCategory, true), 200);
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
