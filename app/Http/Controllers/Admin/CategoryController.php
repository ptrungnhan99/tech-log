<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        $categories = data_tree($categories);
        //dd($categories)
        foreach ($categories as $cat) {
            $data_select[$cat->id] = str_repeat('|-----', $cat->level) . $cat->name;
        }
        //dd($data_select);
        return view('admin.category.cat_list', [
            'categories' => $categories,
            'data_select' => $data_select,
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
        foreach ($categories as $cat) {
            $data_select[$cat->id] = str_repeat('|-----', $cat->level) . $cat->name;
        }
        //dd($data_select);
        return view('admin.category.cat_create', [
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
            'name' => 'required',
        ], [
            'name.required' => 'Please Enter Category Name'
        ]);
        $data = $request->all();
        $cate = new Category();
        $cate->name = $data['name'];
        $cate->slug = Str::slug($data['name'], "-");
        $cate->parent_id = $data['parent_id'];
        $cate->description = $data['desc'];
        $cate->cat_order = $data['cat_order'];
        $n = $cate->save();
        if ($n > 0) {
            return redirect('/admin/category')->with('success', 'Add Category Success');
        } else {
            return redirect()->back()->with('alert', 'Add Category Failed');
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
        $category = Category::find($id);
        $categories = Category::all();
        $categories = data_tree($categories);
        foreach ($categories as $cat) {
            $data_select[$cat->id] = str_repeat('|-----', $cat->level) . $cat->name;
        }
        return view('admin.category.cat_edit', [
            'category' => $category,
            'data_select' => $data_select
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
            'name' => 'required'
        ], [
            'name.required' => 'Please Enter Category Name'
        ]);
        $data = $request->all();
        $cate = Category::find($id);
        $cate->name = $data['name'];
        $cate->slug = Str::slug($data['name'], "-");
        $cate->parent_id = $data['parent_id'];
        $cate->description = $data['desc'];
        $cate->cat_order = $data['cat_order'];
        $n = $cate->save();
        if ($n > 0) {
            return redirect('/admin/category')->with('success', 'Add Category Success');
        } else {
            return redirect()->back()->with('alert', 'Cập nhật không thành công');
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
        $cat = Category::find($id);
        if ($id == 19) {
            return redirect()->back()->with('alert', 'This is default category. Cannot delete it!!');
        }
        if (count($cat->subcategory) > 0) {
            return redirect()->back()->with('alert', 'Please delete all sub category!!');
        }
        $cat->delete();
        return redirect()->back()->with('success', 'Delete Success!!');
    }

    public function loadCategory()
    {
        $categories = Category::all();

        $categories = $this->data_tree($categories);
        foreach ($categories as $cat) {
            $data_select[$cat->id] = str_repeat('|-----', $cat->level) . $cat->name;
        }
        return response()->json([
            'result' => [$categories, $data_select],
        ]);
    }
}
