<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['category'])->get();
        $categories = Category::all();
        return view('Dashboard.products.products',compact('products','categories'));
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
            'product_name' => 'required|unique:products,product_name|max:255',
            'description' => 'required',
            'category_id' => 'required'
        ], [
            'product_name.required' => 'يرجى ادخال اسم المنتج',
            'product_name.unique' => 'اسم المنتج مسجل مسبقا',
            'description.required' => 'يرجى ادخال الملاحظات',
            'category_id.required' => 'يرجى اختيار القسم'
        ]);
        $product = new Product();
        $product->product_name = $request->get('product_name');
        $product->description = $request->get('description');
        $product->category_id = $request->get('category_id');
        $product->save();
        return redirect()->route('products.index')->with('success', 'تم اضافة المنتج بنجاح');
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
        $ids = $request->id;

        $request->validate([
            'product_name' => 'required|unique:products,product_name,'.$ids,
            'description' => 'required',
        ], [
            'product_name.required' => 'يرجى ادخال اسم المنتج',
            'product_name.unique' => 'اسم المنتج مسجل مسبقا',
            'description.required' => 'يرجى ادخال الملاحظات',
        ]);

        $id = Category::where('sections_name', $request->sections_name)->first()->id;
        $Products = Product::find($ids);
        $Products->update([
        'product_name' => $request->product_name,
        'description' => $request->description,
        'category_id' => $id,
        ]);
        return redirect()->route('products.index')->with('success', 'تم تعديل المنتج بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success','تم حذف المنتج بنجاح');
    }
}
