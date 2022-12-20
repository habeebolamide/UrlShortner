@extends("layouts.app")

@section ("styles")
@endsection()

@section('content')
        <div id="app" class="wrapper_url_shortner">
            <url-shortener authorized-user = "{{ auth()->user()->id ?? null}}"></url-shortner>
        </div>
@endsection()
