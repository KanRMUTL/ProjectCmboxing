@if($errors->any())
          <script>
               swal({
                    title:  '{{$title}}',
                    text:  '{{$message}}',
                    icon: 'warning'
               })
          </script>
@endif