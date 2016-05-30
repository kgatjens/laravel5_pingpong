<?php

namespace HepC\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use DB;

use HepC\Http\Controllers\Controller;
use HepC\Models\Feeds;
use HepC\Models\FeedsComments;
use HepC\Models\FeedsLikes;
use HepC\Classes\OneSignalHelper;

class FeedsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // 1) get the feed
        $feed = Feeds::all();
        $feed = DB::table('feeds')->select('id', 'challenge_id')->get();

        return \Response::json($feed, 200);
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
        // 1) validation
        $validator = $this->validateCreateFeedParameter($request);

        try {
            if($validator->fails()){
                // fails
                return \Response::json(array(
                        'error'             => 'Bad Request ',
                        'error_description' => $validator->errors()->all())
                    , 400);
            }else{
                // save feed 
                $input = $request->all();
                $feed = Feeds::create($input);
                
                return \Response::json(json_decode($feed, true), 200);
            }
        }
        catch (Exception $e){
            return \Response::json(array('error'=>$e->getCode(), 'error_description' => $e->getMessage()), 500);
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

    /**
     * Add a comment to specific feed
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function add_comment(Request $request)
    {
        // 1) validate the fields
        $validator = $this->validateCreateFeedCommentParameter($request);

        try {
            if($validator->fails()){
                // 2.1) validation fails fails
                return \Response::json(array(
                        'error'             => 'Bad Request ',
                        'error_description' => $validator->errors()->all())
                    , 400);
            }else{
                // 2.2) save comment_x_feed
                try {
                    $input = $request->all();

                    // 3.1) get the feed
                    $the_feed = Feeds::findOrFail($input['feed_id']);

                    // 3.2) call the onesignal class
                    $push = OneSignalHelper::getInstance();
                    $push->createPushNotification('comment-feed', $the_feed);

                    // 3.3) if the ids are valid => save the relationship
                    $comment_x_feed = FeedsComments::create($input);
                    return \Response::json(json_decode($comment_x_feed, true), 200);
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
     * Add a like to specific feed
     *
     * @param  Request  $request
     * @return Response
     */
    public function like(Request $request)
    {
        // 1) validate the fields
        $validator = $this->validateCreateFeedLikeParameter($request);

        try {
            if($validator->fails()){
                // 2.1) validation fails 
                return \Response::json(array(
                        'error'             => 'Bad Request ',
                        'error_description' => $validator->errors()->all())
                    , 400);
            }else{
                // 2.2) save like_x_feed
                try {
                    $input = $request->all();

                    // 3) check if relationship already exist (the user already liked the feed)
                    $is_liked = FeedsLikes::where('feed_id', '=', $input['feed_id'])
                            //->where('anonymous_id', '=', $input['anonymous_id'])
                            ->first();

                    // 4) check if row exist
                    if( empty($is_liked) ){
                        // 4.1.1) if the ids are valid => save the relationship
                        $input = $request->all();

                        $like_x_feed = FeedsLikes::create($input);

                        // 4.1.2) get the feed
                        $the_feed = Feeds::findOrFail($input['feed_id']);

                        // 4.1.3) call the onesignal class
                        $push = OneSignalHelper::getInstance();
                        $push->createPushNotification('like-feed', $the_feed);

                        return \Response::json(json_decode($like_x_feed, true), 200);
                    }else{
                        // 4.2.1) dislike
                        FeedsLikes::where('feed_id', '=', $input['feed_id'])
                            //->where('anonymous_id', '=', $input['anonymous_id'])
                            ->delete();

                        return \Response::json(array('message' => 'You unliked the anonymous feed.'), 200);
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
     * Create the validator for a new device.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Validation\Validator $validator
     */
    public function validateCreateFeedParameter(Request $request){
        $validator = \Validator::make($request->isJson() ? $request->json()->all() : $request->all() , [
            'challenge_id'      => 'required|integer',
            'onesignal_id' => 'required'
        ]);
        return $validator;
    }

    /**
     * Create the validator for a new comment by challenge.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Validation\Validator $validator
     */
    public function validateCreateFeedCommentParameter(Request $request){
        $validator = \Validator::make($request->isJson() ? $request->json()->all() : $request->all() , [
            'feed_id' => 'required|integer',
            'comment_id' => 'required|integer',
            //'anonymous_id' => 'required',
            'onesignal_id' => 'required'
        ]);
        return $validator;
    }

    /**
     * Create the validator for a new like on a feed.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Validation\Validator $validator
     */
    public function validateCreateFeedLikeParameter(Request $request){
        $validator = \Validator::make($request->isJson() ? $request->json()->all() : $request->all() , [
            'feed_id' => 'required|integer',
            //'anonymous_id' => 'required',
            'onesignal_id' => 'required'
        ]);
        return $validator;
    }
}
