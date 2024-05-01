@extends('layouts.owner.app')

@section('content')

<div class="w-full px-6 mx-auto mt-4">

  <div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 flex-0">
      <div class="relative flex flex-col min-w-0 break-words bg-white border-0 dark:bg-gray-950 dark:shadow-soft-dark-xl shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
          <div class="lg:flex">
            <div>
              <h5 class="mb-0 dark:text-white">My parking Sessions</h5>
            </div>
            <div class="my-auto mt-6 ml-auto lg:mt-0">
              {{-- <div class="my-auto ml-auto">
                <a href="{{url('/new-parking')}}" class="inline-block px-8 py-2 m-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-gradient-to-tl from-purple-700 to-pink-500 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">+&nbsp; New Parking</a>
              </div> --}}
            </div>
          </div>
        </div>
        <div class="flex-auto p-6 px-0 pb-0">
          <div class="overflow-x-auto table-responsive">
            <table class="table" datatable id="products-list">
              <thead class="thead-light">
                <tr>
                    <th>Customer Name</th>
                    <th>Start Time</th>
                    <th>Status</th>
                    <th>Run Timer</th>
                    <th>End Time</th>
                    <th>Balance</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>

                @if($activeSessions)
                @foreach ($activeSessions as $activeParkingSessions)
                    @foreach ($activeParkingSessions as $session)
                    <tr>
                        <td>
                            <div class="flex">
                                <h6 class="my-auto ml-4 dark:text-white">{{$session->customer->name}}</h6>
                            </div>
                        </td>
                        <td class="leading-normal text-sm">{{$session->parking->parking_name}}</td>
                
                        <td class="leading-normal text-sm">{{ (new DateTime($session->start_time))->format('H:i:s') }}</td>
                        <td class="leading-normal text-sm">{{$session->status}}</td>
                        <td class="leading-normal text-sm" id="timer-{{$session->id}}"></td>
                        <td class="leading-normal text-sm">{{$session->end_time ? $session->end_time : 'N/A'}}</td>
                        <td class="leading-normal text-sm">{{$session->bill_price ? $session->bill_price : 'N/A'}}</td>
                        <td class="leading-normal text-sm">
                            <div class="flex justify-end items-center">
                                <button class="flex items-center text-green-600 font-bold gap-2" type="button" id="finish-session-btn" onclick="ConfirmFinish(event, {{ $session->id }})" class="mx-4">
                                    <i class="fas fa-flag text-green-600 dark:text-white/70"></i> Finish
                                </button>
                               
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @endforeach
              
            @endif
            
              </tbody>
              <tfoot>
                <tr>
                    <th>Customer Name</th>
                    <th>Start Time</th>
                    <th>Status</th>
                    <th>Timer</th>
                    <th>End Time</th>
                    <th>Balance</th>
                    <th>Action</th>
                </tr>
              </tfoot>
            </table>                  
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection

@push('scripts')

@if(isset($session)) 
<script>
    // Get the start time of the session
    var startTime{{$session->id}} = new Date("{{$session->start_time}}").getTime();
    
    // Update the runtime every second
    setInterval(function() {
        // Get the current time
        var now = new Date().getTime();
        
        // Calculate the elapsed time
        var elapsedTime = now - startTime{{$session->id}};
        
        // Calculate hours, minutes, and seconds
        var hours = Math.floor(elapsedTime / (1000 * 60 * 60));
        var minutes = Math.floor((elapsedTime % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((elapsedTime % (1000 * 60)) / 1000);
        
        // Display the elapsed time in the "Runtime" column
        document.getElementById("timer-{{$session->id}}").innerText = hours + "h " + minutes + "m " + seconds + "s ";
    }, 1000);
</script>


<script>
    function ConfirmFinish(event, id) {
        event.preventDefault();

        // Show SweetAlert confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text: "Once finished, you cannot undo this action!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, finish it!',
        }).then((result) => {
            // If user confirms the action
            if (result.isConfirmed) {
                // Redirect user to finish session route
                window.location.href = "{{ route('finishSession', $session->id) }}";
            }
        });
    }
</script>

@endif


@endpush