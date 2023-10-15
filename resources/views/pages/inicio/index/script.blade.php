@section('script')
<script src="{{asset('plugins/apex/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/js/dashboard/dash_1.js')}}"></script>

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
