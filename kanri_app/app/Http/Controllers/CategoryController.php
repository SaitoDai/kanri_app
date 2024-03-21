<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

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
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->input('name');
        if(Category::where('name', $category->name)->exists())
        {
            return redirect()->back()->with('flash_message', 'そのカテゴリー名は既に存在しています。');
        } 

        $category->save();
        return redirect()->route('categories.index')->with('flash_message', 'カテゴリー「' . $category->name . '」を追加しました。');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->name = $request->input('name');
        if(Category::where('name', $category->name)->exists())
        {
            return redirect()->back()->with('flash_message', 'そのカテゴリー名は既に存在しています。');
        }
        $category->update();
        return redirect()->route('categories.index')->with('flash_message', 'カテゴリー「' . $category->name . '」を編集しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('flash_message', '「' . $category->name .  '」を削除しました。');
    }
}
