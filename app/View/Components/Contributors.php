<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Http;
use Illuminate\View\Component;

class Contributors extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $contributors = Http::withBasicAuth('token', config('services.github.token'))
            ->get('https://api.github.com/repos/orchidsoftware/platform/contributors', [
                'per_page' => 70,
            ])
            ->json();

        return view('components.contributors', [
            'contributors' => $contributors,
        ]);
    }
}
