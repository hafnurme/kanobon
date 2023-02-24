<?php

namespace App\View\Components;

use Illuminate\View\Component;

class EditProdukDrawer extends Component
{
    public $produk;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($produk)
    {
        $this->produk  = $produk;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return response(view('components.edit-produk-drawer'));
    }
}
