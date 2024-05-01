@extends('auth.layouts.app')

@section('content')

<div class="w-full flex-col h-screen mx-auto">

    <form class="relative h-screen flex-col items-center justify-center" enctype="multipart/form-data" id="main-form"  action="{{ route('storeUser') }}" method="post">
        @csrf

        <div class="flex flex-wrap h-screen items-center justify-center -mx-3">
            <div class="w-full max-w-full px-3 mt-6 shrink-0 lg:flex-0 lg:w-5/12 lg:mt-0">
                <div class="relative flex flex-col min-w-0 break-words bg-white border-0 dark:bg-gray-950 dark:shadow-soft-dark-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-6">
                        <a class="flex -ml-4 justify-center items-center m-0 text-sm whitespace-nowrap text-slate-700 dark:text-white" href="{{route('index')}}">
                            <img src="{{asset('assets/img/parking-hub-icon.jpg')}}" class="inline-block h-full max-w-full transition-all duration-200 ease-soft-in-out max-h-16 dark:hidden" alt="main_logo" />
                            <img src="{{asset('assets/img/parking-hub-icon.jpg')}}" class="hidden h-full max-w-full transition-all duration-200 ease-soft-in-out max-h-16 dark:inline-block" alt="main_logo" />
                            <h4 class="font-bold ml-2 text-4xl mb-0">Parking<span class="bg-gradient-to-tl from-green-600 to-teal-400 bg-clip-text text-transparent text-4xl"> HUB</span></h4>
                        </a>

                        <h5 class="pb-3 text-center pt-6">Owner Registration</h5>
                        <div class="flex flex-wrap -mx-3">
                            <div class="w-full max-w-full px-3 flex-0">
                                <label class=" mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="UserName">User Name</label>
                                <input type="text" name="UserName" placeholder="username" class="{{ $errors->has('UserName') ? 'border-red-500' : 'border-gray-300' }}  focus:shadow-soft-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-black focus:outline-none" value="{{ old('UserName') }}"/>
                                @error('UserName')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3">
                            <div class="w-full max-w-full px-3 mt-4 flex-0 sm:mt-0">
                                <label class="mt-6 mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="email">Email</label>
                                <input type="email" name="email" placeholder="example@org.com"  class="{{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} focus:shadow-soft-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-black focus:outline-none" value="{{ old('email') }}"/>
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full max-w-full px-3 flex-0">
                                <label class="mt-6 mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="phone">Phone</label>
                                <input type="text" name="phone" placeholder="XXXXXXXXXX" class="{{ $errors->has('phone') ? 'border-red-500' : 'border-gray-300' }} focus:shadow-soft-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-black focus:outline-none" value="{{ old('phone') }}"/>
                                @error('phone')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3">
                            <div class=" w-full max-w-full px-3 mt-4 flex-0  sm:mt-0">
                                <label class=" mt-6 inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="password">Password</label>
                                <input type="password" name="password" placeholder="password" class="{{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }} focus:shadow-soft-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-black focus:outline-none" />
                                @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full max-w-full px-3 flex-0 ">
                                <label class="mt-6 inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="ConfirmPassword">Confirm password</label>
                                <input type="password" name="password_confirmation" placeholder="Confirm password" class="{{ $errors->has('password_confirmation') ? 'border-red-500' : 'border-gray-300' }}focus:shadow-soft-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-black focus:outline-none" />
                            </div>
                        </div>

                       
                    
                       
                        <div class="hidden">

                            <div class="relative {{ $errors->has('roles') ? 'border-red-500' : 'border-gray-300' }} flex flex-col h-fit bg-white p-5 rounded-lg border-0.4 border-gray-300 cursor-pointer">
                                <label>
                                <input checked  id="checkbox-1" name="roles[]" value="Owner" class="w-5 h-5 ease-soft text-base mr-4 rounded-1.4 checked:bg-gradient-to-tl checked:from-gray-900 checked:to-slate-800 after:text-xxs after:font-awesome after:duration-250 after:ease-soft-in-out duration-250 relative float-left mt-1 cursor-pointer appearance-none border border-solid border-slate-150 bg-white bg-contain bg-center bg-no-repeat align-top transition-all after:absolute after:flex after:h-full after:w-full after:items-center after:justify-center after:text-white after:opacity-0 after:transition-all after:content-['\f00c'] checked:border-0 checked:border-transparent checked:bg-transparent checked:after:opacity-100" type="checkbox" />
                                <label for="checkbox-1" class="cursor-pointer select-none text-slate-700">Admin</label>
                                </label>
                            </div>
            
                        </div>
                      

                        <div class="">
                            <button type="submit" href="javascript:;" class="inline-block w-full px-6 py-4 mt-2 mb-6 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-blue-600 to-cyan-400 hover:border-slate-700 hover:bg-slate-700 hover:text-white">Register</button>
                        </div>
                    </div>
                </div>
            </div> 

            
        
        </div>

        
    </form>

  </div>
    
@endsection
