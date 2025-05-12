<?php

namespace App\Livewire\Admin\Subcategories;

use App\Models\Category;

use App\Models\Family;
use App\Models\Subcategory;
use Livewire\Attributes\Computed;
use Livewire\Component;

class UpdateSubcategory extends Component
{
    // Subcategoría que se está editando
    public $subcategory;

    // Nombre de la subcategoría
    public $name;

    // Colección de familias y categorias para el select
    public $families = [];

    // public $categories = []; usaremos propiedades computadas

    // ID de la familia y categoria seleccionada
    public $selectedFamilyId = null;
    public $selectedCategoryId = null;


    public function mount(Subcategory $subcategory)
    {
        // Guardamos la subcategoría completa en una propiedad para poder usarla después
        // (por ejemplo, para acceder a otros atributos o relaciones)
        $this->subcategory = $subcategory;

        // Asignamos el nombre de la subcategoría a la propiedad $name
        // Esta propiedad estará vinculada al input en la vista mediante wire:model="name"
        $this->name = $subcategory->name;

        // Cargamos todas las familias disponibles para mostrarlas en el select
        $this->families = Family::all();

        // Establecemos cuál es la familia que debe estar seleccionada inicialmente
        // Es decir: "selecciona la familia a la que pertenece la categoría de esta subcategoría"
        $this->selectedFamilyId = $subcategory->category->family_id;

        // Ya no necesitas cargar las categorías inicialmente
        // $this->categories = Category::where('family_id', $this->selectedFamilyId)->get();


        // Cargamos las categorías que pertenecen a la familia seleccionada
        $this->selectedCategoryId = $subcategory->category_id;
    }

    public function updatedSelectedFamilyId($value)
    {
        // No necesitas actualizar las categorías manualmente

        // Cargamos las categorías que pertenecen a la familia seleccionada
        // if (!is_null($value) && $value !== '') {
        //     $this->categories = Category::where('family_id', $value)->get();
        // } else {
        //     $this->categories = [];
        // }

        // Reseteamos la categoría seleccionada cuando cambia la familia
        $this->selectedCategoryId = "";
    }

    #[Computed]
    public function categories()
    {
        if(!$this->selectedFamilyId){
            return [];
        }
        return  Category::where('family_id', $this->selectedFamilyId)->get();
    }



    public function update(){
        $validatedData = $this->validate([
            'name' => 'required|string',
            'selectedFamilyId' => 'required|exists:families,id',
            'selectedCategoryId' => 'required|exists:categories,id',
        ]);
        $this->subcategory->update([
            'name' => $this->name,
            'category_id' => $this->selectedCategoryId,
        ]);
        session()->flash('swal',[
            'icon' => 'success',
            'title' =>  'Bien hecho!',
            'text' => 'Subcategoría actualizada correctamente.'
        ]);
        return redirect()->route('admin.subcategories.index');
    }


    public function render()
    {
        return view('livewire.admin.subcategories.update-subcategory');
    }
}
