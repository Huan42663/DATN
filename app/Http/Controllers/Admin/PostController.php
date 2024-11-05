<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::query()->get();
        return response ()->json(['message'=>'Danh sách bài viết','data'=> $posts],Response::HTTP_OK);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request['slug'] = Str::slug($request['title']);
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|unique:posts,title',
                'short_description' => 'nullable',
                'content' => 'required',
                'category_post_id' => 'required'

            ],
            [
                'title.required' => 'title bài viết không được để trống',
                'title.unique' => 'title bài viết đã bị trùng',
                'content.required' => 'Nội dung  không được để trống',
                'category_post_id.required' => 'danh mục không được để trống',
            ]

        );
        $data=[ 
            'title'             =>$request['title'],
            'short_description' => $request['short_description'],
            'slug'              => $request['slug'],
            'content'           => $request['content'],
            'category_post_id'  => $request['category_post_id']
        ];
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'data'=>$request->all()], Response::HTTP_BAD_REQUEST);
        } else {
            $post_id = Post::create($data);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                foreach ($file as $key) {
                    $path_image = $key->store('posts');
                    $data=['post_id'=>$post_id->post_id,'image_name'=>$path_image];
                    $image = PostImage::create($data);
                }
            }
            
            return response()->json(['message'=>'Thêm bài viết thành công','data' => $post_id], Response::HTTP_CREATED);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $post = Post::query()->with('PostImage')->where('slug',$slug)->get();
        if(!$post){
            return response()->json('Không tồn tại bài viết',Response::HTTP_NOT_FOUND);
        }else
        {    
        return response()->json(['data'=>$post],Response::HTTP_OK);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::query()->where('post_id',$id)->get();
        if(!$post){
            return response()->json('Bài viết không tồn tại',Response::HTTP_NOT_FOUND);
        }
        else{
            $validator = Validator::make(
                $request->all(),
                [
                    'title' => 'required',
                    'short_description' => 'nullable',
                    'content' => 'required',
                    'category_post_id' => 'required'
    
                ],
                [
                    'title.required' => 'title bài viết không được để trống',
                    'title.unique' => 'title bài viết đã bị trùng',
                    'content.required' => 'Nội dung  không được để trống',
                    'category_post_id.required' => 'danh mục không được để trống',
                ]
    
            );
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(),'data'=>$request->all()], Response::HTTP_BAD_REQUEST);
            }
             else {
                $checkPost = Post::query()->where('post_id','!=',$id)->get();
                foreach($checkPost as $key){
                    if($key->category_post_name == $request['title']){
                        return response()->json('Danh mục đã tồn tại',402);
                    }
                }
                if($request['title'] != $post[0]->title){
                    $request['slug'] = Str::slug($request['title']);
                }
                $data=$request->except('image');
                $post = Post::query()->where('post_id',$id)->update($data);

                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    foreach ($file as $key) {
                        $path_image = $key->store('posts');
                        $data1 =['post_id'=>$id,'image_name'=>$path_image];
                        PostImage::create($data1);
                    }
                    if($file){
                        $image = PostImage::query()->where('post_id',$id)->get();
                        foreach($image as  $value) {
                            if (file_exists('storage/' . $value->image_name)) {
                                unlink('storage/' .  $value->image_name);
                            }
                            $value->delete();
                        }
                            
                    }
                }
            return response()->json('Cập nhật bài viết thành công',Response::HTTP_OK);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::query()->where('post_id',$id)->get();
        if(!$post){
            return response()->json('Không tìm thấy bài viết',Response::HTTP_NOT_FOUND);
        }else{
            $post->delete();
            return response()->json('Xóa bài viết thành công',Response::HTTP_OK);
        }
    }
}
