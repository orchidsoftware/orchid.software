<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Http;
use Illuminate\View\Component;

class Backers extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $backers = Http::get('https://opencollective.com/orchid/members/all.json')->json();

        $backers = collect($backers)->unique(function (array $item) {
            return $item['profile'];
        });

        return view('components.backers', [
            'backers' => $backers
        ]);
    }
}
