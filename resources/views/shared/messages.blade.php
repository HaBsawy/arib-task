<div class="col-12">
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @endif


{{--    @if($errors->any())--}}
{{--        <ul class="list-unstyled">--}}
{{--            @foreach ($errors->all() as $error)--}}
{{--                <div class="alert alert-danger">--}}
{{--                    {{ $error }}--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    @endif--}}
</div>
