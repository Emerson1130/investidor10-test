<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-blue-100 border border-blue-500 text-blue-700 px-4 py-3 mb-2" role="alert">
                <p class="text-sm"><b>Searched term</b>: "{{ $query }}"</p>
                <p class="text-sm"><b>Total results found</b>: {{ $posts->count() }}</p>
            </div>
            
            <div class="overflow-hidden">
                <div class="text-gray-900">
                    @if($posts->count() > 0)
                        <div class="grid grid-cols-3 gap-3">
                            @foreach ($posts as $post)
                                @include('crud.post.post-component', [
                                    'post' => $post,
                                    'logged_user_id' => $logged_user_id
                                ])
                            @endforeach
                        </div>
                        {!! $posts->links() !!}
                    @else
                        <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                            <p>No results found for this filter, sorry.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
