<?php

namespace HepC\Http\Controllers\Admin;

use Illuminate\Http\Request;
use HepC\Http\Controllers\Controller;
use HepC\Models\Posts;
use HepC\Models\Access;
use HepC\Models\PostsAccess;


class AdminPostsController extends Controller
{
    // Access type:
    const GATED = 1;
    const OPEN = 2;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 1) get the posts
        $posts = Posts::latest()->paginate(20);

        $no = $posts->firstItem();

        // 2) return de view
        return view('admin.posts.index')
            ->with('posts', $posts)
            ->with('no', $no);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 1) set the access type
        // $access = array(
        //             $this::GATED => 'Open Access',
        //             $this::OPEN => 'Gated'
        //         );

        $access = Access::select('name','id')->get()->keyBy('id')->toArray();

        // 2) return the create view
        return view('admin.posts.create')
            ->with('access', $access);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1) validation rules
        $validator = $this->validateCreatePostsParameter($request);

        // 2) get the validation rules
        $input = (object)$request->all();
        
        // validate
        if($validator->fails()){
            // 3.1) send error message
             return redirect()->route('admin.posts.create')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            // 3.2)create post
            $input = (array) $input;

            $access = Access::all()->keyBy('id')->toArray();

            $posts  = Posts::create($input);//Add the new Post

            // 3.2)create access rules
            foreach ($access as $key => $value) {

                $access_key[$key]['status']     = !empty($input['access_key'][$key]) ? $input['access_key'][$key] : 0;
                $access_key[$key]['access_id']  = $key;
                $access_key[$key]['post_id']    = $posts->toArray()['id'];
            }

            PostsAccess::insert($access_key);//Insert the new access rules associated to the Post.
        }

        // 4) redirect to list
        return redirect()->route('admin.posts.edit', ['id' => $posts])->withMessage('Post saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 1) get the post
        $post = Posts::findOrFail($id);

        // 2) set the access type
        // $access = array(
        //             $this::GATED => 'Open Access',
        //             $this::OPEN => 'Gated'
        //         );

        $access = PostsAccess::where('post_id',$id)->join('access', 'access_id', '=', 'access.id')->get()->keyBy('id')->toArray();

        // 3) get the selected access
        $my_access = $post->access;

        // 4) return the edit view
        return view('admin.posts.edit')
            ->with('post', $post)
            ->with('access', $access)
            ->with('my_access', $my_access);
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
        // 1) get the post
        $post = Posts::findOrFail($id);

        // 2) validation rules
        $validator = $this->validateCreatePostsParameter($request);

        // 3) get the validation rules
        $input = (object)$request->all();
        
        // 4) validate
        if($validator->fails()){
            // 4.1) send error message
             return redirect()->route('admin.posts.edit', ['id' => $post])
                        ->withErrors($validator)
                        ->withInput();
        }else{
            // 4.2)create category
            $input = (array) $input;

            $post->update($input);
            
            //Get the current Post Access ** needed.
            $post_access = PostsAccess::where('post_id', '=', $id)->select('id','access_id','status')->get()->toArray();
                                    
            //5) Update the Access Keys for Post
            $access_key = array();
            foreach ($post_access as $key => $value) {

                $access_key['status'] = !empty($input['access_key'][$value['access_id']]) ? 1 : 0;

                $access = PostsAccess::findOrFail($value['id']);

                $access->update($access_key);
            }
   
        }

        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 1) get the posts
        $post = Posts::findOrFail($id);

        // 2) delete it
        $post->delete();

        // 3) return to the index view
        return redirect()->route('admin.posts.index');
    }

    /**
     * Create the validator for a new post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Validation\Validator $validator
     */
    public function validateCreatePostsParameter(Request $request){
        $validator = \Validator::make($request->isJson() ? $request->json()->all() : $request->all() , [
            'title'         => 'required|string',
            'subtitle'      => 'string',
            'description'   => 'required|string',
            //'access'        => 'required|integer',
            'link'          => 'url', 
        ]);
        return $validator;
    }

    /**
     * Upload an image to the post.
     *
     * @param  Request  $request
     * @return json
     */
    public function uploadImage(Request $request)
    {
        $coversFolder = '/public/images/posts/';
        $publicPath = '/images/posts/';
        
        try {
            $file = $request->file('coverImageTipDropzone');
            $name = 'post_' . str_random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(base_path() . $coversFolder, $name);

            if( $request->input('media_path' ) != ''){
                // Delete previous File
                \File::delete( base_path() . $coversFolder . basename($request->input('media_path' ) ) );
            }
            if( !empty( $request->input('id') ) ){
                $postID = $request->input('id');
                $post = Posts::find($postID);
                $previousImage = $post->media_path;
                $post->media_path = $publicPath . $name;
                $post->save();
                
                // Delete previous File
                if (isset($previousImage)) {
                    \File::delete(base_path() . $coversFolder . basename($request->input('media_path' ) ));
                }
            }

            return json_encode(array('success' => true, 'image' => '/images/posts/' . $name ), 200);
        } catch (FileException $e) {
            throw new CustomException($e->getMessage());
        }

    }
}
