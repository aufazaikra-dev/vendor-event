<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class PublicLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        // Ini akan memanggil file resources/views/layouts/public.blade.php yang tadi kita buat
        return view('layouts.public');
    }
}
