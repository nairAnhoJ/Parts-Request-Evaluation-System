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
                <form action="{{ route('users.store') }}" method="POST" class="w-full sm:!w-5/6">
                    @csrf
                    <div class="flex gap-x-3">
                        <div class="flex flex-col relative optionDiv mb-3 w-3/4">
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
                    <div class="grid grid-cols-3 gap-x-3">
                        <div class="mb-3">
                            <label for="brand" class="block text-sm font-semibold text-gray-600">Brand</label>
                            <select id="brand" name="knowledge_of_participants" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="model" class="block text-sm font-semibold text-gray-600">Model</label>
                            <select id="model" name="model" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                @foreach ($models as $model)
                                    <option value="{{ $model->id }}">{{ $model->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="serial_number" class="block text-sm font-semibold text-gray-600">Serial Number <span class="text-red-500">*</span></label>
                            <input type="text" id="serial_number" name="serial_number" value="{{ old('serial_number') }}" class="{{ old('serial_number') == '' && session('error') ? 'border-red-500' : '' }} w-full lg:w-1/2 border-gray-300 rounded-lg shadow-inner" autocomplete="off">
                        </div>
                    </div>

                    <div class="flex justify-between gap-x-5 w-full">
                        <button type="submit" class="w-1/2 lg:w-1/3 bg-blue-500 py-2 rounded-lg text-white font-bold hover:scale-105">SUBMIT</button>
                        <a href="{{ route('users.index') }}" class="w-1/2 lg:w-1/3 text-center bg-gray-500 hover:scale-105 py-2 rounded-lg text-white font-bold">BACK</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
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

            jQuery(document).on( "click", ".listOption li", function(){
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
                        
                        $(".listOption li").closest('.optionDiv').find('input').val(name);
                        $('.listOption').addClass('hidden');
                    }
                })
            });

            $('#brand').change(function() {
                var id = $(this).val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url:"{{ route('form.getModel') }}",
                    method:"POST",
                    dataType: 'json',
                    data:{
                        id: id,
                        _token: _token
                    },
                    success:function(result){
                        
                    }
                })
            });
        });
    </script>
@endsection