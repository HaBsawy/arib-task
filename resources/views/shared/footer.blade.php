<form action="{{ route('logout') }}" method="post" id="logout-form">
    @csrf
</form>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/font-awesome/js/all.min.js') }}"></script>
<script src="{{ asset('js/elements.js') }}"></script>
<script src="{{ asset('js/plugin.js') }}"></script>
@yield('script')
</body>
</html>
