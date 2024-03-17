@extends('master')
@section('title', 'Home')
@section('style')
    <link rel="stylesheet" href="{{ asset('plugins/jquery-confirm/jquery-confirm.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
@endsection

@section('content')



@endsection

@section('script')
    <script src="{{ asset('plugins/jquery-confirm/jquery-confirm.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    <script>
        const APP_URL = '{{ url('/') }}';
    </script>
@endsection
