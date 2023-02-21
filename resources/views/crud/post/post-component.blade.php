<div class="bg-white rounded overflow-hidden shadow-lg">
    <div class="px-6 py-4">
        <div class="font-bold text-xl mb-2">{{ $post->title }}</div>
        <p class="text-gray-700 text-base">
            {{ $post->body }}
        </p>
    </div>
    <div class="px-6 pt-4 pb-2">
        @if($post->belongsToUser($logged_user_id))
        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
            <a type="button" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full mb-2" href="{{ route('posts.preview', $post->id) }}">Preview</a>
            <a type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full mb-2" href="{{ route('posts.show', $post->id) }}">Show</a>

            @csrf
            @method('DELETE')

            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full mb-2">Delete</button>
        </form>
        @else
        <a type="button" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full mb-2" href="{{ route('posts.preview', $post->id) }}">Preview</a>
        @endif
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700"><b>Autor</b>: {{ $post->user->name }}</span>
    </div>
</div>