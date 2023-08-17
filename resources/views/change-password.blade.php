@extends('layouts.app')
@section('title','CHANGE PASSWORD')
@section('content')
    <div class="h-screen w-screen flex flex-col items-center justify-center">
        <nav class="absolute w-screen top-0 left-0 z-[99] bg-blue-500 h-14">
            <div class="flex flex-row-reverse h-full">
                <form method="POST" action="{{ route('logout') }}" class="w-36 h-full p-2.5">
                    @csrf
                    <input type="submit" value="LOG OUT" class="bg-white text-blue-600 w-full h-full rounded-xl hover:scale-105 shadow-lg font-black tracking-wider flex justify-center items-center cursor-pointer">
                </form>
            </div>
        </nav>
        @error('error')
            <div class="w-96 flex p-4 mb-5 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Error</span>
                <div>
                    <span class="font-medium">{{ $message }}</span>
                </div>
            </div>
        @enderror
        <h1 class="font-bold text-3xl mb-1">CHANGE PASSWORD</h1>
        <div class="w-96 border-l-8 border-blue-600 p-4 bg-blue-200 mb-4">
            <h1 class="text-sm">You are required to change your password before you login for the first time.</h1>
            <p class="mt-3 text-sm">Note: Password must be at least <span class="text-pink-600 font-semibold text-base">8</span> characters.</p>
        </div>
        <form class="border w-96 p-10 rounded-xl shadow-lg bg-gray-100" method="POST" action="{{ route('password.update') }}">
            @csrf
            <div class="mb-6">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">New Password</label>
                <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required autocomplete="off">
            </div>
            <div class="mb-6">
                <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required autocomplete="off">
            </div>
            <button type="submit" class="focus:outline-none text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 rounded-lg text-sm px-5 py-2.5 w-full tracking-wider font-semibold shadow-lg mb-2">UPDATE</button>
        </form>
    </div>
@endsection