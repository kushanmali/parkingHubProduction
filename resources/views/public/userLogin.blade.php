@extends('public.layouts.appLogin')

@section('content')

<style>.choices[data-type*="select-one"]:after {
    display: none;
}
.choices__list--dropdown .choices__item--selectable:after{
    display: none;
}

.choices__list--dropdown .choices__item--selectable{
   font-size: 16px;
   white-space: nowrap;
   margin: 0%;
   padding-left: 2px;
   width: fit-content;
}
</style>


<body class="m-0 w-full  font-sans antialiased font-normal text-left bg-white leading-default text-base dark:bg-slate-950 text-slate-500 dark:text-white/80">
    <!-- sidenav -->

    @role('Admin|Nurse|Reception')
    <div class="container sticky top-0 z-110 ">
      <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3 flex-0">

          <nav class="absolute top-0 left-0 right-0 z-30 flex flex-wrap items-center justify-between w-full px-4 py-2 my-4 shadow-soft-2xl bg-white/80 backdrop-blur-2xl backdrop-saturate-200 rounded-blur lg:flex-nowrap lg:justify-start">

            <div class="container flex flex-wrap w-full items-center justify-between lg-max:overflow-hidden">
                <div class="flex items-center">
                    <a class="flex justify-center items-center px-4 py-3 m-0 text-sm whitespace-nowrap text-slate-700 dark:text-white" href="{{url('/setdashboard')}}">
                        <img src="{{asset('assets/img/pet-logo.webp')}}" class="inline-block h-full max-w-full transition-all duration-200 ease-soft-in-out max-h-8 dark:hidden" alt="main_logo" />
                        <img src="{{asset('assets/img/pet-logo.webp')}}" class="hidden h-full max-w-full transition-all duration-200 ease-soft-in-out max-h-8 dark:inline-block" alt="main_logo" />
                        <h4 class="font-bold text-2xl mb-0">Parking <span class="bg-gradient-to-tl from-green-600 to-teal-400 bg-clip-text text-transparent text-2xl">HUB</span></h4>
                    </a>
                </div>

                <div class="items-center flex justify-end transition-all duration-350 ease-soft-in-out lg-max:max-h-0  lg-max:bg-transparentrounded-2xl lg:flex">
                    <ul class=" pl-0 mb-0 list-none lg:block">
                        <li>
                            <a href="{{url('/setdashboard')}}" class="inline-block px-8 py-2 mb-0 mr-1 font-bold text-center text-white uppercase align-middle transition-all border-0 cursor-pointer ease-soft-in-out text-xs leading-pro bg-gradient-to-tl from-green-500 to-teal-400 tracking-tight-soft shadow-soft-md bg-150 bg-x-25 rounded-7 hover:scale-102 active:opacity-85">Dashboard</a>
                        </li>
                    </ul>
                </div>
            </div>
          </nav>
        </div>
      </div>
    </div>
    @endrole
    
    <main class="mt-0 transition-all duration-200 ease-soft-in-out">
      <section>
       
        <div class="pb-56 pt-12 m-4 min-h-50-screen items-start rounded-xl p-0 relative overflow-hidden bg-cover flex bg-no-repeat bg-bottom" style="background-image: url({{asset('assets/img/cover01.webp')}}); ">
            <span class="absolute z-0 left-0 w-full h-full bg-center bg-contain to=white"></span>
        </div>
        <div class="container mt-12">
            <div class="flex flex-wrap justify-center -mx-3 -mt-48 lg:-mt-48 md:-mt-56">
            <div class="w-full max-w-full px-3 mx-auto shrink-0 md:flex-0 md:w-7/12 lg:w-5/12 xl:w-4/12">
                <div class="relative flex flex-col min-w-0 break-words bg-white border-0 lg:py-4 dark:bg-gray-950 dark:shadow-soft-dark-xl shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-6 text-center">
                    <div class="mb-6">
                    </div>
                    <a class="flex justify-center items-center m-0 text-sm whitespace-nowrap text-slate-700 dark:text-white" href="{{route('index')}}">
                        <img src="{{asset('assets/img/parking-hub-icon.jpg')}}" class="inline-block h-full max-w-full transition-all duration-200 ease-soft-in-out max-h-12 dark:hidden" alt="main_logo" />
                        <img src="{{asset('assets/img/parking-hub-icon.jpg')}}" class="hidden h-full max-w-full transition-all duration-200 ease-soft-in-out max-h-12 dark:inline-block" alt="main_logo" />
                        <h4 class="font-bold ml-2 text-4xl mb-0">Parking<span class="bg-gradient-to-tl from-green-600 to-teal-400 bg-clip-text text-transparent text-4xl"> HUB</span></h4>
                    </a>
                    <p class="mb-6"> Enter Your Phone Number </p>
    
                    @if($errors->any())
                        <div class="bg-red-300 text-white rounded-3 p-6 my-5">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                
                    <form role="form" method="POST" action="{{ route('requestOtp') }}">
                        @csrf
                        <div class=" flex-wrap flex">
                            <div class=" max-w-full w-4/12 px-3 flex-0 ">
                                <select choice disabled name="countrySelect" id="choices-countrySelect">
                                    <option value="LK">(+94)</option>
                                </select>
                            </div>
                            <div class="mb-4 w-8/12 mx-auto">
                                <input type="text" name="phone_number" placeholder="xxxx-xxxxxx" class="focus:shadow-soft-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" />
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="inline-block px-16 py-3.5 mb-0 mt-4 font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-soft-xs dark:bg-gradient-to-tl dark:from-slate-850 dark:to-gray-850 bg-gradient-to-tl from-gray-900 to-slate-800 leading-pro text-sm ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25">Get OTP</button>
                        </div>
                    </form>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>

      </section>
    </main>

  </body>
@endsection

@push('scripts')
<script>
    if (document.getElementById("choices-countrySelect")) {
        var countrySelect = document.getElementById("choices-countrySelect");
        const customSelect = new Choices(countrySelect, {
            searchEnabled: false, // Disable search input
            shouldSort: false, // Do not sort options
            placeholderValue: "",
        });
    }
</script>

@endpush