<?php

namespace HepC\Http\Controllers\Admin;

use Illuminate\Http\Request;

use HepC\Http\Controllers\Controller;
use HepC\Models\Challenges;
use DB;

class AdminChallengesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // 1) get the challenges
        $challenges = Challenges::latest()->paginate(20);

        $no = $challenges->firstItem();

        // 2) return de view
        return view('admin.challenges.index')
            ->with('challenges', $challenges)
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
        return view('admin.challenges.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // 1) get challenge's total
        $total = DB::table('challenges')->count();
        
        // 2) check for max_challenges
        if ( $total < config('admin.max_challenges') ){
            // 3) validation rules
            $validator = $this->validateCreateChallengeParameter($request);

            // 4) validate
            if($validator->fails()){
                // 4.1) send error message
                 return redirect()->route('admin.challenges.create')
                            ->withErrors($validator)
                            ->withInput();
            }else{
                // 4.2)create category
                $input = (object)$request->all();
                $input = (array) $input;
                $challenges = Challenges::create($input);
            }

            // 5) redirect to list
            return redirect()->route('admin.challenges.edit', ['id' => $challenges])->withMessage('challenge saved!');
        }else{
            // 6) user can add more challenges
            return redirect()->route('admin.challenges.create')
                            ->withErrors( array( "You can't add more challenges.", "You only can add " . config('admin.max_challenges') . " challenges." ) )
                            ->withInput();
        }

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
        $challenge = Challenges::findOrFail($id);

        // 2) return the edit view
        return view('admin.challenges.edit')
            ->with('challenge', $challenge);
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
        // 1) get the challenge
        $challenge = Challenges::findOrFail($id);

        // 2) validation rules
        $validator = $this->validateCreateChallengeParameter($request);

        // 3) validate
        if($validator->fails()){
            // 3.1) send error message
             return redirect()->route('admin.challenges.edit', ['id' => $challenge])
                        ->withErrors($validator)
                        ->withInput();
        }else{
            // 3.2)create challenge
            $input = (object)$request->all();
            $input = (array) $input;
            $challenge->update($input);
        }

        return redirect()->route('admin.challenges.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // 1) get the challenge
        $challenge = Challenges::findOrFail($id);

        // 2) delete it
        $challenge->delete();

        // 3) return to the index view
        return redirect()->route('admin.challenges.index');
    }

    /**
     * Create the validator for a new challenge.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Validation\Validator $validator
     */
    public function validateCreateChallengeParameter(Request $request){
        $validator = \Validator::make($request->isJson() ? $request->json()->all() : $request->all() , [
            'title' => 'required|string',
            'description'   => 'required|string',
        ]);
        return $validator;
    }
}
