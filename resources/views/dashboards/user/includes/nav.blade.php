<nav navbar-main class=" flex  bg-transparent flex-wrap items-center justify-between px-0 py-2 mx-6 mt-6 transition-all  duration-250 ease-soft-in rounded-lg lg:flex-nowrap lg:justify-start top-[1%]  z-110 dark:bg-gray-950/80 ">
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
            <a sidenav-trigger class="block p-0 rounded-full px-4 py-5 transition-all ease-nav-brand text-sm text-slate-500 dark:text-white" href="javascript:;" aria-expanded="false">
              <div class="w-4.5 overflow-hidden">
                @if(isset($home))
                <i class="ease-soft mb-0.75 relative block h-0.5 rounded-sm {{ $home ? 'bg-white' : 'bg-slate-500' }} transition-all dark:bg-white"></i>
                <i class="ease-soft mb-0.75 relative block h-0.5 rounded-sm  {{ $home ? 'bg-white' : 'bg-slate-500' }} transition-all dark:bg-white"></i>
                <i class="ease-soft relative block h-0.5 rounded-sm  {{ $home ? 'bg-white' : 'bg-slate-500' }} transition-all dark:bg-white"></i>
              @else
                <i class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all dark:bg-white"></i>
                <i class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all dark:bg-white"></i>
                <i class="ease-soft relative block h-0.5 rounded-sm bg-slate-500 transition-all dark:bg-white"></i>
              @endif
              </div>
            </a>
          </li>
          <li class="hidden items-center px-4">
            <a href="javascript:;" class="p-0 transition-all text-sm ease-nav-brand text-slate-500 dark:text-white">
              <i fixed-plugin-button-nav class="cursor-pointer fa fa-cog" aria-hidden="true"></i>
              <!-- fixed-plugin-button-nav  -->
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>