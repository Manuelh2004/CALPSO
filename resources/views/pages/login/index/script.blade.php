
@section('script')

<script src="{{asset('assets/js/authentication/form-1.js')}}"></script>

<script>
    $(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        @include("pages.login.autenticacion.autenticacion_script");

    });

</script>

@endsection