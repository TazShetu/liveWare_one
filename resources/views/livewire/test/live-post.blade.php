<section>
    @foreach($posts as $post)
    <div class="row my-5" wire:click="$emit('postSelected', {{$post->id}})">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>{{$post->title}}</h4>
                </div>
                <div class="card-body {{$activeId == $post->id ? 'bg-info' : ''}}">
                    <p>{{$post->body}}</p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</section>
