<?php

namespace App\Livewire\Admin\Subcategories;

use App\Models\Category;
use App\Models\Family;
use App\Models\Subcategory;
use Livewire\Component;

class CreateSubcategory extends Component
{
//  Varibales de formulario
    public $name='';
    public $selectedFamilyId = null;
    public $selectedCategoryId = null;

//  Colecciones de los Selects
    public $families = [];
    public $categories = [];

    public function mount()
    {
        $this->families = Family::all();
    }

    public function updatedSelectedFamilyId($id)
    {
        if (!is_null($id) && $id !== ''){
            $this->categories = Category::where('family_id', $id)->get();
        } else
        {
            $this->categories = [];
        }
        $this->selectedCategoryId = "";
    }

    public function store(){
        $this->validate([
            'name' => 'required|string',
            'selectedFamilyId' => 'required|exists:families,id',
            'selectedCategoryId' => 'required|exists:categories,id',
        ]);
        Subcategory::create([
            'name' => $this->name,
            'category_id' => $this->selectedCategoryId,
//            'selectedFamilyId' => $this->selectedFamilyId,
        ]);
        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Bien hecho!',
            'Texto' => 'Subcategoría creada correctamente.',
        ]);
        return redirect()->route('admin.subcategories.index');
    }

    public function render()
    {
        return view('livewire.admin.subcategories.create-subcategory');
    }
}
