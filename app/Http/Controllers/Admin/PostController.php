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
                'title' => 'required|max:50|unique:posts,title|regex:/^[\p{L}\p{N}\p{P}\p{Zs}]+$/u',
                'short_description' => 'nullable|max:100', 
                'content' => 'required',
                'category_post_id' => 'required'
            ],
            [
                'title.required' => 'title bài viết không được để trống',
                'title.unique' => 'title bài viết đã bị trùng',
                'title.max' => 'title bài viết không được quá 55 kí tự',
                'short_description.max' => 'Mô tả ngắn không được vượt quá 100 ký tự.', 
                'title.regex' => 'title bài viết không được chứa ký tự không hợp lệ',
                'content.required' => 'Nội dung không được để trống',
                'category_post_id.required' => 'Danh mục không được để trống',
            ]
        );
      
        $data=[ 
            'title'             =>$request['title'],
            'short_description' => $request['short_description'],
            'slug'              => $request['slug'],
            'content'           => $request['content'],
            'category_post_id'  => $request['category_post_id']
        ];
        $check = $this->ValidateText($request->title);
        if($check == false){
            $_SESSION['data'] = $data;
            return redirect()->back()->with('title','title không được chứa kí tự đặc biệt');
        }
            $post_id = Post::create($data);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                foreach ($file as $key) {
                    $path_image = $key->store('posts');
                    $data=['post_id'=>$post_id->post_id,'image_name'=>$path_image];
                    PostImage::create($data);
                }
            }
            unset($_SESSION['data']);
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
            // dd($post);
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
                    'title' => 'required|max:255',
                    'short_description' => 'nullable',
                    'content' => 'required',
                    'category_post_id' => 'required'
    
                ],
                [
                    'title.required' => 'title bài viết không được để trống',
                    'title.max' => 'title bài viết không được quá 255 kí tự',
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
                $check = $this->ValidateText($request->title);
                if($check == false){
                    $_SESSION['data'] = $data;
                    return redirect()->back()->with('title','title không được chứa kí tự đặc biệt');
                }
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
                unset($_SESSION['data']);
                return redirect()->route('Administration.posts.show',$request['slug'])->with("success","Sửa Bài Viết Thành Công");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if(isset($request->post_id) && !empty($request->post_id)){
            foreach($request->post_id as $item){
                $image = PostImage::query()->where('post_id',$item)->get();
                if(count($image)>0){
                    foreach($image as  $value) {
                        if (file_exists('storage/' . $value->image_name)) {
                            unlink('storage/' .  $value->image_name);
                        }
                        $value->delete();
                    }
                }
                Post::query()->where('post_id',$item)->delete();
            }
            return redirect()->back()->with('success','Xóa bài viết thành công');
        }
        else{
            return redirect()->back()->with('error','Không tìm thấy bài viết ');
        }
    }
    public function destroyImage(Post $post){
        $image = PostImage::query()->where('post_id',$post->post_id)->get();
        foreach($image as  $value) {
            if (file_exists('storage/' . $value->image_name)) {
                unlink('storage/' .  $value->image_name);
            }
            $value->delete();
        }
        return redirect()->route('Administration.posts.show',$post->slug)->with("success","Xóa Ảnh Bài Viết Thành Công");

    }
    function ValidateText($string)
    {
        // Tạo biểu thức chính quy từ danh sách các ký tự đặc biệt
        $arrayK = array('!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '_', '+', '=', '{', '}', '[', ']', '|', '\\', ':', ';', '"', "'", '<','?');
        $content = str_split($string);
        $check = true;
        foreach ($content as $item) {
            foreach ($arrayK as $value) {
                if ($item === $value) {
                    $check = false;
                }
            }
        }
        // Kiểm tra xem chuỗi có khớp với biểu thức chính quy hay không
        return $check;
    }
}
