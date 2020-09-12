<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(5);
        return view('management/category.category')->with('categories',$categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('management/category.createCategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ///1)Validate data
         $request->validate([
                'name' => 'required|unique:categories|max:255'
         ]);

         //2)Strore the new category to database 
         $category = new Category;
         $category->name = $request->name;
         $category->save();
        
         //3) send flash(message) to view 

         $request->session()->flash('status',$request->name. " saved successfully!");

        //4) redirect user to category page
        
        return (redirect('/management/category'));
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
        //1) Find category
        $category = Category::find($id);
        //2) return editCategory blade with the founded category 
        return view('/management/category.editCategory')->with('category',$category);
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
        //1) Validate new name
        $request->validate([
            
            'name'=> 'required|unique:categories|max:255'
            
            ]);
            //2)Search for the category
            $category = Category::find($id);
            //3)update category & save it
            $oldName =$category->name;
            $category->name=$request->name;
            $category->save();
            //4)send flash message
            $request->session()->flash('status',$oldName. " is updated successfulley to ".$request->name);

        return(redirect('/management/category'));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy($id);
        session()->flash('status',"Category deleted successfully!");
        return redirect('/management/category');
    }
}