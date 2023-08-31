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
                    <div class="flex items-end justify-between p-4 border-b rounded-t dark:border-gray-600">

                        <div class="w-1/2 flex justify-between items-center text-center text-sm">
                            <div class="w-full flex items-center">
                                <p class="mr-1">Number</p>
                                <p id="viewNumber" class="px-10 border-b border-gray-400 font-semibold"></p>
                            </div>
                            <div class="w-full flex flex-row-reverse items-center">
                                <p id="viewControlNumber" class="px-10 border-b border-gray-400 font-semibold"></p>
                                <p class="mr-1">Control Number</p>
                            </div>
                        </div>

                        {{-- <h3 id="viewName" class="text-xl font-semibold text-gray-900 dark:text-white">
                            Customer Name
                        </h3> --}}
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

                                    <div class="w-full flex justify-between items-center text-sm mt-3 gap-x-3">
                                        <div class="w-4/5 flex items-center">
                                            <p class="mr-1 text-center whitespace-nowrap">Customer Name</p>
                                            <p id="viewName" class="w-full px-3 border-b border-gray-400 font-semibold"></p>
                                        </div>
                                        <div class="w-1/5 flex items-center">
                                            <p class="mr-1 text-center">Area</p>
                                            <p id="viewArea" class="w-full border-b border-gray-400 font-semibold text-center"></p>
                                        </div>
                                    </div>

                                    <div class="w-full flex justify-between items-center text-sm mt-3">
                                        <div class="w-full flex items-center">
                                            <p class="mr-1 text-center whitespace-nowrap">Address</p>
                                            <p id="viewAddress" class="w-full px-3 border-b border-gray-400 font-semibold"></p>
                                        </div>
                                    </div>

                                    <div class="w-full flex justify-between items-center text-sm mt-3 gap-x-3">
                                        <div class="w-full flex items-center">
                                            <p class="mr-1 text-center whitespace-nowrap">FSRR#</p>
                                            <p id="viewFSRR" class="w-full px-3 border-b border-gray-400 font-semibold text-center"></p>
                                        </div>
                                        <div class="w-full flex items-center">
                                            <p class="mr-1 text-center whitespace-nowrap">Date Received</p>
                                            <p id="viewDateReceived" class="w-full border-b border-gray-400 font-semibold text-center"></p>
                                        </div>
                                        <div class="w-full flex items-center">
                                            <p class="mr-1 text-center">Tech</p>
                                            <p id="viewTech" class="w-full border-b border-gray-400 font-semibold text-center"></p>
                                        </div>
                                    </div>

                                    <div class="w-full flex justify-between items-center text-sm mt-3 gap-x-3">
                                        <div class="w-full flex items-center">
                                            <p class="mr-1 text-center whitespace-nowrap">Brand</p>
                                            <p id="viewBrand" class="w-full px-3 border-b border-gray-400 font-semibold text-center"></p>
                                        </div>
                                        <div class="w-full flex items-center">
                                            <p class="mr-1 text-center whitespace-nowrap">Model</p>
                                            <p id="viewModel" class="w-full border-b border-gray-400 font-semibold text-center"></p>
                                        </div>
                                        <div class="w-full flex items-center">
                                            <p class="mr-1 text-center whitespace-nowrap">Serial No.</p>
                                            <p id="viewSerialNo" class="w-full border-b border-gray-400 font-semibold text-center"></p>
                                        </div>
                                    </div>

                                    <div class="w-full flex justify-between items-center text-sm mt-3 gap-x-3">
                                        <div class="w-full flex items-center">
                                            <p class="mr-1 text-center whitespace-nowrap">WE</p>
                                            <p id="viewWE" class="w-full px-3 border-b border-gray-400 font-semibold text-center"></p>
                                        </div>
                                        <div class="w-full flex items-center">
                                            <p class="mr-1 text-center whitespace-nowrap">Status</p>
                                            <p id="viewStatus" class="w-full border-b border-gray-400 font-semibold text-center"></p>
                                        </div>
                                        <div class="w-full flex items-center">
                                            <p class="mr-1 text-center whitespace-nowrap">HM</p>
                                            <p id="viewHM" class="w-full border-b border-gray-400 font-semibold text-center h-5"></p>
                                        </div>
                                        <div class="w-full flex items-center">
                                            <p class="mr-1 text-center whitespace-nowrap">Disc.</p>
                                            <p id="viewDisc" class="w-full border-b border-gray-400 font-semibold text-center h-5"></p>
                                        </div>
                                    </div>

                                    <div id="partsContainer" class="w-full mt-10 text-xs">
                                    </div>

                                    <div class="w-full flex justify-between items-center text-sm mt-3">
                                        <div class="w-full flex items-center">
                                            <p class="mr-1 text-center whitespace-nowrap">Remarks</p>
                                            <p id="viewRemarks" class="w-full px-3 border-b border-gray-400 font-medium h-5"></p>
                                        </div>
                                    </div>

                                    <div class="w-full flex justify-between items-center text-sm mt-3">
                                        <div class="w-52 flex items-center">
                                            <p class="mr-1 text-center whitespace-nowrap">SQ Number</p>
                                            <p id="viewSQNumber" class="w-full text-center border-b border-gray-400 font-medium h-5"></p>
                                        </div>
                                    </div>

                                    <div class="w-full grid grid-cols-1 mt-10">
                                        <div>
                                            <p class="text-sm mb-3">Validated By:</p>
                                            <div class="flex w-full gap-x-7 pl-5 xl:!pl-10">
                                                <div class="flex flex-col items-center justify-center self-end w-[290px] 2xl:w-[370px]">
                                                    <div class="w-full border-b border-gray-400 text-center whitespace-nowrap text-base h-[25px]">
                                                         <span id="viewValidator" class="font-bold text-sm 2xl:!text-base"></span>
                                                    </div>
                                                    <p class="text-xs 2xl:!text-sm">SA/SC/TECH</p>
                                                </div>
                                                <div class="flex flex-col items-center justify-center self-end w-[110px] 2xl:w-[150px]">
                                                    <div class="w-full border-b border-gray-400 text-center whitespace-nowrap text-base h-[25px]">
                                                        <span id="viewDateValidated" class="font-bold text-sm 2xl:!text-base"></span>
                                                    </div>
                                                    <p class="text-xs 2xl:!text-sm">Date</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-5">
                                            <p class="text-sm mb-3">Approved By:</p>
                                            <div class="flex w-full gap-x-7 pl-5 xl:!pl-10">
                                                <div class="flex flex-col items-center justify-center self-end w-[290px] 2xl:w-[370px]">
                                                    <div class="w-full border-b border-gray-400 text-center whitespace-nowrap text-base h-[25px]">
                                                         <span id="viewApprover" class="font-bold text-sm 2xl:!text-base"></span>
                                                    </div>
                                                    <p class="text-xs 2xl:!text-sm">MNGR/HEAD</p>
                                                </div>
                                                <div class="flex flex-col items-center justify-center self-end w-[110px] 2xl:w-[150px]">
                                                    <div class="w-full border-b border-gray-400 text-center whitespace-nowrap text-base h-[25px]">
                                                        <span id="viewDateApproved" class="font-bold text-sm 2xl:!text-base"></span>
                                                    </div>
                                                    <p class="text-xs 2xl:!text-sm">Date</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-5">
                                            <p class="text-sm mb-3">Encoded By:</p>
                                            <div class="flex w-full gap-x-7 pl-5 xl:!pl-10">
                                                <div class="flex flex-col items-center justify-center self-end w-[290px] 2xl:w-[370px]">
                                                    <div class="w-full border-b border-gray-400 text-center whitespace-nowrap text-base h-[25px]">
                                                         <span id="viewEncoder" class="font-bold text-sm 2xl:!text-base"></span>
                                                    </div>
                                                    <p class="text-xs 2xl:!text-sm">ENCODER</p>
                                                </div>
                                                <div class="flex flex-col items-center justify-center self-end w-[110px] 2xl:w-[150px]">
                                                    <div class="w-full border-b border-gray-400 text-center whitespace-nowrap text-base h-[25px]">
                                                        <span id="viewDateEncoded" class="font-bold text-sm 2xl:!text-base"></span>
                                                    </div>
                                                    <p class="text-xs 2xl:!text-sm">Date</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="w-full">
                                <div class="w-full h-[calc(100vh-204px)] overflow-x-hidden overflow-y-auto pl-4">
                                    <div class="relative">
                                        <div class="sticky top-0 bg-white py-2">
                                            <div class="flex items-center mb-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="h-6 w-6"><path d="M477-120q-149 0-253-105.5T120-481h60q0 125 86 213t211 88q127 0 215-89t88-216q0-124-89-209.5T477-780q-68 0-127.5 31T246-667h105v60H142v-208h60v106q52-61 123.5-96T477-840q75 0 141 28t115.5 76.5Q783-687 811.5-622T840-482q0 75-28.5 141t-78 115Q684-177 618-148.5T477-120Zm128-197L451-469v-214h60v189l137 134-43 43Z"/></svg>
                                                <h3 class="ml-1">History Logs</h3>
                                            </div>
                                            <hr>
                                        </div>
                                        <div id="logsDiv">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b">
                        <button id="viewValidate" data-modal-hide="viewModal" type="button" class="acbtn text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center">VALIDATE</button>
                        <button id="viewApprove" data-modal-hide="viewModal" type="button" class="acbtn text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center">APPROVE</button>
                        <button data-modal-hide="viewModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-bold px-5 py-2.5 hover:text-gray-900 focus:z-10">CLOSE</button>
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
                            <tr class="viewForm bg-white border-b even:bg-gray-50 hover:bg-gray-100 cursor-pointer">
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
                                    {{ $form->originator }}
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
            var key, role = "{{ Auth::user()->role }}";
            $('.deleteButton').click(function(){
                var key = $(this).data('key');
                $('#deleteForm').attr('action', `/evaluation-forms/delete/${key}`);
            });

            $('#clearButton').click(function(){
                window.location.href = "{{ route('form.index') }}";
            });

            $('.viewForm').click(function(e){
                if(!$(e.target).is('.editButton, .deleteButton')){
                    key = $(this).find('span').data('key');
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
                            console.log(response.form['details']);
                            $("#viewNumber").html(response.form['number']);
                            $("#viewControlNumber").html(response.form['control_number']);
                            $("#viewName").html(response.form['customer']['name']);
                            $("#viewArea").html(response.form['customer']['area']);
                            $("#viewAddress").html(response.form['customer']['address']);
                            $("#viewFSRR").html(response.form['fsrr_number']);
                            $("#viewDateReceived").html(response.form['date_received']);
                            $("#viewBrand").html(response.form['brand']['name']);
                            $("#viewModel").html(response.form['model']);
                            $("#viewSerialNo").html(response.form['serial_number']);
                            $("#viewTech").html(response.form['technician']);
                            $("#viewWE").html(response.form['working_environment']);
                            $("#viewStatus").html(response.form['status']);
                            $("#viewHM").html(response.form['hm']);
                            $("#viewDisc").html(response.form['disc']);
                            $("#viewRemarks").html(response.form['remarks']);
                            $("#viewSQNumber").html(response.form['sq_number']);

                            $("#viewValidator").html(response.form['validator']);
                            $("#viewDateValidated").html(response.form['datetime_validated']);

                            $("#viewApprover").html(response.form['approver']);
                            $("#viewDateApproved").html(response.form['datetime_apptoved']);

                            $("#viewEncoder").html(response.form['encoder']);
                            $("#viewDateEncoded").html(response.form['datetime_encoded']);

                            $('#partsContainer').html(`
                                <div class="flex w-full border-y">
                                    <div class="text-center py- w-[5%]">No</div>
                                    <div class="text-center w-[25%] p-2">Part Number</div>
                                    <div class="text-center w-[40%] p-2">Description</div>
                                    <div class="text-center w-[15%] p-2">Quantity</div>
                                    <div class="text-center w-[15%] p-2 whitespace-nowrap">Unit Price(€)</div>
                                </div>
                            `);

                            var details = response.form['details'];
                            var x = 1;

                            details.forEach(detail => {
                                $('#partsContainer').append(`
                                    <div class="flex w-full border-b">
                                        <div class="text-center p-2 w-[5%]">${x++}</div>
                                        <div class="text-center w-[25%] p-2">${detail['part_number']}</div>
                                        <div class="text-left w-[40%] p-2">${detail['description']}</div>
                                        <div class="text-center w-[15%] p-2">${detail['quantity']}</div>
                                        <div class="text-center w-[15%] p-2 whitespace-nowrap">${detail['unit_price']}</div>
                                    </div>
                                `);
                            });

                            $('#logsDiv').html(response.logRes);


                            $('.acbtn').addClass('hidden');
                            if(role == 1 && response.form['is_validated'] == 0){
                                $('#viewValidate').removeClass('hidden');
                            }else if(role == 2 && response.form['is_validated'] == 1 && response.form['is_approved'] == 0){
                                $('#viewApprove').removeClass('hidden');
                            }


                            $('#viewButton').click();
                        },
                    });
                }
            });
        });
    </script>
@endsection