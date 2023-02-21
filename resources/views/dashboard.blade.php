<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @include('components.informational-message')
                    @include('components.errors')

                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Details</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>
                                @if($post->belongsToUser($logged_user_id))
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                        <a class="btn btn-primary" href="{{ route('posts.preview',$post->id) }}">Preview</a>
                                        <a class="btn btn-info" href="{{ route('posts.show',$post->id) }}">Show</a>

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                @else
                                    <a class="btn btn-primary" href="{{ route('posts.preview',$post->id) }}">Preview</a>           
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </table>

                    {!! $posts->links() !!}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
