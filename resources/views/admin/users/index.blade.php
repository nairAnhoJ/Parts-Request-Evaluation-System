@extends('layouts.app')
@section('title','USERS')
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

    {{-- RESET MODAL --}}
        <div id="resetModal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow">
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="resetModal">
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
                        <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to reset the password of this user?</h3>
                        <button data-modal-hide="resetModal" type="submit" class="text-white !bg-orange-600 hover:scale-105 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Yes, I'm sure
                        </button>
                        <button data-modal-hide="resetModal" type="button" class="text-gray-500 bg-white hover:scale-105 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">No, cancel</button>
                    </form>
                </div>
            </div>
        </div>
    {{-- RESET MODAL --}}

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

    <div class="min-h-[calc(100%-56px)] w-full p-4 bg-gray-100">
        {{-- <div class="w-full mb-3">
            <div class="flex justify-between items-center h-14">
                <a href="{{ route('users.add') }}" class="block bg-blue-500 z-30 px-7 py-2 text-white font-bold rounded-lg hover:scale-105">ADD</a>
                <div class="w-96 block z-30">
                    <form>
                        @csrf
                        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="search" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search..." autocomplete="off">
                            <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}
        <div class="w-full">
            <table id="userTable" class="compact row-border hover w-full !mb-2">
                <thead>
                    <tr>
                        <th>ID Number</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        @php
                            if($user->role == 0){
                                $role = 'ADMINISTRATOR';
                            }elseif ($user->role == 1) {
                                $role = 'TECHNICIAN / SERVICE COORDINATOR';
                            }elseif ($user->role == 2) {
                                $role = 'SERVICE HEAD';
                            }elseif ($user->role == 3) {
                                $role = 'PARTS EVALUATOR';
                            }elseif ($user->role == 4) {
                                $role = 'SALES QUOTATION ENCODER';
                            }
                        @endphp
                        <tr>
                            <td>{{ $user->id_number }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $role }}</td>
                            <td>
                                @if ($user->role != 0)
                                    <a href="{{ url('/system-management/users/edit/'.$user->key) }}" class="hover:underline text-blue-500">EDIT</a> |
                                @endif
                                <button data-modal-target="resetModal" data-modal-toggle="resetModal" data-key="{{ $user->key }}" class="resetButton hover:underline text-orange-500">RESET</button>
                                @if ($user->role != 0)
                                    | <button data-modal-target="deleteModal" data-modal-toggle="deleteModal" data-key="{{ $user->key }}" class="deleteButton hover:underline text-red-500">DELETE</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#userTable').DataTable( {
                "lengthMenu": [100],
                "lengthChange": false,
                dom: 'Bfrtip',
                buttons: [
                    {
                        text: 'ADD',
                        action: function ( e, dt, node, config ) {
                            window.location.href = "{{ route('users.add') }}";
                        }
                    }
                ]
            } );

            $('.deleteButton').click(function(){
                var key = $(this).data('key');
                $('#deleteForm').attr('action', `/system-management/users/delete/${key}`);
            });

            $('.resetButton').click(function(){
                var key = $(this).data('key');
                $('#deleteForm').attr('action', `/system-management/users/reset/${key}`);
            });
        });
    </script>
@endsection