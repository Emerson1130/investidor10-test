@if ($message = session('message'))
    <div class="bg-blue-100 border border-blue-500 text-blue-700 px-4 py-3" role="alert">
        <p class="font-bold">Informational message</p>
        <p class="text-sm">{{ $message }}</p>
    </div>
@endif