<?php

namespace App\View\Components;

use Illuminate\View\View;
use Illuminate\View\Component;

class AppLayout extends Component
{
    public function __construct(
        public ?string $title = null,
        public ?string $description = null,
    ) {
    }

    public function title(): string
    {
        return $this->title ?
            sprintf('%s - %s', $this->title, config('app.name')) :
            config('app.name')
        ;
    }

    public function description(): string
    {
        return $this->description ?? config('eurovision.meta.defaults.description');
    }

    public function render(): View
    {
        return view('layouts.app');
    }
}
