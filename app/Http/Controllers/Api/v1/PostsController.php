<?php

namespace HepC\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use HepC\Http\Controllers\Controller;

use HepC\Models\Posts;
use HepC\Models\PostsComments;
use HepC\Models\Comments;
use HepC\Models\PostsLikes;
use HepC\Models\Access;
use HepC\Models\PostsAccess;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 1) get the posts
        $posts = Posts::select('id', 'type','title','media_path','description')->get();
        
        $access = Access::all()->keyBy('id')->toArray();

        $comments = Comments::select('id','name')->get()->keyBy('id');

        foreach ($posts as $post) {
            
            $post_comments = PostsComments::where('post_id', '=', $post->id)->select('id','comment_id')->get();

            //clean and set a format for post comments.
            $main_comments = array();
            $i = 0;
            foreach ($comments as $key => $value) {

                $post_comments = PostsComments::where('post_id', '=', $post->id)->where('comment_id', '=', $value['id'])->count();

                $main_comments[$i]['id']    = $value['id'];
                $main_comments[$i]['count'] = $post_comments;
                $main_comments[$i]['name']  = $value['name'];
                
                $i++;
            }            

            $post_access = PostsAccess::where('post_id', '=', $post->id)->select('access_id','status')->get()->toArray();

            //clean and set a format for post access.
            foreach ($post_access as $key => $value) {
                $post_access[$access[$value['access_id']]['name']] = $value['status'];

                unset($post_access[$key]);
            }

            $post['media_path']  = url().$post['media_path'];
            $post['poster']      = 0;//pendant
            $post['comments']    = $main_comments;
            $post['permissions'] = $post_access;

            $post['status']=array('status'=>'like');//line requested, and needed by FE.
            
        }

        return \Response::json(json_decode($posts, true), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \Response::json('Not Implemented', 501);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return \Response::json('Not Implemented', 501);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            // 1) get the post
            $post = Posts::findOrFail($id);

            // 2) get related comments
            $post_comments = PostsComments::where('post_id', '=', $id)->select('id','comment_id','onesignal_id')->get();

            // 3) get comment
            $comments = Comments::select('id','name')->get()->keyBy('id')->toArray();

            $post_comments = $post_comments->toArray();

            //4) associate post with comment            
            $i = 0;
            foreach ($comments as $key => $value) {

                $post_comments = PostsComments::where('post_id', '=', $post->id)->where('comment_id', '=', $value['id'])->count();

                $main_comments[$i]['id']    = $value['id'];
                $main_comments[$i]['count'] = $post_comments;
                $main_comments[$i]['name']  = $value['name'];
                
                $i++;
            }  

            //5) Get permissions per post
            $post_access = PostsAccess::where('post_id', '=', $id)->select('access_id','status')->get()->toArray();

            $access = Access::all()->keyBy('id')->toArray();
            //clean and set a format for post access.
            foreach ($post_access as $key => $value) {
                $post_access[$access[$value['access_id']]['name']] = $value['status'];

                unset($post_access[$key]);
            }

            $post['media_path']     = url().$post['media_path'];
            $post['post_comments']  = $main_comments;
            $post['permissions']    = $post_access;

            return \Response::json(json_decode($post, true), 200);
        }
        catch (ModelNotFoundException $e){
            return \Response::json(array('error'=>$e->getCode(), 'error_description' => $e->getMessage()), 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return \Response::json('Not Implemented', 501);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return \Response::json('Not Implemented', 501);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
        $validator = $this->validateCreatePostCommentParameter($request);

        try {
            if($validator->fails()){
                // 2.1) validation fails fails
                return \Response::json(array(
                        'error'             => 'Bad Request ',
                        'error_description' => $validator->errors()->all())
                    , 400);
            }else{
                // 2.2) save comment_x_post
                try {
                    // 3) if the ids are valid => save the relationship
                    $input = $request->all();

                    try{
                        $post_comment = PostsComments::where('post_id', '=', $input['post_id'])
                            ->where('onesignal_id', '=', $input['onesignal_id'])
                            ->get()->first();
                    }
                    catch(QueryException $e){
                        return \Response::json(array('error'=>$e->getCode(), 'error_description' => $e->getMessage()), 500);
                    }

                    if(isset($post_comment)){//update

                        try{

                            $update_post_comment = PostsComments::where('post_id', '=', $input['post_id'])
                            ->where('onesignal_id', '=', $input['onesignal_id'])
                            ->get()->first();

                            $comment_x_post = $update_post_comment->update($input);
                        }catch(QueryException $e){
                            return \Response::json(array('error'=>$e->getCode(), 'error_description' => $e->getMessage()), 500);
                        }

                    }else{//insert the relation
                        try{
                            $comment_x_post = PostsComments::create($input);
                        }catch(QueryException $e){
                            return \Response::json(array('error'=>$e->getCode(), 'error_description' => $e->getMessage()), 500);
                        }
                    }

                    return \Response::json(json_decode($comment_x_post, true), 200);
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

        $validator = $this->validateCreatePostLikeParameter($request);

        try {
            if($validator->fails()){
                // 2.1) validation fails 
                return \Response::json(array(
                        'error'             => 'Bad Request ',
                        'error_description' => $validator->errors()->all())
                    , 400);
            }else{
                // 2.2) save like_x_post
                try {
                    $input = $request->all();
                  
                    // 3) check if relationship already exist (the user already liked the post)
                    $is_liked = PostsLikes::where('post_id', '=', $input['post_id'])
                            //->where('anonymous_id', '=', $input['anonymous_id'])
                            ->first();
                    // check if row exist
                    if( empty($is_liked) ){
                        // 4.1) if the ids are valid => save the relationship

                            $input = $request->all();
                    try {

                        $like_x_post = PostsLikes::create($input);

                        return \Response::json(json_decode($like_x_post, true), 200);

                    }
                    catch (\Exception $e) { 

                        //return \Response::json(array('error'=>$e->getCode(), 'error_description' => $e->getMessage()), 500);
                        return \Response::json(array('message' => 'Integrity constraint violation, please check the post ID.'), 500);
                    }

                    }else{
                        // 4.2) dislike
                        PostsLikes::where('post_id', '=', $input['post_id'])
                            //->where('anonymous_id', '=', $input['anonymous_id'])
                            ->delete();

                        return \Response::json(array('message' => 'You disliked the post.'), 200);
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
    public function validateCreatePostCommentParameter(Request $request){
        $validator = \Validator::make($request->isJson() ? $request->json()->all() : $request->all() , [
            'post_id' => 'required|integer',
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
    public function validateCreatePostLikeParameter(Request $request){
        $validator = \Validator::make($request->isJson() ? $request->json()->all() : $request->all() , [
            'post_id' => 'required|integer',
            //'anonymous_id' => 'required',
            'onesignal_id' => 'required'
        ]);
        return $validator;
    }
}
