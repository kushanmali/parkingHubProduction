<div class="p-3">
    <h1 class="text-black pb-4 text-xl">All Parkings</h1>

    <div class="pt-0">
        <div class="flex pb-8 w-full justify-between items-center">
            <div class="relative w-full">
                <input wire:model.live="search" type="text" placeholder="Search Parkings" class="pl-10 pr-4 py-2 w-full border  font-inter rounded-2 focus:outline-none focus:border-blue-500">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
            </div>       
        </div>
    </div>

    @if($parkings->count() > 0)
        @foreach($parkings as $parking)
        <a href="{{route('viewUserParking', $parking->id)}}">
            <div class="flex lg:w-6/12 pb-4 w-full">
                <div class="w-4/12 lg:w-5/12">
                    <img src="{{ asset('/storage/'.$parking->profile_img_path) }}" alt="Parking Image" class="inline-flex items-center justify-center w-full h-full object-cover text-white transition-all duration-200 text-base ease-soft-in-out rounded-4">
                </div>
                <div class="w-8/12 lg:w-7/12 pl-3">
                    <h5 class="mt-0 mb-2 dark:text-white">{{ $parking->parking_name }}</h5>
                    <p class="leading-normal text-sm dark:text-white dark:opacity-60">{{ \Illuminate\Support\Str::limit($parking->location->address_address, 30) }}</p>
                    <div class="flex justify-end px-3">
                        <button class="bg-blue-500 w-8/12 text-4 font-bold text-white py-2 rounded-full">Book Now</button>
                    </div>
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
