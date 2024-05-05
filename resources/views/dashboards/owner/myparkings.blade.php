@extends('layouts.owner.app')

@section('content')

<div class="w-full px-6 mx-auto mt-4">

  <div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 flex-0">
      <div class="relative pb-4 flex flex-col min-w-0 break-words bg-white border-0 dark:bg-gray-950 dark:shadow-soft-dark-xl shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
          <div class="lg:flex">
            <div>
              <h5 class="mb-0 dark:text-white">My parkings</h5>
            </div>
            <div class="my-auto mt-6 ml-auto lg:mt-0">
              <div class="my-auto ml-auto">
                <a href="{{url('/new-parking')}}" class="inline-block px-8 py-2 m-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-gradient-to-tl from-purple-700 to-pink-500 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">+&nbsp; New Parking</a>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="flex-auto shadow-none bg-transparent p-6 px-0 pb-0">
        <div class="overflow-x-auto flex flex-wrap w-full bg-transparent table-responsive">
          @if($parkings->count() > 0)
          @foreach($parkings as $parking)
          <a class="w-full lg:w-4/12" href="{{route('viewParking', $parking->id )}}">
              <div class="p-4 bg-white shadow-soft-lg rounded-4">
                  <!-- Parking details -->
                  <div class="flex lg:w-full pb-4 w-full">
                      <!-- Parking image -->
                      <div class="w-4/12 lg:w-5/12">
                          <img src="{{ asset('/storage/'.$parking->profile_img_path) }}" alt="Parking Image" class="inline-flex items-center justify-center w-full object-cover text-white transition-all duration-200 text-base ease-soft-in-out rounded-4">
                      </div>
                      <!-- Parking information -->
                      <div class="w-8/12 lg:w-7/12 pl-3">
                          <h5 class="mt-0 mb-2 dark:text-white">{{ $parking->parking_name }}</h5>
                          <p class="leading-normal text-sm dark:text-white dark:opacity-60">
                              <i class="fas fa-map-marker-alt  text-xl text-blue-500"></i> 
                              {{ \Illuminate\Support\Str::limit($parking->location->address_address, 55) }}
                          </p>
                      </div>

                      <form action="{{ route( 'deleteParking', $session->id ) }}" id="delete-form-{{ $parking->id }}" method="POST">
                        @csrf
                        <button type="submit" class="" onclick="ConfirmDelete(event, {{ $parking->id }})">
                          <i class="fas fa-trash text-slate-400 dark:text-white/70"></i>
                        </button>
                      </form>
                  </div>                  
              </div>
          </a>
          @endforeach
      @else
          <div class="m-4 p-4 rounded-2 flex items-center bg-red-100">
              <h3 class="text-sm mb-0 text-center text-red-500 font-semibold px-2">No available Parkings</h3>
          </div>
      @endif                  
        </div>
      </div>
    </div>
  </div>

</div>

@endsection