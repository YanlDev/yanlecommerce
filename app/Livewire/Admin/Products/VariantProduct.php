<?php

namespace App\Livewire\Admin\Products;

use App\Models\Feature;
use App\Models\Option;
use App\Models\Variant;
use Livewire\Attributes\Computed;
use Livewire\Component;

class VariantProduct extends Component
{
    public $product;
    public $variant = [
        'option_id' => '',
        'features' => [
            [
                'id' => '',
                'value' => '',
                'description' => '',
            ]
        ]
    ];
    public $openModal = false;
    public $options;


    public function mount()
    {
        $this->options = Option::all();
    }

    //    Resetear campos
    public function updatedVariantOptionId()
    {
        $this->variant['features'] = [
            [
                'id' => '',
                'value' => '',
                'description' => '',
            ]
        ];
    }

    #[Computed]
    public function features()
    {
        return Feature::where('option_id', $this->variant['option_id'])->get();
    }

    public function addFeature()
    {
        $this->variant['features'][] = [
            'id' => '',
            'value' => '',
            'description' => '',
        ];

    }


    public function deleteFeature($index)
    {
        unset($this->variant['features'][$index]);
        $this->variant['features'] = array_values($this->variant['features']);
    }


    public function featureChange($index)
    {
        $feature = Feature::find($this->variant['features'][$index]['id']);
        if ($feature) {
            $this->variant['features'][$index]['value'] = $feature->value;
            $this->variant['features'][$index]['description'] = $feature->description;
        }
    }

    public function deleteOption($option_id)
    {
        $this->product->options()->detach($option_id);
        $this->product = $this->product->fresh();
        $this->generateVariants();
    }

    public function removeFeature($option_id, $feature_id)
    {
        // Obtener el registro de la relación pivot
        $pivotRelation = $this->product->options();
        $pivotRecord = $pivotRelation->find($option_id)->pivot;

        // Asegurarte de que features es un array
        $features = $pivotRecord->features;

        // Filtrar el array y reiniciar los índices
        $filteredFeatures = array_values(array_filter($features, function ($feature) use ($feature_id) {
            return $feature['id'] != $feature_id;
        }));

        // Actualizar el pivot con el nuevo array
        $pivotRelation->updateExistingPivot($option_id, [
            'features' => $filteredFeatures
        ]);
        $this->generateVariants();
    }


    public function generateVariants()
    {
        $features = $this->product->options->pluck('pivot.features');
        $combinations = $this->generateCombinations($features);
        $this->product->variants()->delete();
        foreach ($combinations as $combination) {
            $variant = Variant::create([
                'product_id' => $this->product->id,
            ]);
            $variant->features()->attach($combination);
        }
        $this->dispatch('variant-generate');
    }

    public function generateCombinations($arrays, $index = 0, $combination = [])
    {
        if ($index == count($arrays)) {
            return [$combination];
        }
        $result = [];
        foreach ($arrays[$index] as $item) {
            $temporalyCombination = $combination;
            $temporalyCombination[] = $item['id'];
            $result = array_merge($result, $this->generateCombinations($arrays, $index + 1, $temporalyCombination));
        }
        return $result;
    }
    public function save()
    {
        $this->validate([
            'variant.option_id' => 'required',
            'variant.features.*.id' => 'required',
            'variant.features.*.value' => 'required',
            'variant.features.*.description' => 'required',
        ]);
        $this->product->options()->attach($this->variant['option_id'], ['features' => $this->variant['features']]);

        $this->generateVariants();

        $this->reset(['variant', 'openModal']);

    }

    public function render()
    {
        return view('livewire.admin.products.variant-product');
    }
}
