<?php

namespace App\Http\Livewire\Users\Org;

use App\Enum\PageModeEnum;
use App\Models\Product as ModelsProduct;
use Livewire\Component;

class Product extends Component
{
    /**
     * Parent
     */
    public $mode, $product;


    /**
     * Form Fields
     */
    public $name, $scope, $lesson_type, $price = 0, $description;

    public function mount()
    {

        if ($this->mode == PageModeEnum::EDIT) {
            $this->name = $this->product->name;
            $this->scope = $this->product->scope;
            $this->lesson_type = $this->product->lesson_type;
            $this->price = $this->product->price;
            $this->description = $this->product->description;
        }

    }

    public function render()
    {
        return view('livewire.users.org.product');
    }

    public function store()
    {
        $this->validate([
            'name' => ['required'],
            'scope' => ['required'],
            'lesson_type' => ['required'],
            'price' => ['numeric'],
            'description' => ['nullable'],
        ]);

        ModelsProduct::create([
            'name' => $this->name,
            'scope' => $this->scope,
            'lesson_type' => $this->lesson_type,
            'price' => $this->price,
            'description' => $this->description,
        ]);

        return redirect()->route('organization.product.index');
    }

    public function edit()
    {
        $this->validate([
            'name' => ['required'],
            'scope' => ['required'],
            'lesson_type' => ['required'],
            'price' => ['numeric'],
            'description' => ['nullable'],
        ]);

        $this->product->update([
            'name' => $this->name,
            'scope' => $this->scope,
            'lesson_type' => $this->lesson_type,
            'price' => $this->price,
            'description' => $this->description,
        ]);

        return redirect()->route('organization.product.index');
    }
}
