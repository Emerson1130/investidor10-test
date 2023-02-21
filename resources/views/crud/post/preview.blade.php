<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @include('components.errors')

        @include('crud.post.post-component', [
            'post' => $post,
            'logged_user_id' => $logged_user_id,
            'visibilities' => [
                'preview' => false
            ]
        ])
    </div>
</x-app-layout>
