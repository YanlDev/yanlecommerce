<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Family;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('family')->orderBy('id','desc')->paginate(10);
//        dd($categories);
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $families = Family::all();
        return view('admin.categories.create',compact('families'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|string',
            'family_id' => 'required|integer|exists:families,id',
        ]);
        Category::create($validatedData);
        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Bien hecho!',
            'text' => 'Categoría creada correctamente',
        ]);
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $families = Family::all();
        return view('admin.categories.edit',compact('category','families'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'family_id' => 'required|integer|exists:families,id',
        ]);
        $category->update($validatedData);
        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Bien hecho!',
            'text' => 'Categoría actualizada correctamente',
        ]);
        return redirect()->route('admin.categories.edit',$category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->subcategories()->exists()) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Ups!',
                'text' => 'No se puede eliminar esta categoría  por que tiene subcategorías asociadas.',
            ]);
            return redirect()->route('admin.categories.edit',$category);
        }
//        dd($category);
        $category->delete();
        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Bien hecho!',
            'text' => 'Categoría eliminada correctamente',
        ]);
        return redirect()->route('admin.categories.index');
    }
}
