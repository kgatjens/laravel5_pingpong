<?php

namespace HepC\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use DB;

use HepC\Http\Requests;
use HepC\Http\Controllers\Controller;
use HepC\Models\Challenges;
use HepC\Models\ChallengesComments;
use HepC\Models\ChallengesLikes;

class ChallengesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // 1) get the challenges
        $challenges = DB::table('challenges')->select('id', 'title', 'description')->get();

        return \Response::json($challenges, 200);
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
            $comments = array();
            $obj = array();

            // 1) get the Challenges
            $challenge = Challenges::findOrFail($id);

            // 2) load the comments
            $comments['total'] = count($challenge->comments);
            foreach ($challenge->comments as $comment) {
                $comments['type'][$comment->name] = isset($comments['type'][$comment->name]) ? $comments['type'][$comment->name] + 1 : 1;

            }

            // 3) construct the return object
            $obj['id'] = $challenge->id;
            $obj['title'] = $challenge->title;
            $obj['description'] = $challenge->description;
            $obj['comments'] = $comments;

            return \Response::json( $obj, 200 );
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

    /**
     * Add a comment to specific challenge
     *
     * @param  Request  $request
     * @return Response
     */
    public function add_comment(Request $request)
    {
        // 1) validate the fields
        $validator = $this->validateCreateChallengeCommentParameter($request);

        try {
            if($validator->fails()){
                // 2.1) validation fails fails
                return \Response::json(array(
                        'error'             => 'Bad Request ',
                        'error_description' => $validator->errors()->all())
                    , 400);
            }else{
                // 2.2) save comment_x_challenge
                try {
                    // 3) if the ids are valid => save the relationship
                    $input = $request->all();
                    $comment_x_challenge = ChallengesComments::create($input);
                    return \Response::json(json_decode($comment_x_challenge, true), 200);
                }
                catch(QueryException $e){
                    return \Response::json(array('error'=>$e->getCode(), 'error_description' => $e->getMessage()), 500);
                }
            }
        }
        catch (Exception $e){
            return \Response::json(array('error'=>$e->getCode(), 'error_description' => $e->getMessage()), 500);
        }
    }

    /**
     * Add a like to specific challenge
     *
     * @param  Request  $request
     * @return Response
     */
    public function like(Request $request)
    {
        // 1) validate the fields
        $validator = $this->validateCreateChallengeLikeParameter($request);

        try {
            if($validator->fails()){
                // 2.1) validation fails 
                return \Response::json(array(
                        'error'             => 'Bad Request ',
                        'error_description' => $validator->errors()->all())
                    , 400);
            }else{
                // 2.2) save like_x_challenge
                try {
                    $input = $request->all();

                    // 3) check if relationship already exist (the user already liked the challege)
                    $is_liked = ChallengesLikes::where('challenge_id', '=', $input['challenge_id'])
                            //->where('anonymous_id', '=', $input['anonymous_id'])
                            ->first();

                    // check if row exist
                    if( empty($is_liked) ){
                        // 4.1) if the ids are valid => save the relationship
                        $input = $request->all();

                        $like_x_challenge = ChallengesLikes::create($input);

                        return \Response::json(json_decode($like_x_challenge, true), 200);
                    }else{
                        // 4.2) dislike
                        ChallengesLikes::where('challenge_id', '=', $input['challenge_id'])
                            //->where('anonymous_id', '=', $input['anonymous_id'])
                            ->delete();

                        return \Response::json(array('message' => 'You unliked the challenge.'), 200);
                    }
                }
                catch(QueryException $e){
                    return \Response::json(array('error'=>$e->getCode(), 'error_description' => $e->getMessage()), 500);
                }
            }
        }
        catch (Exception $e){
            return \Response::json(array('error'=>$e->getCode(), 'error_description' => $e->getMessage()), 500);
        }
    }

    /**
     * Create the validator for a new comment by challenge.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Validation\Validator $validator
     */
    public function validateCreateChallengeCommentParameter(Request $request){
        $validator = \Validator::make($request->isJson() ? $request->json()->all() : $request->all() , [
            'challenge_id' => 'required|integer',
            'comment_id' => 'required|integer',
            //'anonymous_id' => 'required',
            'onesignal_id' => 'required'
        ]);
        return $validator;
    }

    /**
     * Create the validator for a new like on a challenge.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Validation\Validator $validator
     */
    public function validateCreateChallengeLikeParameter(Request $request){
        $validator = \Validator::make($request->isJson() ? $request->json()->all() : $request->all() , [
            'challenge_id' => 'required|integer',
            //'anonymous_id' => 'required',
            'onesignal_id' => 'required'
        ]);
        return $validator;
    }
}
