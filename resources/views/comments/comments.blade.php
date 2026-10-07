<div class="mt-6">
    <h3 class="text-xl font-bold main-color mb-2">Commentaires</h3>
    @foreach($comments as $comment)
        <div class="border p-2 rounded mb-2 flex justify-between">
            <div>
                <strong class="main-color">{{ $comment->user->name }}</strong>: {{ $comment->content }}
            </div>
            @if(auth()->id() === $comment->user_id)
                <form method="POST" action="{{ route('comments.destroy', $comment->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-main text-white px-2 py-1 rounded">Supprimer</button>
                </form>
            @endif
        </div>
    @endforeach
</div>
