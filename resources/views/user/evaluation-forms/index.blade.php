@extends('layouts.app')
@section('title','EVALUATION FORMS')
@section('content')

    {{-- SUCCESS ALERT --}}
        @if (session('success'))
            <div class="absolute top-[70px] w-full flex justify-center z-20">
                <div id="success" class="w-[500px] flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-400 bg-green-200" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <div class="ml-3 text-sm font-medium">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8"  data-dismiss-target="#success" aria-label="Close">
                        <span class="sr-only">Dismiss</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
            </div>
        @endif
    {{-- SUCCESS ALERT --}}

    {{-- DELETE MODAL --}}
        <div id="deleteModal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow">
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="deleteModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <form id="deleteForm" method="GET" action="" class="p-6 text-center">
                        @csrf
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to delete this user?</h3>
                        <button data-modal-hide="deleteModal" type="submit" class="text-white bg-red-600 hover:scale-105 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Yes, I'm sure
                        </button>
                        <button data-modal-hide="deleteModal" type="button" class="text-gray-500 bg-white hover:scale-105 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">No, cancel</button>
                    </form>
                </div>
            </div>
        </div>
    {{-- DELETE MODAL --}}

    {{-- VIEW MODAL --}}
        <button data-modal-target="viewModal" data-modal-toggle="viewModal" id="viewButton" class="hidden"></button>
        <div id="viewModal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 max-h-full">
            <div class="relative w-full h-full max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 h-full w-full">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 id="viewName" class="text-xl font-semibold text-gray-900 dark:text-white">
                            Customer Name
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="viewModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 space-y-4">
                        <div class="w-full flex">
                            <div class="w-full border-r">
                                <div class="w-full h-[calc(100vh-204px)] overflow-x-hidden overflow-y-auto pr-4">

                                </div>
                            </div>
                            <div class="w-full">
                                <div class="w-full h-[calc(100vh-204px)] overflow-x-hidden overflow-y-auto pl-4">

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        {{-- <button data-modal-hide="viewModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button> --}}
                        <button data-modal-hide="viewModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Close</button>
                    </div>
                </div>
            </div>
        </div>
    {{-- VIEW MODAL --}}

    <div class="min-h-[calc(100%-56px)] w-full p-4 bg-gray-100">
        <div class="w-full">
            {{-- CONTROLS --}}
                @csrf
                <div class="mb-3">
                    <div class="md:grid md:grid-cols-2">
                        <div class="w-24 mb-3 md:mb-0">
                            <a href="{{ route('form.add') }}" class="flex justify-center items-center text-white bg-blue-600 hover:scale-105 focus:ring-4 focus:ring-blue-300 font-semibold rounded-lg text-sm py-2 focus:outline-none mt-px">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 transition duration-75 mr-1" fill="currentColor" viewBox="0 -960 960 960"><path d="M440.391-190.391v-250h-250v-79.218h250v-250h79.218v250h250v79.218h-250v250h-79.218Z"/></svg>
                                <span>ADD</span></a>
                        </div>
                        <div class="justify-self-end w-full xl:w-4/5">
                            <form id="searchForm" method="GET" action="{{ route('form.index') }}" class="w-full">
                                @csrf
                                <label for="searchInput" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                    </div>
                                    <input type="search" id="search" name="search" class="block z-10 w-full px-4 py-2.5 pl-10 text-sm text-gray-500 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="SEARCH" value="{{ $search }}" autocomplete="off">
                                    <button id="clearButton" type="button" class="absolute right-20 bottom-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 transition duration-75 group-hover:text-gray-900 mr-1 text-gray-500" fill="currentColor" viewBox="0 -960 960 960"><path d="M249-193.434 193.434-249l231-231-231-231L249-766.566l231 231 231-231L766.566-711l-231 231 231 231L711-193.434l-231-231-231 231Z"/></svg>
                                    </button>
                                    <button id="searchSubmit" type="submit" style="bottom: 5px; right: 5px;" type="submit" class="text-white absolute bg-blue-600 hover:scale-105 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            {{-- CONTROLS END --}}
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-200 border-t border-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Number
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Control Number
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Customer Name
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Encoder
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($forms as $form)
                            <tr class="formRow bg-white border-b even:bg-gray-50 hover:bg-gray-100 cursor-pointer">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    <span data-key="{{ $form->key }}">
                                        {{ $form->number }}
                                    </span>
                                </th>
                                <td class="px-6 py-4 text-center">
                                    {{ $form->control_number }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    {{ $form->customer->name }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    {{ $form->encoder }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ url('/evaluation-forms/edit?key='.$form->key) }}" class="editButton hover:underline text-blue-500">EDIT</a> |
                                    <button data-modal-target="deleteModal" data-modal-toggle="deleteModal" data-key="{{ $form->key }}" class="deleteButton hover:underline text-red-500">DELETE</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="w-full flex justify-between mt-3">
                {{ $forms->appends(['search' => $search])->links() }}
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('nav[role="navigation"]').addClass('w-full')
            $('nav[role="navigation"]').find('div:eq(1)').addClass('w-full')
            $('span[aria-current="page"]').find('span').addClass('!bg-blue-500 text-white !border-blue-500')
            $('span[aria-disabled="true"]').find('span').addClass('!bg-gray-100 opacity-70')

            $('.deleteButton').click(function(){
                var key = $(this).data('key');
                $('#deleteForm').attr('action', `/evaluation-forms/delete/${key}`);
            });

            $('#clearButton').click(function(){
                $('#search').val('');
                $('#searchForm').submit();
            });

            $('.formRow').click(function(e){
                if(!$(e.target).is('.editButton, .deleteButton')){
                    var key = $(this).find('span').data('key');
                    var _token = $('input[name="_token"]').val();

                    $.ajax({
                        url: "{{ route('form.getForm') }}",
                        method: "POST",
                        dataType: "json",
                        data:{
                            key: key,
                            _token: _token
                        },
                        success: function(response) {
                            $("#viewName").html(response.name);
                            $('#viewButton').click();
                        },
                    });
                }
            });
        });
    </script>
@endsection