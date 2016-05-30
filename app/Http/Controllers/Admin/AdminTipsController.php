<?php

namespace HepC\Http\Controllers\Admin;

use Illuminate\Http\Request;

use HepC\Http\Controllers\Controller;
use HepC\Models\Tips;
use HepC\Models\CategoriesTips;

class AdminTipsController extends Controller
{
    // Access type:
    const GATED = 1;
    const OPEN = 2;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // 1) get the tips
        $tips = Tips::latest()->paginate(20);

        $no = $tips->firstItem();

        // 2) return de view
        return view('admin.tips.index')
            ->with('tips', $tips)
            ->with('no', $no);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // 1) get the categories
        $categories = CategoriesTips::all();

        // 2) return the create view
        return view('admin.tips.create')
            ->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // 1) validation rules
        $validator = $this->validateCreateTipsParameter($request);

        // 2) get the validation rules
        $input = (object)$request->all();
        
        // validate
        if($validator->fails()){
            // 3.1) send error message
             return redirect()->route('admin.tips.create')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            // 3.2)create category
            $input = (array) $input;
            $tips = Tips::create($input);
        }

        // 4) redirect to list
        return redirect()->route('admin.tips.edit', ['id' => $tips])->withMessage('Tip saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        // 1) get the tip
        $tip = Tips::findOrFail($id);

        // 2) get the categories
        $categories = CategoriesTips::all();

        // 3) get the selected category
        $myCategory = (array) $tip->categories_id;

        // 4) return the edit view
        return view('admin.tips.edit')
            ->with('tip', $tip)
            ->with('categories', $categories)
            ->with('myCategory', $myCategory);
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
        // 1) get the tip
        $tip = Tips::findOrFail($id);

        // 2) validation rules
        $validator = $this->validateCreateTipsParameter($request);

        // 3) get the validation rules
        $input = (object)$request->all();
        
        // 4) validate
        if($validator->fails()){
            // 4.1) send error message
             return redirect()->route('admin.tips.edit', ['id' => $tip])
                        ->withErrors($validator)
                        ->withInput();
        }else{
            // 4.2)create category
            $input = (array) $input;
            $tip->update($input);
        }

        return redirect()->route('admin.tips.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // 1) get the tips
        $tip = Tips::findOrFail($id);

        // 2) delete it
        $tip->delete();

        // 3) return to the index view
        return redirect()->route('admin.tips.index');
    }

    /**
     * Create the validator for a new tips.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Validation\Validator $validator
     */
    public function validateCreateTipsParameter(Request $request){
        $validator = \Validator::make($request->isJson() ? $request->json()->all() : $request->all() , [
            'title'         => 'required|string',
            // 'subtitle'      => 'required|string',
            'description'   => 'required|string',
            // 'access'        => 'required|integer',
            'link'          => 'url',
            'categories_id' => 'required|integer',
            'url'           => 'url',   
        ]);
        return $validator;
    }

    /**
     * Upload an image to the tip.
     *
     * @param  Request  $request
     * @return json
     */
    public function uploadImage(Request $request)
    {
        $coversFolder = '/public/images/tips/';
        $publicPath = '/images/tips/';
        
        try {
            $file = $request->file('coverImageTipDropzone');
            $name = 'tip_' . str_random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(base_path() . $coversFolder, $name);

            if( $request->input('media_path' ) != ''){
                // Delete previous File
                \File::delete( base_path() . $coversFolder . basename($request->input('media_path' ) ) );
            }
            if( !empty( $request->input('id') ) ){
                $catID = $request->input('id');
                $cat = Tips::find($catID);
                $previousImage = $cat->media_path;
                $cat->media_path = $publicPath . $name;
                $cat->save();
                
                // Delete previous File
                if (isset($previousImage)) {
                    \File::delete(base_path() . $coversFolder . basename($request->input('media_path' ) ));
                }
            }

            return json_encode(array('success' => true, 'image' => '/images/tips/' . $name ), 200);
        } catch (FileException $e) {
            throw new CustomException($e->getMessage());
        }

    }
}
