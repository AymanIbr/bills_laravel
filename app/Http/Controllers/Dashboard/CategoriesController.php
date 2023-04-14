<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('Dashboard.categories.categories',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'sections_name' => 'required|unique:categories,sections_name|max:255',
            'description' => 'required',
         ],[
            'sections_name.required' => 'يرجى ادخال اسم القسم',
            'sections_name.unique' => 'اسم القسم مسجل مسبقا',
            'description.required' => 'يرجى ادخال الملاحظات',
        ]);
            $category = new Category();
            $category->sections_name = $request->get('sections_name');
            $category->description = $request->get('description');
            $category->created_by = Auth::user()->name;
            $category->save();
            return redirect()->route('categories.index')->with('success','تم اضافة القسم بنجاح');


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
    public function edit(Category $category)
    {
        // return view('Dashboard.categories.include.updateModela',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $id = $request->id;

        $request->validate([
            'sections_name' => 'required|max:255|unique:categories,sections_name,'.$id,
            'description' => 'required',
        ],[

            'sections_name.required'=>'يرجى ادخال اسم القسم',
            'sections_name.unique'=>'اسم القسم مسجل مسبقا',
            'description.required'=>'يرجى ادخال البيان',
        ]);

        $categories = Category::find($id);
        $categories->update([
            'sections_name' => $request->sections_name,
            'description' => $request->description,
        ]);

        return redirect()->route('categories.index')->with('success','تم تعديل القسم بنجاح');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Category::find($id)->delete();
        return redirect()->route('categories.index')->with('success','تم حذف القسم بنجاح');
    }
}
