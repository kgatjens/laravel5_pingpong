<?php

namespace HepC\Http\Controllers\Admin;

use Illuminate\Http\Request;

use HepC\Http\Controllers\Controller;
use HepC\Models\CategoriesTips;

class AdminCategoriesTipsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // 1) get the categories
        $categories = CategoriesTips::latest()->paginate(20);

        $no = $categories->firstItem();

        // 2) return de view
        return view('admin.categoriestips.index')
            ->with('categories', $categories)
            ->with('no', $no);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // return the create view
        return view('admin.categoriestips.create');
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
        $validator = $this->validateCreateCategoriesParameter($request);

        // 2) get the validation rules
        $input = (object)$request->all();
        
        // validate
        if($validator->fails()){
            // 3.1) send error message
             return redirect()->route('admin.categoriestips.create')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            // 3.2)create category
            $input = (array) $input;
            $category = CategoriesTips::create($input);
        }

        // 4) redirect to list
        return redirect()->route('admin.categoriestips.edit', ['id' => $category])->withMessage('Category saved!');
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
        // 1) get the category
        $category = CategoriesTips::findOrFail($id);

        // 2) return the edit view
        return view('admin.categoriestips.edit')
            ->with('category', $category);
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
        // 1) get the category
        $category = CategoriesTips::findOrFail($id);

        // 2) validation rules
        $validator = $this->validateCreateCategoriesParameter($request);

        // 3) validate
        if($validator->fails()){
            // 3.1) send error message
             return redirect()->route('admin.categoriestips.edit', ['id' => $category])
                        ->withErrors($validator)
                        ->withInput();
        }else{
            // 3.2)create category
            $input = (object)$request->all();
            $input = (array) $input;
            $category->update($input);
        }

        return redirect()->route('admin.categoriestips.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // 1) get the category
        $category = CategoriesTips::findOrFail($id);

        // 2) delete it
        $category->delete();

        // 3) return to the index view
        return redirect()->route('admin.categoriestips.index');
    }

    /**
     * Create the validator for a new challenge.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Validation\Validator $validator
     */
    public function validateCreateCategoriesParameter(Request $request){
        $validator = \Validator::make($request->isJson() ? $request->json()->all() : $request->all() , [
            'title'         => 'required|string',
            'icon_path'    => 'required',
        ]);
        return $validator;
    }

    /**
     * Upload an image to the category.
     *
     * @param  Request  $request
     * @return json
     */
    public function uploadImage(Request $request)
    {
        $coversFolder = '/public/images/tips/category/';
        $publicPath = '/images/tips/category/';

        // var_dump(  basename($request->input('icon_path' ) )  );die;
        
        try {
            $file = $request->file('coverImageDropzone');
            $name = 'icon_' . str_random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(base_path() . $coversFolder, $name);

            if( $request->input('icon_path' ) != ''){
                // Delete previous File
                \File::delete( base_path() . $coversFolder . basename($request->input('icon_path' ) ) );
            }
            if( !empty( $request->input('id') ) ){
                $catID = $request->input('id');
                $cat = CategoriesTips::find($catID);
                $previousImage = $cat->icon_path;
                $cat->icon_path = $publicPath . $name;
                $cat->save();
                
                // Delete previous File
                if (isset($previousImage)) {
                    \File::delete(base_path() . $coversFolder . basename($request->input('icon_path' ) ));
                }
            }

            return json_encode(array('success' => true, 'image' => '/images/tips/category/' . $name ), 200);
        } catch (FileException $e) {
            throw new CustomException($e->getMessage());
        }

    }
}
