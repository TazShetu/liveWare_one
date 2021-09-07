{{-- ****************  Has to be a single section / div  ****************  --}}
<section>
    <div class="container m-5">
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form class="row g-3" wire:submit.prevent="addComment">
            <div class="col-md-2">
                <label for="inputComment" class="visually-hidden">Title</label>
                <input type="text" class="form-control @error('inputTitle') is-invalid @enderror" id="inputComment"
                       placeholder="Title"
                       wire:model.defer="inputTitle">
                @error('inputTitle')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
            <div class="col-md-8">
                <label for="inputComment" class="visually-hidden">Comment</label>
                <input type="text" class="form-control @error('inputBody') is-invalid @enderror" id="inputComment"
                       placeholder="What's on your mind ?"
                       wire:model.defer="inputBody">
                @error('inputBody')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Add</button>
            </div>
        </form>
    </div>
    <div class="row m-5">
        @forelse($comments as $i => $c)
            <div class="row m-4">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <p>#{{$comments->firstItem() + $i}}</p>
                            <h5 class="card-title">
                                {{$c->title}}
                            </h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                {{$c->created_at->diffForHumans()}}
                            </h6>
                            <p class="card-text">
                                {{$c->body}}
                            </p>
                            <button class="pull-right btn btn-danger btn-sm mb-3"
                                    onclick="confirm('Are you sure ?') || event.stopImmediatePropagation()"
                                    wire:click="deleteComment({{$c->id}})">
                                &#10006;
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
        @endforelse
        <div class="py-3">
            <span class="text-muted">
                Displaying {{$comments->firstItem()}} ~ {{$comments->lastItem()}} of {{$comments->total()}} Comments
            </span>
        </div>
        <div>
            {{ $comments->links() }}
        </div>
    </div>
</section>






