@extends('welcome')

@section('content')
    <div class="bg-blue-400 p-4 mt-5 h-auto shadow rounded">
        <p><a class="text-white" href="/">Back to Index Page</a></p>
        <p class="flex justify-center text-white" style="font-size: 14pt;">Current Section: {{ $section->name }}</p>
        @error('name')
        <div class="alert alert-danger flex justify-center w-25 m-auto">{{ $message }}</div>
        @enderror
        <form action="/todo" method="post" class="flex justify-center mt-2">
            @csrf

            <input type="text" class="p-2 ml-2 shadow rounded" name='name' placeholder="Todo Name">
            <input type="hidden" name="section_id" value="{{ $section->id }}">

            <input type="submit" class="p-2 w-1/12 ml-2 shadow rounded bg-blue-400 text-white" value="Add">

        </form>

        @foreach($todos as $todo)
            <div class="bg-blue-200 shadow rounded p-3 m-2">
                {{ $todo->name }}
                <form method="post" action="/todo/{{ $todo->id }}/ready">
                    @method('PUT')
                    @csrf

                    <input
                        class="p-1 shadow rounded @if($todo->ready) bg-green-500 @else bg-orange-500 @endif text-white"
                        type="submit"
                        value="@if($todo->ready)Mark as unready @else Mark as ready @endif"
                    >
                    <input class="p-1 shadow rounded bg-red-500 text-white" type="submit" value="Delete">


                </form>
            </div>
        @endforeach
    </div>
@endsection
