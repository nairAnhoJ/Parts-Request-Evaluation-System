@extends('layouts.app')
@section('title','ADD USER')
@section('content')

    <div class="min-h-[calc(100%-56px)] w-full p-4 bg-gray-100">
        @if (session('error'))
            <div class="w-full flex justify-center">
                <div id="error" class="w-[500px] flex items-center p-4 text-red-800 border-t-4 border-red-400 bg-red-200" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <div class="ml-3 text-sm font-medium">
                        {{ session('error') }}
                    </div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"  data-dismiss-target="#error" aria-label="Close">
                        <span class="sr-only">Dismiss</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
            </div>
        @endif
        <div class="w-full">
            <div class="w-full mt-5 flex justify-center">
                <form action="{{ route('users.store') }}" method="POST" class="w-full sm:!w-[500px]">
                    @csrf
                    <div class="mb-4">
                        <label for="" class="text-gray-700 font-bold">ID Number <span class="text-red-500">*</span></label>
                        <input type="text" name="id" value="{{ old('id') }}" class="{{ old('id') == '' && session('error') ? 'border-red-500' : '' }} w-full lg:w-1/2 border-gray-300 rounded-lg shadow-inner" autocomplete="off">
                    </div>
                    <div class="mb-8">
                        <label for="" class="text-gray-700 font-bold">Full Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" class="{{ old('name') == '' && session('error') ? 'border-red-500' : '' }} w-full lg:w-1/2 border-gray-300 rounded-lg shadow-inner" autocomplete="off">
                    </div>
                    <div class="flex justify-between gap-x-5 w-full">
                        <button type="submit" class="w-1/2 lg:w-1/3 bg-blue-500 py-2 rounded-lg text-white font-bold hover:scale-105">SUBMIT</button>
                        <a href="{{ route('users.index') }}" class="w-1/2 lg:w-1/3 text-center bg-gray-500 hover:scale-105 py-2 rounded-lg text-white font-bold">BACK</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection