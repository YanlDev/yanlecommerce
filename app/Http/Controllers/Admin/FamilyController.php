<?php

namespace App\Http\Controllers\Admin;

use App\Models\Family;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $families = Family::orderby('id', 'desc')->paginate(10);

        return view('admin.families.index', compact('families'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.families.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        Family::create($validatedData);
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien hecho!',
            'text' => 'Familia creada correctamente',
        ]);
        return redirect()->route('admin.families.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Family $family)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Family $family)
    {
        return view('admin.families.edit', compact('family'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Family $family)
    {
//        dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $family->update($validatedData);
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien hecho!',
            'text' => 'Familia actualizada correctamente',
        ]);
        return redirect()->route('admin.families.edit', $family);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Family $family)
    {
        if ($family->categories()->exists()) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Ups!',
                'text' => 'No se puede eliminar esta familia por que tiene categorías asociadas.',
            ]);
            return redirect()->route('admin.families.edit', $family);
        }

        $family->delete();
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien hecho!',
            'text' => 'Familia eliminada correctamente',
        ]);
        return redirect()->route('admin.families.index');
    }
}
