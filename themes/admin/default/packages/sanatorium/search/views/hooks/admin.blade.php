{{ Asset::queue('search', 'sanatorium/search::search.js', 'jquery') }}

{{ Asset::queue('underscore', 'underscore/js/underscore.js', 'jquery') }}

<script type="text/javascript">
    window.configuration.api.search = '{{ route('admin.sanatorium.search.api') }}';
</script>

        <!-- START OVERLAY -->
<div class="overlay hide" data-pages="search">
<!-- BEGIN Overlay Content !-->
<div class="overlay-content has-results m-t-20">
    <!-- BEGIN Overlay Header !-->
    <div class="container-fluid">
        <!-- BEGIN Overlay Close !-->
        <a href="#" class="close-icon-light overlay-close text-black fs-16">
            <i class="pg-close"></i>
        </a>
        <!-- END Overlay Close !-->
    </div>
    <!-- END Overlay Header !-->
    <div class="container-fluid">
        <!-- BEGIN Overlay Controls !-->
        <input id="overlay-search" class="no-border overlay-search bg-transparent" placeholder="{{ trans('sanatorium/search::general.search_placeholder') }}" autocomplete="off" spellcheck="false">
        <br>
        <div class="inline-block">
            <p class="fs-13">
                {{ trans('sanatorium/search::general.press_enter') }}
            </p>
        </div>
        <!-- END Overlay Controls !-->
    </div>
    <!-- BEGIN Overlay Search Results, This part is for demo purpose, you can add anything you like !-->
    <div class="container-fluid">
        @include('sanatorium/search::hooks/admin/item')
        <div class="search-results m-t-40">

        </div>
    </div>
    <!-- END Overlay Search Results !-->
</div>
<!-- END Overlay Content !-->