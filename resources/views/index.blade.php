@extends('welcome')

@section('content')
    <div class="bg-blue-400 w-full lg:w-2/6 float-left shadow rounded my-6 p-6">
        <p class="text-white text-center" style="font-size: 14pt;">Create new section</p>
        @error('name')
        <div class="alert alert-danger m-auto">{{ $message }}</div>
        @enderror
        <form action="/section" method="post" class="mt-2 flex justify-center">
            @csrf
            <input type="text" class="p-2 ml-2 shadow rounded" name='name' placeholder="Section Name">
            <input type="submit" class="p-2 ml-2 shadow rounded bg-blue-600 text-white" value="Create">
        </form>
    </div>
    <div class="d-block mx-auto">
        <div class="bg-blue-400 w-full lg:w-7/12 my-6 p-6 shadow rounded float-right ">
            <p class="text-center text-white" style="font-size: 14pt;">Select your section</p>
            <div class="flex flex-wrap text-center">
                @foreach ($sections as $section)
                    <div class="bg-blue-200 shadow rounded p-6 m-2">
                        <form method="post" action="/section/{{ $section->id }}">
                            <a class="mr-6" href="/section/{{ $section->id }}" style="font-size: 14pt;">{{ $section->name }}</a>

                            @method('DELETE')
                            @csrf
                            <input class="p-1 shadow rounded bg-red-500 text-white" type="submit" value="Delete">
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
