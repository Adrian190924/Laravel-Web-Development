<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ProductCard extends Component {
    public $product;
    public function __construct($product) {
        $this->product = $product;
    }

    public function render(): View|Closure|string {
        return view('components.product-card');
    }
}
