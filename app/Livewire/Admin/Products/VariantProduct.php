<?php

namespace App\Livewire\Admin\Products;

use App\Models\Feature;
use App\Models\Option;
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

    public function save()
    {
        $this->validate([
            'variant.option_id' => 'required',
            'variant.features.*.id' => 'required',
            'variant.features.*.value' => 'required',
            'variant.features.*.description' => 'required',
        ]);
        $this->product->options()->attach($this->variant['option_id'], ['features' => $this->variant['features']]);
        $this->reset(['variant', 'openModal']);

    }

    public function removeFeature($option_id, $feature_id)
    {
        $this->product->options()->updateExistingPivot($option_id, ['features' => array_filter($this->product->options()->find($option_id)->pivot->features, function ($feature) use ($feature_id) {
            return $feature['id'] != $feature_id;
        })]);
    }


    public function render()
    {
        return view('livewire.admin.products.variant-product');
    }
}
