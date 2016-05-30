<?php

namespace HepC\Http\Controllers\Admin;

use Illuminate\Http\Request;

use HepC\Http\Controllers\Controller;
use HepC\Models\Comments;

class AdminCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // 1) get the challenges
        $comments = Comments::Ordered()->paginate(20);

        $no = $comments->firstItem();

        // 2) return de view
        return view('admin.comments.index')
            ->with('comments', $comments)
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
        return view('admin.comments.create');
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
        $validator = $this->validateCreateCommentParameter($request);

        // 3) validate
        if($validator->fails()){
            // 3.1) send error message
             return redirect()->route('admin.comments.create')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            // 3.2)create category
            $input = (object)$request->all();
            $input = (array) $input;
            $comments = Comments::create($input);
        }

        // 4) redirect to list
        return redirect()->route('admin.comments.edit', ['id' => $comments])->withMessage('Comment saved!');
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
        // 1) get the challenge
        $comments = Comments::findOrFail($id);

        // 2) return the edit view
        return view('admin.comments.edit')
            ->with('comment', $comments);
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
        // 1) get the comments
        $comments = Comments::findOrFail($id);

        // 2) validation rules
        $validator = $this->validateCreateCommentParameter($request);

        // 3) validate
        if($validator->fails()){
            // 3.1) send error message
             return redirect()->route('admin.comments.edit', ['id' => $comments])
                        ->withErrors($validator)
                        ->withInput();
        }else{
            // 3.2)create comments
            $input = (object)$request->all();
            $input = (array) $input;
            $comments->update($input);
        }

        return redirect()->route('admin.comments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // 1) get the comments
        $comments = Comments::findOrFail($id);

        // 2) delete it
        $comments->delete();

        // 3) return to the index view
        return redirect()->route('admin.comments.index');
    }

    /**
     * Create the validator for a new comments.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Validation\Validator $validator
     */
    public function validateCreateCommentParameter(Request $request){
        $validator = \Validator::make($request->isJson() ? $request->json()->all() : $request->all() , [
            'name' => 'required|string',
            'order' => 'required|integer',
        ]);
        return $validator;
    }
}
