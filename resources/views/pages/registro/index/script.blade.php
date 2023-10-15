
@section('script')

<script src="{{asset('assets/js/authentication/form-2.js')}}"></script>

<script>
    $(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        

    });

</script>

@endsection