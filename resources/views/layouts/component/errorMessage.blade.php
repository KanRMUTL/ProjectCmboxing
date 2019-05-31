@if($errors->any())
          <script>
               swal({
                    title:  '{{$title}}',
                    text:  '{{$message}}',
                    icon: 'error'
               })
          </script>
@endif