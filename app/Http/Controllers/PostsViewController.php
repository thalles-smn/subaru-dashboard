<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;

class PostsViewController extends Controller
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
        $this->middleware('auth');
        $this->photo = $photo;
        $this->post = $post;
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        $posts = $this->post->paginate(10);
        return view("posts.index", compact('posts'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){

        return view("posts.create");
    }

    public function store(PostCreateRequest $request ){
        $post = $this->post->create($request->all('title', 'text'));

        if($post != null) {
            $file = $request->file("photo");

            if($file != null) {
                $path = $request->file("photo")->store("data", "s3");
                \Storage::disk("s3")->setVisibility($path, 'public');
                $data = ["post_id" => $post->_id, "path" => $path];
                $this->photo->create($data);
            }

            return redirect()->route('posts.edit', ["id"=>$post->id]);
        }

        return redirect()->route('posts.index');
    }

    public function update(PostUpdateRequest $request, $id ){
        $post = $this->post->find($id);

        if($post != null){
            $post->update($request->all('title', 'text'));
            $file = $request->file("photo");

            if($file != null && $file->isFile()){
                $photos = $post->photos();

                $path = $request->file("photo")->store("data", "s3");
                \Storage::disk("s3")->setVisibility($path, 'public');
                $data = ["post_id" => $post->_id, "path" => $path];
                $this->photo->create($data);

                foreach ($photos as $photo ){
                    $photo->delete();
                }

                return redirect()->route('posts.edit', ["id"=>$post->id]);
            }
        }

        return redirect()->route('posts.index');
    }
	
	public function marked( $id ){
		
		$post = $this->post->find($id);
		
		if($post != null){
			
			if(isset($post->marked) && is_bool($post->marked) && $post->marked){
				$post->marked = false;
			} else {
				$post->marked = true;
			}
			
			$post->update();
			
			return redirect()->route('posts.index');
			
		}
		
		return redirect()->route('posts.index');
	}

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function edit($id){

        $post = $this->post->find($id);
        $photo = env("AWS_URL") . $post->photos()->first()->path;
        return view("posts.edit", compact('post', 'photo'));
    }

    public function destroy($id){
        $post = $this->post->find($id);

        if($post != null){
            $photos = $post->photos();
            foreach ($photos as $photo ){
                $photo->delete();
            }
            $post->delete();
        }

        return redirect()->route('posts.index');
    }
}
