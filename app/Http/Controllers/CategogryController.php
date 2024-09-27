<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategogryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categoreis=Category::paginate(5);
        return view('category.index',compact('categoreis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     $request->validate([
        'title'=>"required |max:30 | min:3|string|unique:categoreis,title,",
        'description'=>'required |max:50 | min:3|string',
     ]);
        $category=new category();
        $category->title=$request->title;
        $category->description=$request->description;
        $category->save();
        return redirect()->back()->with("done","create succefuly");
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
$categoreis=Category::find($id);
return view('category.show',compact('categoreis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $categoreis=Category::find($id);
        return view('category.edit',compact('categoreis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'title'=>"required |max:30 | min:3|string|unique:categoreis,title,$id",
            'description'=>'required |max:50 | min:3|string',
         ]);
            $categoreis= Category::find($id);
            $categoreis->title=$request->title;
            $categoreis->description=$request->description;
            $categoreis->save();
            return redirect()->back()->with("done","update succefuly");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
$categoreis=Category::destroy($id);
return redirect()->back();
    }
}
