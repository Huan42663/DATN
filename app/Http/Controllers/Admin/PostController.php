<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryPost;
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
        $posts = Post::with('categoryPost')->orderByDesc('post_id')->get();
        $categoryPost = CategoryPost::get();
        return View('admin.posts.index',compact('posts'));
    }

    public function create()
    {
        $posts = Post::with('categoryPost')->get();
        $categoryPost = CategoryPost::get();
        return View('admin.posts.create',compact('posts','categoryPost'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request['slug'] = Str::slug($request['title']);
        $request-> validate(
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
            $post_id = Post::create($data);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                foreach ($file as $key) {
                    $path_image = $key->store('posts');
                    $data=['post_id'=>$post_id->post_id,'image_name'=>$path_image];
                    PostImage::create($data);
                }
            }
            
            return redirect()->back()->with("success","Thêm Bài Viết Thành Công");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $post = Post::query()->with('PostImage')->where('slug',$slug)->get();
        $categoryPost = CategoryPost::get();
        if(!$post){
            return redirect()->route('Administration.posts.list')->with("error","Không tìm thấy bài viết ");
        }else
        {    
            return View('admin.posts.update',compact('post','categoryPost'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $postCheck = Post::query()->where('post_id',$post->post_id)->get();
        if(!$postCheck){
            return redirect()->back()->with("error","Không tìm thấy bài viết");
        }
        else{
            $request-> validate(
                [
                    'title' => 'required',
                    'short_description' => 'nullable',
                    'content' => 'required',
                    'category_post_id' => 'required'
    
                ],
                [
                    'title.required' => 'title bài viết không được để trống',
                    'content.required' => 'Nội dung  không được để trống',
                    'category_post_id.required' => 'danh mục không được để trống',
                ]
    
            );
                $checkPost = Post::query()->where('post_id','!=',$post->post_id)->get();
                foreach($checkPost as $key){
                    if($key->category_post_name == $request['title']){
                        return response()->json('Danh mục đã tồn tại',402);
                    }
                }
                if($request['title'] != $postCheck[0]->title){
                    $request['slug'] = Str::slug($request['title']);
                }else{
                    $request['slug'] = $postCheck[0]->slug;
                }
                $data= [ 
                    'title'             =>$request['title'],
                    'short_description' => $request['short_description'],
                    'slug'              =>$request['slug'],
                    'content'           => $request['content'],
                    'category_post_id'  => $request['category_post_id']
                ];
                
                $post->update($data);

                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    if($file){
                        $image = PostImage::query()->where('post_id',$post->post_id)->get();
                        foreach($image as  $value) {
                            if (file_exists('storage/' . $value->image_name)) {
                                unlink('storage/' .  $value->image_name);
                            }
                            $value->delete();
                        }
                            
                    }
                    foreach ($file as $key) {
                        $path_image = $key->store('posts');
                        $data1 =['post_id'=>$post->post_id,'image_name'=>$path_image];
                        PostImage::create($data1);
                    }
                    
                }
                return redirect()->route('Administration.posts.show',$request['slug'])->with("success","Sửa Bài Viết Thành Công");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $Check = Post::query()->where('post_id',$post)->get();
        if(!$Check){
            return redirect()->back()->with("error","Không tìm thấy bài viết");
        }else{
            $post->delete();
            return redirect()->back()->with("success","Xóa bài viết thành công");
        }
    }
}
