<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="text-gray-900">
                    @include('components.informational-message')
                    @include('components.errors')

                    @if($posts->count() > 0)
                    <div class="grid grid-cols-3 gap-3 mt-2">
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
                            <p>No record registered so far, register now :)</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
