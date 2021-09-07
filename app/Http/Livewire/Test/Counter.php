<?php

namespace App\Http\Livewire\Test;

use Livewire\Component;

class Counter extends Component
{

    // Public properties are available in the Liveware view of this component
    public $count = 1;


    public function increase()
    {
        $this->count++;
    }


    public function decrease()
    {
        $this->count--;
    }


    public function render()
    {
        return view('livewire.test.counter');
    }
}
