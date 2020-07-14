@extends('welcome')

@section('content')
    <div class="bg-blue-400 p-4 mt-5 h-auto shadow rounded">
        <p class="flex justify-center text-white" style="font-size: 14pt;">Create new section</p>
        @error('name')
            <div class="alert alert-danger flex justify-center w-25 m-auto">{{ $message }}</div>
        @enderror
        <form action="/section" method="post" class="flex justify-center mt-2">
            @csrf

            <input type="text" class="p-2 ml-2 shadow rounded" name='name' placeholder="Section Name">

            <input type="submit" class="p-2 w-1/12 ml-2 shadow rounded bg-blue-400 text-white" value="Create">

        </form>

        <br>
        <p class="flex justify-center text-white" style="font-size: 14pt;">Select your section</p>

        <div class="flex flex-wrap text-center">
        @foreach ($sections as $section)
            <div class="bg-blue-200 shadow rounded p-3 m-2">
                {{ $section->name }}
                <form method="post" action="/section/{{ $section->id }}">
                    @method('DELETE')
                    @csrf

                    <input class="p-1 shadow rounded bg-red-500 text-white" type="submit" value="Delete">

                    <a class="p-1 shadow rounded bg-orange-500 text-white" href="/section/{{ $section->id }}">Show</a>
                </form>
            </div>

        @endforeach
        </div>

    </div>
@endsection
