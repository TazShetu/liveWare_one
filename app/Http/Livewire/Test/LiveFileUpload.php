<?php

namespace App\Http\Livewire\Test;

use App\Models\Comment;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class LiveFileUpload extends Component
{
    // ******* CAN NOT PAGINATION FROM mount() **********

    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $inputTitle;
    public $inputBody;
    public $inputImage;
    public $postId;


    // An event has to be emitted
    //  Event can be emitted from anywhere (any components or components view or global js)
    // (here postSelected event emitted from Post component view)
    protected $listeners = ['postSelected' => 'postSelectedMethod'];


    public function postSelectedMethod($pid)
    {
        $this->postId = $pid;
    }



    public function updatedInputImage()
    {
        $this->validate([
            'inputImage' => 'image|max:1024',
        ]);
    }


    public function addComment()
    {
        $this->validate([
            'postId' => 'required',
            'inputTitle' => 'required|string|min:1|max:191',
            'inputBody' => 'required|string|max:500',
            'inputImage' => 'nullable|image|max:1024',
        ]);
        $comment = new Comment;
        $comment->post_id = $this->postId;
        $comment->title = $this->inputTitle;
        $comment->body = $this->inputBody;
        $comment->creator = "John Doe";
        // file upload start
        if ($this->inputImage) {
            // liveware auto gives hash name to file
            $path = $this->inputImage->store('commentImages', 'public_uploads_images');
            $comment->image = 'uploads/' . $path;
            // this 'uploads/' is from the disk public_uploads_images path
        }
        // file upload end
        $comment->save();
        session()->flash('success', 'Comment successfully created.');
        $this->inputTitle = '';
        $this->inputBody = '';
        $this->inputImage = null;
    }


    public function deleteComment($cid)
    {
        $c = Comment::findOrFail($cid);
        if (file_exists($c->image)) {
            unlink($c->image);
        }
        $c->delete();
        session()->flash('success', 'Comment successfully deleted.');
    }


    public function render()
    {
        $comments = Comment::where('post_id', $this->postId)->orderBy('id', 'DESC')->paginate(2);
        return view('livewire.test.live-file-upload', compact('comments'));
    }


}
