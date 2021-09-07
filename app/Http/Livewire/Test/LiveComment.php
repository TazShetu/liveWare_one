<?php

namespace App\Http\Livewire\Test;

use App\Models\Comment;
use Livewire\Component;

class LiveComment extends Component
{

    public $comments;
    public $inputTitle;
    public $inputBody;

//    public $test;

    public function mount($initialComments)
    {
//        $initialComments = App\Models\Comment::orderBy('id', 'DESC')->get();
        $this->comments = $initialComments;
//        $this->test = Comment::all();
    }


    // An event has to be emitted
//    protected $listeners = ['addComment' => 'refreshComments'];


    // $rules will be called with $this->validate();
//    protected $rules = [
//        'inputTitle' => 'required|string|min:1|max:191',
//        'inputBody' => 'required|string|max:500',
//    ];


    public function addComment()
    {
//        $this->validate();
        $this->validate([
            'inputTitle' => 'required|string|min:1|max:191',
            'inputBody' => 'required|string|max:500',
        ]);
        $comment = new Comment;
        $comment->title = $this->inputTitle;
        $comment->body = $this->inputBody;
        $comment->creator = "John Doe";
        $comment->save();
        session()->flash('success', 'Comment successfully created.');
        $this->comments->prepend($comment);
        $this->inputTitle = '';
        $this->inputBody = '';
    }


//    public function refreshComments()
//    {
//        $this->comments = Comment::orderBy('id', 'DESC')->get();
//    }


    public function deleteComment($cid)
    {
        $c = Comment::findOrFail($cid);
        $c->delete();
        session()->flash('success', 'Comment successfully deleted.');
        $this->comments = $this->comments->except($cid);
    }


    public function render()
    {
        return view('livewire.test.live-comment');
    }


}
