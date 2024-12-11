<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.front')]

class ShowAbout extends Component
{
    public function render()
    {
        return view('livewire.pages.show-about');
    }
}