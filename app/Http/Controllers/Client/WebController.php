<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebController extends Controller
{
    public function home()
    {
        $highlights = Post::where('highlight', 1)->where('status', 1)->latest()->take(3)->get();
        $list_id = [];
        foreach ($highlights as $value) {
            $list_id[] = $value->id;
        }
        $posts = Post::where('status', 1)->whereNotIn('id', $list_id)->latest()->take(10)->get();
        return view('client.home', [
            'posts' => $posts,
            'highlights' => $highlights
        ]);
    }
    public function single($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $related = Post::where('category_id', '=', $post->category->id)
            ->where('id', '!=', $post->id)->inRandomOrder()->limit(2)->get();
        $post->update([
            'view_counts' => $post->view_counts + 1
        ]);
        return view('client.single', [
            'post' => $post,
            'related' => $related
        ]);
    }
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $posts = Post::where('category_id', $category->id)->where('status', 1)->latest()->paginate(10);
        return view('client.category', [
            'category' => $category,
            'posts' => $posts
        ]);
    }
    public function contact()
    {
        return view('client.contact');
    }
    public function storeContact(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ], [
            'name.required' => 'Vui lòng nhập tên',
            'address.required' => 'Vui lòng nhập địa chỉ',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'subject.required' => 'Vui lòng nhập tiêu đề',
            'message.required' => 'Vui lòng nhập nội dung',
        ]);
        Contact::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message
        ]);
        return redirect()->back()->with('success', 'Chúng tôi sẽ sớm liên hệ với bạn !!!');
    }
    public function comment(Request $request, $slug)
    {
        $this->validate($request, [
            'content' => 'required',
        ], [
            'content.required' => 'Vui lòng nhập nội dung',
        ]);
        $post = Post::where('slug', $slug)->first();
        Comment::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'post_id' => $post->id
        ]);
        return redirect()->back();
    }
}
