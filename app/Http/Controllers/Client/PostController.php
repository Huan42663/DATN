<?php 

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class PostController extends Controller
{
    // Lấy danh sách bài viết
    public function index()
    {
        $posts = Post::all();
        return response()->json(['data' => $posts], Response::HTTP_OK);
    }

    // Lấy chi tiết một bài viết
    public function show($slug)
    {
        // Tìm bài viết dựa trên slug
        $post = Post::where('slug', $slug)->first();

        if (!$post) {
            return response()->json(['message' => 'không tồn tại'], Response::HTTP_NOT_FOUND);
        }

        return response()->json(['data' => $post], Response::HTTP_OK);
    }

    // Tạo mới một bài viết
    public function store(Request $request)
{
    $validated = $request->validate([
        'category_post_id' => 'required|exists:category_post,category_post_id',
        'title' => 'required|string|max:50',
        'short_description' => 'nullable|string|max:100',
        'content' => 'required',
    ]);

    // Tạo slug từ title
    $slug = Str::slug($validated['title']);

    // Kiểm tra tính duy nhất của slug
    if (Post::where('slug', $slug)->exists()) {
        return response()->json([
            'message' => 'Slug đã tồn tại, vui lòng chọn một tiêu đề khác.',
        ], Response::HTTP_CONFLICT);
    }

    // Thêm slug vào dữ liệu đã xác thực
    $validated['slug'] = $slug;

    // Tạo bài viết mới
    $post = Post::create($validated);

    return response()->json([
        'message' => 'Thêm bài viết thành công',
        'data' => $post,
    ], Response::HTTP_CREATED);
}


    // Cập nhật bài viết
    public function update(Request $request, $post_id)
{
    // Tìm bài viết dựa trên post_id
    $post = Post::find($post_id);

    if (!$post) {
        return response()->json(['message' => 'Không có dữ liệu để cập nhật'], Response::HTTP_NOT_FOUND);
    }

    // Xác thực dữ liệu
    $validated = $request->validate([
        'category_post_id' => 'required|exists:category_post,category_post_id',
        'title' => 'required|string|max:50',
        'short_description' => 'nullable|string|max:100',
        'content' => 'required',
    ]);

    // Tạo slug từ title
    $slug = Str::slug($validated['title']);

    // Kiểm tra tính duy nhất của slug, bỏ qua bài viết hiện tại
    $existingPost = Post::where('slug', $slug)->where('post_id', '!=', $post->post_id)->first();

    if ($existingPost) {
        return response()->json(['message' => 'Slug đã tồn tại. Vui lòng chọn tiêu đề khác.'], Response::HTTP_CONFLICT);
    }

    // Cập nhật bài viết với dữ liệu đã validate và slug mới
    $post->update(array_merge($validated, ['slug' => $slug]));

    return response()->json([
        'message' => 'Cập nhật dữ liệu thành công',
        'data' => $post,
    ], Response::HTTP_OK);
}




    // Xóa bài viết
    public function destroy($slug)
    {
        try {
            // Tìm bài viết dựa trên slug
            $post = Post::where('slug', $slug)->first();
    
            if (!$post) {
                
                return response()->json(['message' => 'Không tìm thấy bài viết'], Response::HTTP_NOT_FOUND);
            }
    
            // Xóa bài viết
            $post->delete();
    
            // Trả về phản hồi thành công
            return response()->json(['message' => 'Xóa bài viết thành công'], Response::HTTP_OK);
        } catch (\Exception $e) {
            // Bắt mọi lỗi xảy ra và trả về phản hồi lỗi 500
            return response()->json(['message' => 'Đã xảy ra lỗi trong quá trình xóa bài viết', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
}
