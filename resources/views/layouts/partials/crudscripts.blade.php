<script>

    $(document).ready(function(){
        toastr.options = {
                "progressBar": true,
                "positionClass": "toast-bottom-right",
                }

        window.addEventListener('hide-form', event =>{
        $('#form').modal('hide');
        toastr.success(event.detail.message, 'Success!');
        })

        window.addEventListener('alert', event =>{
        toastr.success(event.detail.message, 'Success!');
        })


    });

    window.addEventListener('show-form', event =>{
        $('#form').modal('show')
    })

    window.addEventListener('show-delete-modal', event =>{
        $('#confirmationModal').modal('show')
    })

    window.addEventListener('hide-delete-modal', event =>{
        $('#confirmationModal').modal('hide')
        toastr.success(event.detail.message, 'Success!');
    })

    window.addEventListener('updated', event =>{
        // $('#confirmationModal').modal('hide')
        toastr.success(event.detail.message, 'Success!');
    })

    @if(Session::has('message'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.success("{{ session('message') }}");
  @endif
</script>
