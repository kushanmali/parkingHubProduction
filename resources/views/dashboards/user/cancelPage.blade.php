@extends('layouts.user.app')

@section('content')

<div class=" max-w-7xl -mt-24 mx-auto">
    <div class="p-3">
        <h3 class="text-lg text-center">Cancel Booking</h3>
    </div>

        <div class="px-2 rounded-4">

            <!-- Parking details -->
            <div class="flex lg:w-6/12 pb-4 w-full">
                <!-- Parking image -->
                <!-- Parking information -->
                <div class="w-full lg:w-7/12 pl-3">
                    <h5 class="mt-0 mb-2 dark:text-white">{{ $parking->parking_name }}</h5>
                    <p class="leading-normal text-sm dark:text-white dark:opacity-60">
                        <i class="fas fa-map-marker-alt  text-xl text-blue-500"></i> 
                        {{ $parking->location->address_address}}
                    </p>
                </div>
            </div>
        </div>

</div>


<div class=" max-w-7xl mx-auto">
    <div class="p-3">
        <h3 class="text-lg text-start">Please Select THe reason for Cancellation</h3>
    </div>

    @if($errors->any())
        <div class="bg-red-500 mx-4 text-white rounded-3 p-6 my-5">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form  id="main-form"  action="{{ route('cancelParking', $parking->id) }}" method="post">
        @csrf

        <div class="px-6 rounded-4">
            <div class="flex items-center mb-2">
                <input id="reason-01" type="radio" value="Schedule Change" name="cancelReason" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="reason-01" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Schedule Change</label>
            </div>
            <div class="flex items-center  mb-2">
                <input  id="reason-02" type="radio" value="Found Altranative Parking" name="cancelReason" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="reason-02" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Found Altranative Parking</label>
            </div>
            <div class="flex items-center  mb-2">
                <input  id="reason-03" type="radio" value="Change Of Plans" name="cancelReason" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="reason-03" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Change Of Plans</label>
            </div>
            <div class="flex items-center  mb-2">
                <input  id="reason-04" type="radio" value="Want To Book another Slot" name="cancelReason" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="reason-04" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Want To Book another Slot</label>
            </div>
            <div class="flex items-center  mb-2">
                <input  id="reason-04" type="radio" value="Booking Mistake" name="cancelReason" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="reason-04" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Booking Mistake</label>
            </div>
        </div>


        <div class="animate-fade-up fixed bottom-0 right-0 left-0 pb-5 rounded-t-5 bg-white">

            <div class="flex w-full px-4 justify-center">
                <button type="submit" id="cancel-button" class=" bg-gradient-to-br from-red-600 text-center to-pink-400 w-full py-3 rounded-12 text-white font-bold"><i class="fas mr-2 fa-times" style="color: white;"></i>Confirm</button>
            </div>

        </div>

    </form>

</div>

@endsection