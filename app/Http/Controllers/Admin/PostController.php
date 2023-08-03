<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('admin.post.post_list', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $categories = data_tree($categories);
        $data_select = [];
        foreach ($categories as $cat) {
            $data_select[$cat->id] = str_repeat('|-----', $cat->level) . $cat->name;
        }
        return view('admin.post.post_create', [
            'data_select' => $data_select
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ], [
            'title.required' => 'Please Enter Category Name'
        ]);
        $nameThumbnail = '';
        $data = $request->all();
        $post = new Post();
        $post->title = $data['title'];
        $post->description = $data['desc'];
        $post->content = $data['content'];
        $post->slug = Str::slug($data['title'], "-");
        $post->category_id = $data['category_id'];
        $post->highlight = isset($data['highlight']) ? true : false;
        $post->status = isset($data['status']) ? true : false;
        $post->user_id = Auth::id();
        if ($request->hasfile('thumbnail')) {
            if ($request->file('thumbnail')->isValid()) {
                $file = $request->file('thumbnail');
                $nameThumbnail = $file->getClientOriginalName();
                $file->move('public/images', $nameThumbnail);
                // $request->thumbnail->storeAs('image_post',  $nameThumbnail);
            }
        }
        $post->thumbnail = $nameThumbnail;
        $n = $post->save();
        if ($n > 0) {
            return redirect('/admin/post')->with('success', 'Add Post Success');
        } else {
            return redirect()->back()->with('alert', 'Add Post Failed');
        }
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
        $post = Post::find($id);
        $categories = Category::all();
        $categories = data_tree($categories);
        $data_select = [];
        foreach ($categories as $cat) {
            $data_select[$cat->id] = str_repeat('|-----', $cat->level) . $cat->name;
        }
        return view('admin.post.post_edit', [
            'data_select' => $data_select,
            'post' => $post
        ]);
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
        $this->validate($request, [
            'title' => 'required',
        ], [
            'title.required' => 'Please Enter Category Name'
        ]);
        $data = $request->all();
        $post = Post::find($id);
        $nameThumbnail = $post->thumbnail;
        if ($request->hasfile('thumbnail')) {
            if ($request->file('thumbnail')->isValid()) {
                $file = $request->file('thumbnail');
                $nameThumbnail = $file->getClientOriginalName();
                $file->move('public/images', $nameThumbnail);
                // $request->thumbnail->storeAs('image_post',  $nameThumbnail);
            }
        }
        $post->thumbnail = $nameThumbnail;
        $post->title = $data['title'];
        $post->description = $data['desc'];
        $post->content = $data['content'];
        $post->slug = Str::slug($data['title'], "-");
        $post->category_id = $data['category_id'];
        $post->highlight = isset($data['highlight']) ? true : false;
        $post->status = isset($data['status']) ? true : false;
        $post->user_id = Auth::id();
        $n = $post->save();
        if ($n > 0) {
            return redirect('/admin/post')->with('success', 'Update Post Success');
        } else {
            return redirect()->back()->with('alert', 'Update Post Failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->back()->with('success', 'Delete Success!!');
    }
}
