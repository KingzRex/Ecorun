<?php

namespace App\Http\Livewire\BuildAndManage\Business;

use App\Models\Business;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class BusinessProductList extends Component
{
    use WithPagination;

    public Business $business;
    public $active_product;

    protected $listeners = [
        'viewAll'
    ];

    public function mount($active_product = null)
    {
        return ($active_product) ?  $this->switchActiveProduct($active_product) : true;
    }

    public function switchActiveProduct($product)
    {
        return $this->active_product = Product::findOrFail($product);
    }

    public function viewAll()
    {
        $this->active_product = null;
    }

    public function render()
    {
        $products = Auth::user()->isManager->businesses->find($this->business)->products()->latest()->paginate(12);
        $empty = $products->count() < 0;

        return view(
            'livewire.build-and-manage.business.business-product-list',
            compact('products', 'empty')
        )->layout('layouts.business');
    }
}
