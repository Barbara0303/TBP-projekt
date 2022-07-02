@extends('layouts.layout')
@section('title', 'Dobrodošli')

@section('content')
<img src="{{asset('/img/trudnoca.avif')}}" width="100%" height="100%" alt="trudnoca">
<div id=footer>
            <div class="footer-basic">
                @include('partials.footer')
            </div>
        </div>

@endsection
