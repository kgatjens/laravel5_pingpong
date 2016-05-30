<?php

namespace HepC\Http\Controllers\Admin;

use Illuminate\Http\Request;

use HepC\Http\Controllers\Controller;
use HepC\Models\PushNotificationType;

class AdminPushTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // 1) get the pust type
        $push_type = PushNotificationType::latest()->paginate(20);

        $no = $push_type->firstItem();

        // 2) return de view
        return view('admin.push_type.index')
            ->with('push_type', $push_type)
            ->with('no', $no);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // 1) return the create view
        return view('admin.push_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // 2 add slug
        $input = $request->all();
        $input['slug'] = str_slug( $input['name'] );

        // 2) validation rules
        $validator = $this->validateCreatePushTypeParameter($input);


        // 3) validate
        if($validator->fails()){
            // 3.1) send error message
             return redirect()->route('admin.push_type.create')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            // 3.2)create push_type
            $input = (array) $input;
            $push_type = PushNotificationType::create($input);
        }

        // 4) redirect to list
        return redirect()->route('admin.push_type.edit', ['id' => $push_type])->withMessage('Push Type saved!');
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
        // 1) get the push_type
        $push_type = PushNotificationType::findOrFail($id);

        // 2) return the edit view
        return view('admin.push_type.edit')
            ->with('push_type', $push_type);
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
        // 1) get the push_type
        $push_type = PushNotificationType::findOrFail($id);

        // 2) validation rules
        $input = $request->all();
        $input['slug'] = str_slug( $input['slug'] );
        $validator = $this->validateCreatePushTypeParameter($input, $push_type);

        // 3) validate
        if($validator->fails()){
            // 3.1) send error message
             return redirect()->route('admin.push_type.edit', ['id' => $push_type])
                        ->withErrors($validator)
                        ->withInput();
        }else{
            // 3.2)create push_type
            $input = (array) $input;
            $push_type->update($input);
        }

        return redirect()->route('admin.push_type.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // 1) get the push_type
        $push_type = PushNotificationType::findOrFail($id);

        // 2) delete it
        $push_type->delete();

        // 3) return to the index view
        return redirect()->route('admin.push_type.index');
    }

    /**
     * Create the validator for a new comments.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Validation\Validator $validator
     */
    public function validateCreatePushTypeParameter(Array $request, PushNotificationType $type = null){
        if(isset($type)){
            // update 
            $validator = \Validator::make($request, [
                'name' => 'required|string',
                'title' => 'required|string',
                'description' => 'required|string',
                'slug' => 'required|string|unique:push_notification_types,slug,'.$type->id,
            ]);
        }else{
            // on create
            $validator = \Validator::make($request, [
                'name' => 'required|string',
                'title' => 'required|string',
                'description' => 'required|string',
                'slug' => 'required|string|unique:push_notification_types'
            ]);
        }
        return $validator;
    }
}
