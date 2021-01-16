<?php

namespace App\Http\Livewire\BuildAndManage\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class DeleteProduct extends Component
{
    public Product $product;
    public $confirm;

    public function delete()
    {
        $business = $this->product->business;

        $this->product->specifications()->delete();

        foreach ($this->product->gallery as $image) {
            Storage::disk('public')->delete($image->image_url);
        }

        $this->product->gallery()->delete();

        $this->product->forceDelete();

        redirect()->to(Auth::user()->profile->full_tag()."/{$business->profile->full_tag()}/products");
    }

    public function confirmDeleteProduct()
    {
        $this->confirm = true;
    }

    public function render()
    {
        return view('livewire.build-and-manage.product.delete-product');
    }
}
