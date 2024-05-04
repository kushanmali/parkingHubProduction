<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('assets/js/plugins/chartjs.min.js')}}"></script>
<script src="{{asset('/assets/js/plugins/threejs.js')}}"></script>
<script src="{{asset('/assets/js/plugins/orbit-controls.js')}}"></script>
<script src="{{asset('/assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('/assets/js/plugins/choices.min.js')}}"></script>
<script src="{{asset('/assets/js/plugins/datatables.min.js')}}"></script>
<script src="{{asset('/assets/js/plugins/quill.min.js')}}"></script>
<script src="{{asset('/assets/js/plugins/chartjs.min.js')}}"></script>
<script src="{{asset('/assets/js/plugins/flatpickr.min.js')}}"></script>
<script src="{{asset('/assets/js/plugins/fullcalendar.min.js')}}"></script>
<script src="{{asset('/assets/js/plugins/dropzone.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/jkanban.min.js')}}"></script>
    <script src="{{asset('/assets/js/plugins/dragula.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<script>
    @if(Session::has('message'))
        Toastify({
            text: "{{ Session::get('message') }}",
            duration: 5000,  // Duration in milliseconds
            close: true,
            gravity: "bottom",  // Toast position: "top", "bottom", "left", "right"
            position: "right",  // Toast position: "top", "bottom", "left", "right"
            backgroundColor: "{{ Session::get('alert-type') === 'success' ? '#4CAF50' : '#FF3333' }}",  // Background color based on alert type
        }).showToast();
    @endif
</script>


<script>
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type','info') }}"
    switch(type){
       case 'info':
       toastr.info(" {{ Session::get('message') }} ");
       break;
   
       case 'success':
       toastr.success(" {{ Session::get('message') }} ");
       break;
   
       case 'warning':
       toastr.warning(" {{ Session::get('message') }} ");
       break;
   
       case 'error':
       toastr.error(" {{ Session::get('message') }} ");
       break; 
    }
    @endif 
</script>

<script>
  // Make sure this code is placed after including the Flatpickr library and the form HTML
  
  document.addEventListener("DOMContentLoaded", function () {
      flatpickr("#voucherDate", {
          allowInput: true,
          minDate: "today",
          dateFormat: "Y-m-d", // Set the desired date format
      });
  });
  
  </script>

<script>
    function ConfirmDelete(event, id) {
        event.preventDefault();
    
        // Show SweetAlert confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
    </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- main script file  -->
<script src="{{asset('/assets/js/soft-ui-dashboard-pro-tailwind.js?v=1.0.1')}}"></script>
