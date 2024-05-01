<nav navbar-main class=" flex  bg-transparent flex-wrap items-center justify-between px-0 py-2 mx-6 mt-6 transition-all  duration-250 ease-soft-in rounded-lg lg:flex-nowrap lg:justify-start sticky top-[1%]  z-110 dark:bg-gray-950/80 " navbar-scroll="true">
    <div class="flex items-center justify-between w-full px-4 py-2 mx-auto flex-wrap-inherit">
      <nav>
  
       
        
      </nav>
  
      <div class="flex pr-4 items-center">
        <a mini-sidenav-burger href="javascript:;" class="hidden p-0 transition-all ease-nav-brand text-sm text-slate-500 xl:block" aria-expanded="false">
          <div class="w-4.5 overflow-hidden">
            <i class="ease-soft mb-0.75 relative block h-0.5 translate-x-[5px] rounded-sm bg-slate-500 transition-all dark:bg-white"></i>
            <i class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all dark:bg-white"></i>
            <i class="ease-soft relative block h-0.5 translate-x-[5px] rounded-sm bg-slate-500 transition-all dark:bg-white"></i>
          </div>
        </a>
      </div>
  

  
      
  
      <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto" id="navbar">  
        <div class="flex items-center justify-end md:ml-auto md:pr-4">
  
          
  
          {{-- <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease-soft">
            <span class="text-sm ease-soft leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
              <i class="fas fa-search" aria-hidden="true"></i>
            </span>
            <input type="text" class="pl-9 text-sm focus:shadow-soft-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 ease-soft w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Type here..." />
          </div> --}}
        </div>
        <ul class="flex flex-row items-center justify-end pl-0 mb-0 list-none md-max:w-full">
  
       
          
          <!-- online builder btn  -->
          <!-- <li class="flex items-center">
          <a class="inline-block px-8 py-2 mb-0 mr-4 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro border-fuchsia-500 ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs text-fuchsia-500 hover:border-fuchsia-500 active:bg-fuchsia-500 active:hover:text-fuchsia-500 hover:text-fuchsia-500 tracking-tight-soft hover:bg-transparent hover:opacity-75 hover:shadow-none active:text-white active:hover:bg-transparent" target="_blank" href="https://www.creative-tim.com/builder/soft-ui?ref=navbar-dashboard&amp;_ga=2.76518741.1192788655.1647724933-1242940210.1644448053">Online Builder</a>
        </li> -->
          
          <li class="flex items-center -pr-12 xl:hidden">
            <a sidenav-trigger class="block p-0 bg-white rounded-full px-4 py-5 transition-all ease-nav-brand text-sm text-slate-500 dark:text-white" href="javascript:;" aria-expanded="false">
              <div class="w-4.5 overflow-hidden">
                <i class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all dark:bg-white"></i>
                <i class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all dark:bg-white"></i>
                <i class="ease-soft relative block h-0.5 rounded-sm bg-slate-500 transition-all dark:bg-white"></i>
              </div>
            </a>
          </li>
          <li class="hidden items-center px-4">
            <a href="javascript:;" class="p-0 transition-all text-sm ease-nav-brand text-slate-500 dark:text-white">
              <i fixed-plugin-button-nav class="cursor-pointer fa fa-cog" aria-hidden="true"></i>
              <!-- fixed-plugin-button-nav  -->
            </a>
          </li>
  
          <li class="flex items-center">
            <div class="relative">
              <button dropdown-trigger aria-expanded="false" type="button" class="inline-block p-0 mr-4 cursor-pointer">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                          <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                  @else
                      <span class="inline-flex rounded-md">
                              {{ Auth::user()->name }}
  
                              <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                              </svg>
                      </span>
                  @endif
              </button>
              <p class="hidden transform-dropdown-show"></p>
              <ul dropdown-menu class="z-10 -mt-2 -ml-32 text-sm lg:shadow-soft-3xl dark:bg-black duration-250 before:duration-350 before:font-awesome before:ease-soft min-w-44 transform-dropdown pointer-events-none absolute left-auto right-auto    list-none rounded-lg border-0 border-solid border-transparent bg-white bg-clip-padding px-0 py-2 text-left text-slate-500 opacity-0 transition-all before:absolute before:right-7 before:left-auto before:top-0 before:z-40 before:text-white before:transition-all before:content-['\f0d8']">
                <li>
                  <a href="{{ route('profile.show') }}" class="py-1.2 lg:ease-soft  clear-both block w-full whitespace-nowrap border-0 bg-transparent px-4 text-left text-slate-500 hover:bg-gray-200 hover:text-slate-700 dark:text-white dark:hover:bg-gray-200/80 dark:hover:text-slate-700 lg:transition-colors font-bold lg:duration-300" href="javascript:;"> {{ __('Profile') }}</a>
                </li>
                <li>
                  @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                  <a href="{{ route('api-tokens.index') }}" class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap border-0 bg-transparent px-4 text-left font-normal text-slate-500 hover:bg-gray-200 hover:text-slate-700 dark:text-white dark:hover:bg-gray-200/80 dark:hover:text-slate-700 lg:transition-colors lg:duration-300">
                      {{ __('API Tokens') }}
                  </a>
              @endif
                </li>
                <li>
                  <form id="logout-form" method="POST" action="{{ route('logout') }}">
                    @csrf
                
                    <button type="submit" class="py-1.2 lg:ease-soft font-bold clear-both block w-full whitespace-nowrap border-0 bg-transparent px-4 text-left text-slate-500 hover:bg-gray-200 hover:text-slate-700 dark:text-white dark:hover:bg-gray-200/80 dark:hover:text-slate-700 lg:transition-colors lg:duration-300">
                        {{ __('Log Out') }}
                    </button>
                </form>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>