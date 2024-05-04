<aside mini="false" class="dark:bg-gray-950  ease-soft-in-out z-990 max-w-64 dark: fixed inset-y-0 left-0 my-4 xl:ml-4 block w-full -translate-x-full flex-wrap items-center justify-between overflow-y-auto rounded-2xl border-0 bg-white p-0 shadow-none transition-all duration-200 xl:translate-x-0 xl:bg-transparent" id="sidenav-main">
    <!-- header -->
  
    <div class="h-20">
      <i class="absolute top-60 right-0 p-4 opacity-50 cursor-pointer fas fas fa-chevron-left font-bold text-green-800 dark:text-white xl:hidden" aria-hidden="true" sidenav-close-btn></i>
  
      <a class="flex justify-center items-center px-8 py-6 m-0 text-sm whitespace-nowrap text-slate-700 dark:text-white" href="{{url('/setdashboard')}}">
        <img src="{{asset('assets/img/parking-hub-icon.jpg')}}" class="inline-block h-full max-w-full transition-all duration-200 ease-soft-in-out max-h-10 dark:hidden" alt="main_logo" />
        <img src="{{asset('assets/img/parking-hub-icon.jpg')}}" class="hidden h-full max-w-full transition-all duration-200 ease-soft-in-out max-h-10 dark:inline-block" alt="main_logo" />
        <span class="ml-1 text-3xl text-transparent bg-clip-text bg-gradient-to-tl from-green-600 to-teal-400 font-bold  transition-all duration-200 ease-soft-in-out"><span class="text-black">Parking</span> HUB</span>
      </a>
    </div>
    
    <!-- //---------hr----------// -->
  
    <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />
  
    <div class="items-center block w-full h-auto grow basis-full" id="sidenav-collapse-main">
      <!-- primary list  -->
  
      <ul class="flex flex-col mx-2 pl-0 mb-0 list-none">

        <li class="mt-0.5">
            <a href="javascript:;" class="text-sm py-2.7 active xl:shadow-soft-xl my-0 flex items-center whitespace-nowrap rounded-lg bg-white px-4 font-semibold transition-all dark:text-white dark:opacity-80">
              
              <div class="stroke-none shadow-soft-sm bg-gradient-to-tl from-white to-white mr-2 flex h-12 w-12 items-center justify-center rounded-lg bg-white bg-center fill-current p-2.5 text-center text-black">
                <svg width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                  <g id="SVGRepo_iconCarrier"> <path d="M8 13H16C17.7107 13 19.1506 14.2804 19.3505 15.9795L20 21.5M8 13C5.2421 12.3871 3.06717 10.2687 2.38197 7.52787L2 6M8 13V18C8 19.8856 8 20.8284 8.58579 21.4142C9.17157 22 10.1144 22 12 22C13.8856 22 14.8284 22 15.4142 21.4142C16 20.8284 16 19.8856 16 18V17" stroke="#003cff" stroke-width="1.5" stroke-linecap="round"/> <circle cx="12" cy="6" r="4" stroke="#003cff" stroke-width="1.5"/> </g>
                  </svg>
              </div>

              <span class="font-bold text-sm">Profile</span>
            </a> 
        </li>


        <li class="mt-0.5">
            <a href="{{route('myMap')}}" class="text-sm py-2.7 active xl:shadow-soft-xl my-0 flex items-center whitespace-nowrap rounded-lg bg-white px-4 font-semiboldtransition-all dark:text-white dark:opacity-80" aria-controls="applicationsExamples" role="button" aria-expanded="true">
              <div class="stroke-none shadow-soft-sm bg-gradient-to-tl from-white to-white mr-2 flex h-12 w-12 items-center justify-center rounded-lg bg-white bg-center fill-current p-2.5 text-center text-black">
                <svg width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                    <g id="SVGRepo_iconCarrier"> <path d="M5.7 15C4.03377 15.6353 3 16.5205 3 17.4997C3 19.4329 7.02944 21 12 21C16.9706 21 21 19.4329 21 17.4997C21 16.5205 19.9662 15.6353 18.3 15M12 9H12.01M18 9C18 13.0637 13.5 15 12 18C10.5 15 6 13.0637 6 9C6 5.68629 8.68629 3 12 3C15.3137 3 18 5.68629 18 9ZM13 9C13 9.55228 12.5523 10 12 10C11.4477 10 11 9.55228 11 9C11 8.44772 11.4477 8 12 8C12.5523 8 13 8.44772 13 9Z" stroke="#007bff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/> </g>  
                </svg>
              </div>

              <span class="font-bold text-sm">Map</span>
            </a>  
        </li>

        <li class="mt-0.5">
          <form class="w-full" id="logout-form" method="POST" action="{{ route('logout') }}">
            @csrf
        
            <button type="submit" class="text-sm w-full py-2.7 active xl:shadow-soft-xl my-0 flex items-center whitespace-nowrap rounded-lg bg-white px-4 font-semiboldtransition-all dark:text-white dark:opacity-80">
              <div class="stroke-none shadow-soft-sm bg-gradient-to-tl from-white to-white mr-2 flex h-12 w-12 items-center justify-center rounded-lg bg-white bg-center fill-current p-2.5 text-center text-black">
                <svg width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ff0000">
                  <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                  <g id="SVGRepo_iconCarrier"> <path d="M12 3.25C12.4142 3.25 12.75 3.58579 12.75 4C12.75 4.41421 12.4142 4.75 12 4.75C7.99594 4.75 4.75 7.99594 4.75 12C4.75 16.0041 7.99594 19.25 12 19.25C12.4142 19.25 12.75 19.5858 12.75 20C12.75 20.4142 12.4142 20.75 12 20.75C7.16751 20.75 3.25 16.8325 3.25 12C3.25 7.16751 7.16751 3.25 12 3.25Z" fill="#ff0000"/> <path d="M16.4697 9.53033C16.1768 9.23744 16.1768 8.76256 16.4697 8.46967C16.7626 8.17678 17.2374 8.17678 17.5303 8.46967L20.5303 11.4697C20.8232 11.7626 20.8232 12.2374 20.5303 12.5303L17.5303 15.5303C17.2374 15.8232 16.7626 15.8232 16.4697 15.5303C16.1768 15.2374 16.1768 14.7626 16.4697 14.4697L18.1893 12.75H10C9.58579 12.75 9.25 12.4142 9.25 12C9.25 11.5858 9.58579 11.25 10 11.25H18.1893L16.4697 9.53033Z" fill="#ff0000"/> </g>
                  </svg>
              </div>

              <span class="font-bold text-sm">Logout</span>
            </button>
        </form>
      </li>
      </ul>
    </div>
  
    <div class="pt-4 mx-4 mt-4">
      <!-- load phantom colors for card after: -->
     
      <div sidenav-card class="after:opacity-65 hidden bg-gradient-to-tl from-blue-600 to-cyan-400 relative min-w-0 flex-col items-center break-words rounded-2xl border-0 border-solid border-blue-900 bg-white bg-clip-border shadow-none after:absolute after:top-0 after:bottom-0 after:left-0 after:z-10 after:block after:h-full after:w-full after:rounded-2xl after:content-['']">
        <div class="mb-7 absolute h-full w-full rounded-2xl bg-cover bg-center"></div>
        <div class="relative z-20 flex-auto w-full p-4 text-left text-white">
          <div class="flex items-center justify-center w-8 h-8 mb-4 text-center bg-white bg-center rounded-lg icon shadow-soft-2xl">
            <i sidenav-card-icon class="top-0 z-10 text-transparent  leading-none fas fa-file text-lg bg-gradient-to-tl from-slate-600 to-slate-300 bg-clip-text opacity-80" aria-hidden="true"></i>
          </div>
          <div class="transition-all duration-200 ease-nav-brand">
            <h6 class="mb-0 text-white"></h6>
            <p class="mt-0 mb-4 font-semibold leading-tight text-xs"></p>
            <a href="{{url('doc_manager/dashboard')}}" target="_blank" class="inline-block w-full px-8 py-2 mb-0 font-bold text-center text-black uppercase transition-all ease-in bg-white border-0 border-white rounded-lg shadow-soft-md bg-150 leading-pro text-xs hover:shadow-soft-2xl hover:scale-102">Document Manager</a>
          </div>
        </div>
      </div>
  
      <!-- pro btn  -->
      <!-- <a class="inline-block w-full px-6 py-3 my-4 font-bold text-center text-white uppercase align-middle transition-all ease-in border-0 rounded-lg select-none shadow-soft-md bg-150 bg-x-25 leading-pro text-xs bg-gradient-to-tl from-purple-700 to-pink-500 hover:shadow-soft-2xl hover:scale-102" href="https://www.creative-tim.com/product/soft-ui-dashboard-pro?ref=sidebarfree">Upgrade to pro</a> -->
    </div>
  </aside>