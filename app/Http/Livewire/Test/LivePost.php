<?php

namespace App\Http\Livewire\Test;

use App\Models\Post;
use Livewire\Component;

class LivePost extends Component
{

    public $posts;
    public $activeId;


    protected $listeners = ['postSelected' => 'postSelectedMethod'];


    public function postSelectedMethod($pid)
    {
        $this->activeId = $pid;
    }


    public function mount()
    {
        $this->posts = Post::all();
    }


    public function render()
    {
        return view('livewire.test.live-post');
    }
}
