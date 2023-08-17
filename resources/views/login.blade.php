@extends('layouts.app')
@section('title','LOGIN')
@section('content')
    <div class="h-full w-full overflow-hidden flex flex-col items-center justify-center">
        @error('error')
            <div class="flex w-72 sm:w-96 p-4 mb-5 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Error</span>
                <div>
                    <span class="font-medium">{{ $message }}</span>
                </div>
            </div>
        @enderror
        <h1 class="py-5 text-xl font-bold">PARTS REQUEST EVALUATION</h1>
        <form class="border w-80 sm:w-96 p-10 rounded-xl shadow-lg bg-gray-100" method="POST" action="{{ route('login.auth') }}">
            @csrf
            <div class="mb-6">
            <label for="id_number" class="block mb-2 text-sm font-medium text-gray-900">ID Number</label>
            <input type="text" id="id_number" name="id_number" value="{{ old('id_number') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required autocomplete="off">
            </div>
            <div class="mb-6">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
            <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required autocomplete="off">
            </div>
            <button type="submit" class="focus:outline-none text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 rounded-lg text-sm px-5 py-2.5 w-full tracking-wider font-semibold shadow-lg mb-2">LOGIN</button>
        </form>
    </div>
@endsection