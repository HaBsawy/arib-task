@include('shared.head')
<?php
$title = 'elements-typography';
$titleParent = 'elements';
?>

<section class="site">
    @include('shared.side-bar')

    <section class="content">
        @include('shared.header')
        <div class="content-body">
            <h5>@yield('title')</h5>
            @yield('breadcrumb')
            <div class="mg-t-30">
                @yield('content')
            </div>
        </div>
        <footer>
            Copyright © {{ date('Y') }} Habsa. Designed by eslam.habsa All rights reserved.
        </footer>
    </section>
</section>

@include('shared.footer')
