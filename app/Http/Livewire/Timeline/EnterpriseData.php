<?php

namespace App\Http\Livewire\Timeline;

use Livewire\Component;

class EnterpriseData extends Component
{
    public  $enterprise;
    public $active_view;
    public $views = [
        'products' => [
            'title' => 'products',
            'icon' => 'fas fa-shopping-bag',
        ],

        'posts' => [
            'title' => 'posts',
            'icon' => 'fas fa-user-edit'
        ],

        'gallery' => [
            'title' => 'gallery',
            'icon' => 'fas fa-images'
        ]
    ];

    public function mount($active_view = null)
    {
        if ($active_view) {
            if (array_key_exists($active_view, $this->views)) {
                $this->switchView($active_view);
            } else {
                $this->defaultView();
            }
        } else {
            $this->defaultView();
        }
    }

    public function switchView($view_key)
    {
        return $this->active_view = $this->views[$view_key];
    }

    public function defaultView()
    {
        return $this->switchView('products');
    }

    public function render()
    {
        return view('livewire.timeline.enterprise-data');
    }
}
