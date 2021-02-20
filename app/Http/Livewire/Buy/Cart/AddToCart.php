<?php

namespace App\Http\Livewire\Buy\Cart;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class AddToCart extends Component
{
    public $product;
    public $add_specs;
    public $specifications = [];
    public $quantity;
    public $available_stock;
    public $indicated_specs;
    public $specification_count;
    public $user;
    protected $listeners = [
        'receiveCartItem'
    ];

    public function rules(): array
    {
        return [
            'quantity' => [
                'required',
                'min:1',
                "max:{$this->available_stock}",
                'int'
            ],
        ];
    }

    public function receiveCartItem(Product $product) {
        $this->add_specs = true;
        $this->product = $product->loadMissing('specifications');
        $this->quantity = 1;
        $this->indicated_specs = $this->product->specifications->filter(
            function ($specification) {
                return $specification->is_specific === true;
            }
        );
        $this->available_stock = $this->product->available_stock;
        $this->specification_count = $this->indicated_specs->count();
        if ($this->specification_count > 0) {
            foreach ($this->indicated_specs as $spec) {
                $this->specifications[Str::singular($spec->name)] = null;
            }
        }
        if (Auth::check()) {
            $this->user = Auth::user()->loadMissing('cart');
        }
    }

    public function add_prod() {
        $this->validate($this->rules());
        ($this->user) ?
        $this->product->cart_instances()->save(
            $this->user->cart()->create(
                [
                    'quantity' => $this->quantity
                ]
            )
        ) :
        session()->put(
            "guest_cart.{$this->product->id}",
            [
                'product_id' => $this->product->id,
                'quantity' => $this->quantity
            ]
        );
        $this->add_specs = false;
        return $this->emit('modifiedCart');
    }

    public function messages() {
        return [
            'specifications.*.required' => 'This value is required'
        ];
    }

    public function add_specs_prod() {
        $this->validate(
            [
                'quantity' => ['required', 'min:1', 'int', "max:{$this->available_stock}"],
                'specifications.*' => ['required']
            ]
        );

        ($this->user) ?
        $this->product->cart_instances()->save(
            $this->user->cart()->create([
                'quantity' => $this->quantity,
                'specifications' => $this->specifications
            ])
        ) :
        session()->put(
            "guest_cart.{$this->product->id}",
            [
                'product_id' => $this->product->id,
                'quantity' => $this->quantity,
                'specifications' => $this->specifications
            ]
        );
        $this->add_specs = false;
        return $this->emit('modifiedCart');
    }

    public function updated($propertyName) {
        $this->validateOnly($propertyName, $this->rules());
    }

    public function render() {
        return view('livewire.buy.cart.add-to-cart');
    }
}