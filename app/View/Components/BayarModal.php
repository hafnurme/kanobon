<?php

namespace App\View\Components;

use App\Models\Order;
use Illuminate\View\Component;

class BayarModal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return response(view('components.bayar-modal')->with('penjualan', Order::all()));
    }
}
