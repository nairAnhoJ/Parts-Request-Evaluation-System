@extends('layouts.app')
@section('title','EVALUATION FORM - ADD')
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
                <form action="{{ route('form.store') }}" method="POST" class="w-full sm:!w-5/6">
                    @csrf
                    <div class="flex gap-x-5">
                        <div id="nameSelect" class="flex flex-col relative optionDiv mb-3 w-3/4">
                            <label for="name" class="block text-sm font-semibold text-gray-600">Customer Name <span class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name" class="inputOption block w-full p-2 text-gray-600 border border-gray-300 rounded-lg bg-gray-50 sm:text-sm" required autocomplete="off">
                            <div class="listOption hidden absolute top-[65px] w-full rounded-lg border border-gray-300 overflow-y-auto max-h-[30vh] text-gray-600 bg-white z-[99] shadow-xl">
                                <ul>
                                    @foreach ($customers as $customer)
                                        <li data-id="{{ $customer->id }}" class="p-2 first:border-0 border-t border-gray-300 hover:bg-gray-200 cursor-pointer">{{ $customer->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="mb-3 flex flex-col w-1/4">
                            <label for="area" class="text-gray-700 font-bold text-sm">Area <span class="text-red-500">*</span></label>
                            <input type="text" id="area" name="area" value="{{ old('area') }}" class="{{ old('area') == '' && session('error') ? 'border-red-500' : '' }} w-full lg:w-1/2 border-gray-300 rounded-lg shadow-inner" autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="text-gray-700 font-bold text-sm">Address <span class="text-red-500">*</span></label>
                        <input type="text" id="address" name="address" value="{{ old('address') }}" class="{{ old('address') == '' && session('error') ? 'border-red-500' : '' }} w-full lg:w-1/2 border-gray-300 rounded-lg shadow-inner" autocomplete="off">
                    </div>
                    <div class="grid grid-cols-3 gap-x-5">
                        <div class="mb-3">
                            <label for="brand" class="block text-sm font-semibold text-gray-600">Brand <span class="text-red-500">*</span></label>
                            <select id="brand" name="knowledge_of_participants" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="modelSelect" class="flex flex-col relative optionDiv mb-3 w-full">
                            <label for="model" class="block text-sm font-semibold text-gray-600">Model <span class="text-red-500">*</span></label>
                            <input type="text" id="model" name="model" class="inputOption block w-full p-2 text-gray-600 border border-gray-300 rounded-lg bg-gray-50 sm:text-sm" required autocomplete="off">
                            <div class="listOption hidden absolute top-[65px] w-full rounded-lg border border-gray-300 overflow-y-auto max-h-[30vh] text-gray-600 bg-white z-[99] shadow-xl">
                                <ul id="modelOptions">
                                    @foreach ($models as $model)
                                        <li class="p-2 first:border-0 border-t border-gray-300 hover:bg-gray-200 cursor-pointer">{{ $model->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="serial_number" class="block text-sm font-semibold text-gray-600">Serial Number <span class="text-red-500">*</span></label>
                            <input type="text" id="serial_number" name="serial_number" value="{{ old('serial_number') }}" class="{{ old('serial_number') == '' && session('error') ? 'border-red-500' : '' }} w-full lg:w-1/2 border-gray-300 rounded-lg shadow-inner" autocomplete="off">
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-x-5">
                        <div class="mb-3">
                            <label for="fsrr_number" class="block text-sm font-semibold text-gray-600">FSRR Number <span class="text-red-500">*</span></label>
                            <input type="text" id="fsrr_number" name="fsrr_number" value="{{ old('fsrr_number') }}" class="{{ old('fsrr_number') == '' && session('error') ? 'border-red-500' : '' }} w-full lg:w-1/2 border-gray-300 rounded-lg shadow-inner" autocomplete="off">
                        </div>
                        <div class="mb-3 w-full">
                            <label for="date_received" class="block text-sm font-semibold text-gray-600">Date Received (FSRR) <span class="text-red-500">*</span></label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                  <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                </div>
                                <input datepicker type="text" id="date_received" name="date_received" value="{{ old('date_received') }}" class="{{ old('date_received') == '' && session('error') ? 'border-red-500' : '' }} bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Select date" autocomplete="off">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="technician" class="block text-sm font-semibold text-gray-600">Technician <span class="text-red-500">*</span></label>
                            <input type="text" id="technician" name="technician" value="{{ old('technician') }}" class="{{ old('technician') == '' && session('error') ? 'border-red-500' : '' }} w-full lg:w-1/2 border-gray-300 rounded-lg shadow-inner" autocomplete="off">
                        </div>
                    </div>
                    <div class="grid grid-cols-4 gap-x-5">
                        <div class="mb-3">
                            <label for="fsrr_number" class="block text-sm font-semibold text-gray-600">Working Environment <span class="text-red-500">*</span></label>
                            <div class="flex items-center h-10 gap-x-5">
                                <div class="flex items-center">
                                    <input checked id="cold" type="radio" value="COLD" name="working_environment" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                    <label for="cold" class="ml-2 text-sm font-medium text-gray-900">COLD</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="dry" type="radio" value="DRY" name="working_environment" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                    <label for="dry" class="ml-2 text-sm font-medium text-gray-900">DRY</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="fsrr_number" class="block text-sm font-semibold text-gray-600">Status <span class="text-red-500">*</span></label>
                            <div class="flex items-center h-10 gap-x-5">
                                <div class="flex items-center">
                                    <input checked id="up" type="radio" value="UP" name="status" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                    <label for="up" class="ml-2 text-sm font-medium text-gray-900">UP</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="down" type="radio" value="DOWN" name="status" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                    <label for="down" class="ml-2 text-sm font-medium text-gray-900">DOWN</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="hm" class="block text-sm font-semibold text-gray-600">HM</label>
                            <input type="text" id="hm" name="hm" value="{{ old('hm') }}" class="w-full lg:w-1/2 border-gray-300 rounded-lg shadow-inner" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="disc" class="block text-sm font-semibold text-gray-600">DISC</label>
                            <input type="text" id="disc" name="disc" value="{{ old('disc') }}" class="w-full lg:w-1/2 border-gray-300 rounded-lg shadow-inner" autocomplete="off">
                        </div>
                    </div>

                    <hr class="border-gray-600 my-5">

                    <div class="flex justify-between items-center mb-2 px-4">
                        <h1 class="font-bold text-gray-600 text-2xl">PARTS</h1>
                        <button id="addPart" type="button" class="flex items-center gap-x-1 text-blue-600 hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-blue-500 transition duration-75 group-hover:text-gray-900" fill="currentColor" viewBox="0 -960 960 960"><path xmlns="http://www.w3.org/2000/svg" d="M453-280h60v-166h167v-60H513v-174h-60v174H280v60h173v166Zm27.266 200q-82.734 0-155.5-31.5t-127.266-86q-54.5-54.5-86-127.341Q80-397.681 80-480.5q0-82.819 31.5-155.659Q143-709 197.5-763t127.341-85.5Q397.681-880 480.5-880q82.819 0 155.659 31.5Q709-817 763-763t85.5 127Q880-563 880-480.266q0 82.734-31.5 155.5T763-197.684q-54 54.316-127 86Q563-80 480.266-80Zm.234-60Q622-140 721-239.5t99-241Q820-622 721.188-721 622.375-820 480-820q-141 0-240.5 98.812Q140-622.375 140-480q0 141 99.5 240.5t241 99.5Zm-.5-340Z"/></svg>ADD
                        </button>
                    </div>

                    <div class="mb-8">
                        <div class="w-full border border-b-0 border-gray-400 rounded-t-lg">
                            <div id="partsGrid" class="">
                                {{-- HEADER --}}
                                    <div class="flex w-full">
                                        <div class="text-center border-b border-r border-gray-400 py-2 w-[5%]">No</div>
                                        <div class="text-center w-[25%] border-b border-r border-gray-400 py-2">Part Number</div>
                                        <div class="text-center w-[42%] border-b border-r border-gray-400 py-2">Description</div>
                                        <div class="text-center w-[10%] border-b border-r border-gray-400 py-2">Quantity</div>
                                        <div class="text-center w-[10%] border-b border-r border-gray-400 py-2">Unit Price(€)</div>
                                        <div class="text-center w-[8%] border-b border-gray-400 py-2">Action</div>
                                    </div>
                                {{-- HEADER --}}

                                {{-- BODY --}}
                                    <div id="part1" class="flex w-full">
                                        <div class="text-center border-b border-r border-gray-400 w-[5%] flex items-center justify-center font-bold">1</div>
                                        <div class="text-center w-[25%] border-b border-r border-gray-400 pb-2.5 px-5">
                                            <input type="text" name="part_number_1" class="w-full border-0 border-b bg-gray-100 focus:border-blue-500 focus:border-b-2 focus:ring-0 text-center pb-1 pt-3">
                                        </div>
                                        <div class="text-center w-[42%] border-b border-r border-gray-400 pb-2.5 px-5">
                                            <input type="text" name="description_1" class="w-full border-0 border-b bg-gray-100 focus:border-blue-500 focus:border-b-2 focus:ring-0 text-center pb-1 pt-3">
                                        </div>
                                        <div class="text-center w-[10%] border-b border-r border-gray-400 pb-2.5 px-5">
                                            <input type="text" name="quantity_1" class="w-full border-0 border-b bg-gray-100 focus:border-blue-500 focus:border-b-2 focus:ring-0 text-center pb-1 pt-3">
                                        </div>
                                        <div class="text-center w-[10%] border-b border-r border-gray-400 pb-2.5 px-5">
                                            <input type="text" name="price_1" class="w-full border-0 border-b bg-gray-100 focus:border-blue-500 focus:border-b-2 focus:ring-0 text-center pb-1 pt-3">
                                        </div>
                                        <div class="w-[8%] border-b border-gray-400 flex items-center justify-center">
                                            {{-- <button type="button" data-count="1" class="deletePart hover:scale-105">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-red-500 transition duration-75 group-hover:text-gray-900" fill="currentColor" viewBox="0 -960 960 960"><path xmlns="http://www.w3.org/2000/svg" d="m330-288 150-150 150 150 42-42-150-150 150-150-42-42-150 150-150-150-42 42 150 150-150 150 42 42ZM480-80q-82 0-155-31.5t-127.5-86Q143-252 111.5-325T80-480q0-83 31.5-156t86-127Q252-817 325-848.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 82-31.5 155T763-197.5q-54 54.5-127 86T480-80Zm0-60q142 0 241-99.5T820-480q0-142-99-241t-241-99q-141 0-240.5 99T140-480q0 141 99.5 240.5T480-140Zm0-340Z"/></svg>
                                            </button> --}}
                                        </div>
                                    </div>
                                {{-- BODY --}}
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between gap-x-5 w-full">
                        <button type="submit" class="w-1/2 lg:w-1/3 bg-blue-500 py-2 rounded-lg text-white font-bold hover:scale-105">SUBMIT</button>
                        <a href="{{ route('form.index') }}" class="w-1/2 lg:w-1/3 text-center bg-gray-500 hover:scale-105 py-2 rounded-lg text-white font-bold">BACK</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            var counter = 2;

            $(document).click(function(){
                $('.listOption').addClass('hidden');
            });

            jQuery(document).on( "click", ".inputOption", function(e){
                $('.content').not($(this).closest('.optionDiv').find('.listOption')).addClass('hidden');
                $(this).closest('.optionDiv').find('.listOption').toggleClass('hidden');
                var value = $(this).val().toLowerCase();
                searchFilter(value);
                e.stopPropagation();
            });

            function searchFilter(searchInput){
                $(".listOption li").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchInput) > -1)
                });
            }
            
            jQuery(document).on( "keydown", ".inputOption", function(e){
                var value = $(this).val().toLowerCase();
                searchFilter(value);

                if (event.keyCode === 9) {
                    $('.listOption').addClass('hidden');
                }
            });

            jQuery(document).on( "click", "#nameSelect .listOption li", function(){
                var name = $(this).html();
                var id = $(this).data('id');
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url:"{{ route('form.getCustomer') }}",
                    method:"POST",
                    dataType: 'json',
                    data:{
                        id: id,
                        _token: _token
                    },
                    success:function(result){
                        $('#area').val(result.area);
                        $('#address').val(result.address);

                        $('#nameSelect .listOption li').closest('.optionDiv').find('input').val(name);
                        $('.listOption').addClass('hidden');
                    }
                })
            });

            jQuery(document).on( "click", "#modelSelect .listOption li", function(){
                var name = $(this).html();
                $(this).closest('.optionDiv').find('input').val(name);
                $('.listOption').addClass('hidden');
            });

            $('#brand').change(function() {
                var id = $(this).val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url:"{{ route('form.getModel') }}",
                    method:"POST",
                    data:{
                        id: id,
                        _token: _token
                    },
                    success:function(result){
                        $('#modelSelect .listOption li').closest('.optionDiv').find('input').val('');
                        $('#modelOptions').html(result);
                    }
                })
            });

            $('#addPart').click(function(){
                $('#partsGrid').append(`
                    <div id="part${counter}" class="flex w-full">
                        <div class="text-center border-b border-r border-gray-400 w-[5%] flex items-center justify-center font-bold">${counter}</div>
                        <div class="text-center w-[25%] border-b border-r border-gray-400 pb-2.5 px-5">
                            <input type="text" name="part_number_${counter}" class="w-full border-0 border-b bg-gray-100 focus:border-blue-500 focus:border-b-2 focus:ring-0 text-center pb-1 pt-3">
                        </div>
                        <div class="text-center w-[42%] border-b border-r border-gray-400 pb-2.5 px-5">
                            <input type="text" name="description_${counter}" class="w-full border-0 border-b bg-gray-100 focus:border-blue-500 focus:border-b-2 focus:ring-0 text-center pb-1 pt-3">
                        </div>
                        <div class="text-center w-[10%] border-b border-r border-gray-400 pb-2.5 px-5">
                            <input type="text" name="quantity_${counter}" class="w-full border-0 border-b bg-gray-100 focus:border-blue-500 focus:border-b-2 focus:ring-0 text-center pb-1 pt-3">
                        </div>
                        <div class="text-center w-[10%] border-b border-r border-gray-400 pb-2.5 px-5">
                            <input type="text" name="price_${counter}" class="w-full border-0 border-b bg-gray-100 focus:border-blue-500 focus:border-b-2 focus:ring-0 text-center pb-1 pt-3">
                        </div>
                        <div class="w-[8%] border-b border-gray-400 flex items-center justify-center">
                            <button type="button" data-count="part${counter}" class="deletePart hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-red-500 transition duration-75 group-hover:text-gray-900" fill="currentColor" viewBox="0 -960 960 960"><path xmlns="http://www.w3.org/2000/svg" d="m330-288 150-150 150 150 42-42-150-150 150-150-42-42-150 150-150-150-42 42 150 150-150 150 42 42ZM480-80q-82 0-155-31.5t-127.5-86Q143-252 111.5-325T80-480q0-83 31.5-156t86-127Q252-817 325-848.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 82-31.5 155T763-197.5q-54 54.5-127 86T480-80Zm0-60q142 0 241-99.5T820-480q0-142-99-241t-241-99q-141 0-240.5 99T140-480q0 141 99.5 240.5T480-140Zm0-340Z"/></svg>
                            </button>
                        </div>
                    </div>
                `);
                counter++;
            });

            jQuery(document).on( "click", ".deletePart", function(){
                var thisCount = $(this).data('count');
                $('#'+thisCount).remove();
            });
        });
    </script>
@endsection