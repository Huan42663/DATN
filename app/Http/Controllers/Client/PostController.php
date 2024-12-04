<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\CategoryPost;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class PostController extends Controller
{
    // Lấy danh sách bài viết
    public function index()
    {

        $posts = Post::with(['categoryPost', 'postImage'])->paginate(4);
        // dd($posts);
        // Trả về view và truyền dữ liệu
        return view('client.posts.index', compact('posts'));
    }

    // Lấy chi tiết một bài viết
    public function detail($slug)
    {
        // Lấy bài viết theo slug
        $post = Post::with('PostImage')->where('slug', $slug)->firstOrFail();
        
        // Loại bỏ các thẻ HTML trong nội dung bài viết
        $content = strip_tags($post->content);
    
        // Tách nội dung thành các câu dựa trên dấu chấm, dấu chấm hỏi, dấu chấm than
        $sentences = preg_split('/(?<=[.?!])\s+/', $content); // Tách nội dung theo dấu câu (dấu chấm, dấu chấm hỏi, dấu chấm than)
    
        // Danh sách ảnh của bài viết
        $images = $post->PostImage ?? collect();
        $imageIndex = 0;
        $imageCount = $images->count();
    
        // Mảng lưu nội dung và mảng lưu đường dẫn ảnh
        $textChunks = [];
        $imageUrls = [];
    
        // Chèn ảnh đầu tiên lên đầu nếu có
        if ($imageIndex < $imageCount) {
            $imageUrls[] = asset('storage/' . $images[$imageIndex]->image_name);
            $imageIndex++;
        }
    
        // Lưu các câu có độ dài từ 180 đến 250 từ và xen kẽ với ảnh
        $currentChunk = '';
        $currentWordCount = 0;
    
        foreach ($sentences as $sentence) {
            $sentenceWordCount = str_word_count($sentence); // Đếm số lượng từ trong câu
            $currentWordCount += $sentenceWordCount;
    
            // Thêm câu vào đoạn văn bản hiện tại
            $currentChunk .= $sentence . ' ';
    
            // Nếu đoạn văn có độ dài từ 180 đến 250 từ, thêm vào mảng textChunks
            if ($currentWordCount >= 180 && $currentWordCount <= 250) {
                $textChunks[] = $currentChunk;
                $currentChunk = ''; // Reset đoạn văn bản hiện tại
                $currentWordCount = 0; // Reset số từ
    
                // Nếu còn ảnh, thêm vào mảng ảnh
                if ($imageIndex < $imageCount) {
                    $imageUrls[] = asset('storage/' . $images[$imageIndex]->image_name);
                    $imageIndex++;
                }
            }
        }
    
        // Kiểm tra nếu còn đoạn chưa đủ 250 từ, thêm vào mảng
        if (!empty($currentChunk)) {
            $textChunks[] = $currentChunk;
        }
    
        // Lấy bài viết liên quan
        $relatedPosts = Post::where('category_post_id', $post->category_post_id)
            ->where('post_id', '!=', $post->post_id)
            ->inRandomOrder()
            ->take(5)
            ->get();
    
        // Truyền dữ liệu về view
        return view('client.posts.detail', [
            'textChunks' => $textChunks,
            'imageUrls' => $imageUrls,
            'post' => $post,
            'relatedPosts' => $relatedPosts,
        ]);
    }
    
}
