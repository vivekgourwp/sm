<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\Basecontroller as BaseController;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        if ($posts->isEmpty()) { // Check if the collection is empty
            return $this->sendError('No posts found', [], 404);
        }
        return $this->sendResponse($posts, 'Post data successfully retrieved');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response~~
     */
    public function store(Request $request)
    {
        $validatePost = Validator::make(
            $request->all(), // ✅ this is the data to validate
            [
                'title' => 'required',
                'description' => 'required|string',
                'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            ]
        );
        if($validatePost->fails()){
            return $this->sendError('Validation failed.', $validatePost->errors()->all());
        }

        $img = $request->image;
        $ext = $img->getClientOriginalExtension();
        $imgName = time(). '.' . $ext;
        $img->move(public_path().'/uploads',$imgName);


        $post= Post::create([
            'title'             => $request->title,
            'description'       => $request->description,
            'image'             => $imgName,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Post successfully registered',
            'data' => $post
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = POST::find($id);
        if (!$post) {
            return $this->sendError('Post not found', [], 404);
        }
        return $this->sendResponse($post, 'Single Post data successfully retrieved');
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
        $validatePost = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // allow optional image
            ]
        );

        if ($validatePost->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validatePost->errors()->all()
            ], 422);
        }

        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'status' => false,
                'message' => 'Post not found'
            ], 404);
        }

        // Handle image only if it's uploaded
        if ($request->hasFile('image')) {

            if ($post->image && file_exists(public_path('/uploads/' . $post->image))) {
                unlink(public_path('/uploads/' . $post->image));
            }

            $img = $request->file('image');
            $ext = $img->getClientOriginalExtension();
            $imgName = time() . '.' . $ext;
            $img->move(public_path('/uploads'), $imgName);
            $post->image = $imgName;
        }

        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();

        return response()->json([
            'status' => true,
            'message' => 'Post successfully updated',
            'data' => $post
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imgPath = Post::where('id', $id)->value('image');
        if ($imgPath && file_exists(public_path('/uploads/' . $imgPath))) {
            unlink(public_path('/uploads/' . $imgPath));
        }
        $post = Post::where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'your post are deleted succsefully'
        ]);
    }
}
