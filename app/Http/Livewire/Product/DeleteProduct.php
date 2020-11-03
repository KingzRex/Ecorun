<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DeleteProduct extends Component
{
    public Product $product;
    public $confirm;

    public function delete()
    {
        $enterprise = $this->product->enterprise;

        $this->product->attributes()->delete();

        foreach ($this->product->gallery as $image) {
            Storage::disk('public')->delete($image->image_url);
        }

        $this->product->gallery()->delete();

        $this->product->forceDelete();

        redirect()->to("/my-bss/{$enterprise->data_slug('name')}/+id={$enterprise->id}/products");
    }

    public function confirmDeleteProduct()
    {
        $this->confirm = true;
    }

    public function render()
    {
        return view('livewire.product.delete-product');
    }
}
