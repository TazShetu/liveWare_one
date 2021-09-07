<?php

namespace App\Http\Livewire\Test;

use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class LiveCommentPagination extends Component
{

    // ******* CAN NOT PAGINATION FROM mount() **********

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $inputTitle;
    public $inputBody;


    public function addComment()
    {
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
        $this->inputTitle = '';
        $this->inputBody = '';
    }


    public function deleteComment($cid)
    {
        $c = Comment::findOrFail($cid);
        $c->delete();
        session()->flash('success', 'Comment successfully deleted.');
    }


    public function render()
    {
        // *** MUST PASS PAGINATION IN render()
            // downside is it will always call DB whenever this component is called
        $comments = Comment::orderBy('id', 'DESC')->paginate(2);
        // make sure there is no public/private variable $comments
        return view('livewire.test.live-comment-pagination', compact('comments'));
    }
}
