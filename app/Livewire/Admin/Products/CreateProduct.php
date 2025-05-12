<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Family;
use App\Models\Product;
use App\Models\Subcategory;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateProduct extends Component
{
    use WithFileUploads;

    //imagen subida desde el input
    public $image;
    public $name;
    public $description;
    public $sku;
    public $price;

    // Select de familias para el view
    public $families = [];


    public $selectedFamilyId = null;
    public $selectedCategoryId = null;
    public $selectedSubcategoryId = null;


    public function mount()
    {
        $this->families = Family::all();
    }

    public function boot()
    {
        $this->withValidator(function ($validator) {
            if ($validator->fails()) {
                $this->dispatch('swal', [
                    'icon' => 'error',
                    'title' => 'Ups!',
                    'text' => 'Error al crear producto.',
                ]);
//               dd($validator->getMessageBag());
            }
        });
    }

    public function updatedSelectedFamilyId()
    {
        $this->selectedCategoryId = '';
    }

    public function updatedSelectedCategoryId()
    {
        $this->selectedSubcategoryId = '';
    }

    #[Computed]
    public function categories()
    {
        if (!$this->selectedFamilyId) {
            return [];
        }
        return Category::where('family_id', $this->selectedFamilyId)->get();
    }

    #[Computed]
    public function subcategories()
    {
        if (!$this->selectedCategoryId) {
            return [];
        }
        return Subcategory::where('category_id', $this->selectedCategoryId)->get();
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|integer|min:1|unique:products,sku',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'required|image|max:2048', // 2MB máximo
            'selectedFamilyId' => 'required|exists:families,id',
            'selectedCategoryId' => 'required|exists:categories,id',
            'selectedSubcategoryId' => 'required|exists:subcategories,id',
        ]);
        $imagePath = $this->image->store('products', 'public');
        $product = Product::create([
            'sku' => $this->sku,
            'name' => $this->name,
            'description' => $this->description,
            'image_path' => $imagePath,
            'price' => $this->price,
            'subcategory_id' => $this->selectedSubcategoryId,
        ]);
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien hecho!',
            'text' => 'El producto ha sido creado correctamente.',
        ]);
        return redirect()->route('admin.products.index');

    }

    protected function messages()
    {
        return [
            'name.required' => 'Ingresa un nombre para el producto.',
            'sku.required' => 'Ingresa un código de referencia (SKU) para el producto.',
            'price.required' => 'Establece un precio para el producto.',
            'description.required' => 'Añade una descripción del producto.',
            'image.required' => 'Sube una imagen del producto.',
            'selectedFamilyId.required' => 'Selecciona una familia de productos.',
            'selectedCategoryId.required' => 'Elige una categoría para el producto.',
            'selectedSubcategoryId.required' => 'Selecciona una subcategoría.'
        ];
    }


    public function render()
    {
        return view('livewire.admin.products.create-product');
    }
}
