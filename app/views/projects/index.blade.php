@extends('templates.main')

{{-- Content --}}
@section('content')

    @if($type == 'billing')
        @include('projects.table-billing')
    @elseif($type == 'archive')
        @include('projects.table-archive')
    @else
        @include('projects.table-normal')
    @endif

@stop

{{-- Javascript --}}
@section('javascript')
    <script type="text/javascript">
        (function($) {
            $(document).ready(function() {
                //
            })
        })(jQuery);
    </script>
@stop