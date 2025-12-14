<?php

namespace App\View\Components\ecommerce;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EcommerceMetrics extends Component
{
    public function __construct(
        // public ?string $args1 = null,
        // public ?int $data1 = null,
        // public ?string $args2 = null,
        // public ?int $data2 = null,
    ) {
        //
    }

    public function render(): View|Closure|string
    {
        return view('components.ecommerce.ecommerce-metrics');
    }
}
