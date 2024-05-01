@extends('layouts.admin.app')

@section('content')

<div class="w-full p-6 mx-auto">

    <div class="justify-between flex w-full sm:flex pb-2">
    <div class="flex w-full flex-wrap -mx-3">
        <div class="w-full max-w-full px-3 shrink-0 lg:flex-0 lg:w-6/12">
            <h4 class="dark:text-white mx-3 text-lg">Owners</h4>
        </div>
    </div>
    <div>
        <a href="{{route('newOwner')}}" class="whitespace-nowrap inline-block px-8 py-2 font-bold text-center uppercase align-middle transition-all bg-transparent border-solid rounded-lg shadow-none cursor-pointer active:opacity-85 leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:shadow-soft-xs border border-orange-700 text-orange-500 hover:text-orange-500 hover:opacity-75 hover:shadow-none active:scale-100 active:border-orange-500 active:bg-orange-500 active:text-white hover:active:border-orange-500 hover:active:bg-transparent hover:active:text-orange-500 hover:active:opacity-75"><i class="fas fa-plus mr-2"></i> New Owners</a>
    </div>
     
      <div class="flex">
      <div class="p-2">
        @if($errors->any())
            <div class="bg-red-300 text-white rounded-3 p-6 my-5">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
      </div>
      </div>
    </div>

    <div class="flex flex-wrap -mx-3">
      <div class="w-full max-w-full px-3 flex-0">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 dark:bg-gray-950 dark:shadow-soft-dark-xl shadow-soft-xl rounded-2xl bg-clip-border">
          <div class="overflow-x-auto">
            <table class="table table-flush" datatable id="datatable-search-list">
                <thead class="thead-light">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($owners as $owner)
                    <tr>
                        <td>
                            <div class="flex items-center">
                                <div class="min-h-6 pl-7 mb-0.5 block">
                                    <span class="my-2 leading-tight text-xs">{{ $owner->id }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="font-semibold">
                            <span class="my-2 leading-tight text-xs">{{ $owner->name }}</span>
                        </td>
                        <td class="font-semibold leading-tight text-xs">
                            <div class="flex items-center">
                                <span class="my-2 leading-tight text-xs">{{ $owner->email }}</span>
                            </div>
                        </td>
                        <td class="font-semibold leading-tight text-xs">
                            <div class="flex items-center">
                                <span class="my-2 leading-tight text-xs">{{ $owner->phone }}</span>
                            </div>
                        </td>
                        <td class="font-semibold leading-tight text-sm">
                            <div class="flex items-center gap-x-3">
                                <a href="{{route('owner', $owner->id )}}"> <i class="fas fa-eye text-slate-400 dark:text-white/70" aria-hidden="true"></i></a>
                                <a href="{{route('updateOwner', $owner->id )}}"><i class="fas fa-pencil-alt text-slate-400 dark:text-white/70" aria-hidden="true"></i></a>
                                <form action="{{ route( 'deleteOwner', $owner->id ) }}" id="delete-form-{{ $owner->id }}" method="POST">
                                    @csrf
                                    <button type="submit" onclick="ConfirmDelete(event, {{ $owner->id }})"><i class="fas fa-trash text-slate-400 dark:text-white/70" aria-hidden="true"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>            
          </div>
        </div>
      </div>

    </div>
</div>
    
@endsection