<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Family;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProduct extends Component
{
    use WithFileUploads;

    // El producto actual completo (para referencia y acceso a la imagen actual)
    public $product;

    public $families = [];

    // Datos editables (new)
    public $name;
    public $description;
    public $sku;
    public $price;
    public $newImage; // Para una nueva imagen subida

    public $selectedFamilyId = null;
    public $selectedCategoryId = null;
    public $selectedSubcategoryId = null;

    public function mount(Product $product)
    {
        // Guardar referencia al producto original
        $this->product = $product;
        // Inicializar los campos editables con los valores actuales
        $this->name = $this->product->name;
        $this->description = $this->product->description;
        $this->sku = $this->product->sku;
        $this->price = $this->product->price;
        $this->selectedFamilyId = $product->subcategory->category->family_id;
        $this->families = Family::all();
        $this->selectedCategoryId = $product->subcategory->category_id;
        $this->selectedSubcategoryId = $product->subcategory_id;
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
        $this->selectedCategoryId = null;
    }

    public function updatedSelectedCategoryId()
    {
        $this->selectedSubcategoryId = null;
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

    public function update()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'sku' => 'required|integer|min:1|unique:products,sku,' . $this->product->id,
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'selectedFamilyId' => 'required|exists:families,id',
            'selectedCategoryId' => 'required|exists:categories,id',
            'selectedSubcategoryId' => 'required|exists:subcategories,id',
        ];
        if ($this->newImage) {
            $rules['newImage'] = 'image|max:2048';
        }
        $this->validate($rules);
        $data = $this->only(['name', 'sku', 'price', 'description']);

        // Agregar el ID de subcategoría manualmente (porque no coincide con el nombre de la propiedad)
        $data['subcategory_id'] = $this->selectedSubcategoryId;

        if ($this->newImage) {
            // Eliminar la imagen anterior si existe
            if ($this->product->image_path && Storage::disk('public')->exists($this->product->image_path)) {
                Storage::disk('public')->delete($this->product->image_path);
            }
            // Guardar la nueva imagen y añadir la ruta a los datos
            $data['image_path'] = $this->newImage->store('products', 'public');
        }

        $this->product->update($data);
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien hecho!',
            'text' => 'Producto actualizado correctamente.',
        ]);
        return redirect()->route('admin.products.index');

    }

    protected function messages()
    {
        return [
            'name.required' => 'Ingresa un nombre para el producto.',
            'sku.required' => 'Ingresa un SKU para el producto.',
            'sku.unique' => 'Este SKU ya está en uso.',
            'price.required' => 'Establece un precio para el producto.',
            'description.required' => 'Añade una descripción del producto.',
            'newImage.image' => 'El archivo debe ser una imagen.',
            'selectedFamilyId.required' => 'Selecciona una familia.',
            'selectedCategoryId.required' => 'Selecciona una categoría.',
            'selectedSubcategoryId.required' => 'Selecciona una subcategoría.'
        ];
    }

    public function render()
    {
        return view('livewire.admin.products.edit-product');
    }
}
