@extends('layouts.crud')

@section('crud-content')
<div class="container mx-auto px-4">
    <a href="{{ route('dashboard') }}" type="button" class="flaot-right bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
        Voltar
    </a>
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                Título
            </label>
            <input name="title" maxlength="255" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text">
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="body">
                Corpo
            </label>
            <textarea name="body" maxlength="255" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"></textarea>
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Salvar
        </button>
    </form>
</div>
@endsection