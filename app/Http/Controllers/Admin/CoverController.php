<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cover;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function _PHPStan_781aefaf6\React\Promise\all;

class CoverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $covers = Cover::orderBy('order')->get();
        return view('admin.covers.index', compact('covers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.covers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required',
            'start_at' => 'required|date',
            'end_at' => 'nullable|date|after:start_at',
            'is_active' => 'required|boolean',
        ]);

        $data['image_path'] = Storage::put('covers', $data['image']);
        $cover = Cover::create($data);

        session()->flash('swal',[
            'icon'=>'success',
            'title'=>'Bien hecho!',
            'text'=>'El cover se ha creado correctamente.',
        ]);

        return redirect()->route('admin.covers.edit', $cover);

    }

    /**
     * Display the specified resource.
     */
    public function show(Cover $cover)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cover $cover)
    {
        return view('admin.covers.edit', compact('cover'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cover $cover)
    {
        $data = $request->validate([
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required',
            'start_at' => 'required|date',
            'end_at' => 'nullable|date|after:start_at',
            'is_active' => 'required|boolean',
        ]);

        if(isset($data['image'])){
            Storage::delete($cover->image_path);
            $data['image_path'] = Storage::put('covers', $data['image']);
        }
        $cover->update($data);
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien hecho!',
            'text' => 'El cover se ha actualizado correctamente.',
        ]);
        return redirect()->route('admin.covers.edit', $cover);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cover $cover)
    {
        //
    }
}
