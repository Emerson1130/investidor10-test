<x-app-layout>
    <div class="container mx-auto px-4">
        @include('components.errors')
        @yield('crud-content')
    </div>
</x-app-layout>