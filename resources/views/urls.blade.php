@extends("layouts.app")

@section ("styles")
@endsection()

@section('content')
        <get-urls></get-urls>

        <!-- <div id="app" class="wrapper_url_shortner">
            <urls authorized-user = "{{ auth()->user()->id ?? null}}"></urls>
        </div> -->
@endsection()
