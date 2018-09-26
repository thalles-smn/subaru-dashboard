<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Post;
use Illuminate\Http\Request;
use Storage;

class PhotoController extends Controller
{
    /**
     * @var Photo
     */
    private $photo;

    /**
     * @var Post
     */
    private $post;

    public function __construct( Photo $photo, Post $post )
    {
        $this->photo = $photo;
        $this->post = $post;
    }

    public function upload($postId, Request $request ){
        $post = $this->post->find($postId);

        if($post != null){
            $path = $request->file("photo")->store("data","s3");
            Storage::disk("s3")->setVisibility($path, 'public');
            $data = ["post_id"=>$postId, "path"=>$path];
            return response()->json($this->photo->create($data), 201);
        }

        return response()->noContent(404);
    }

    public function byPost( $postId ){

    }

    public function destroy( $id ){
        $photo = $this->photo->find($id);
        if($photo != null) {
            Storage::disk("s3")->delete($photo->path);
            $photo->delete();

            return response()->noContent(200);
        }

        return response()->noContent(404);
    }
}
