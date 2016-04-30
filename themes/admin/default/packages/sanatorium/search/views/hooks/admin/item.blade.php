

<script type="text/template" id="search-results" data-template="results">

    <p class="bold">
        {{ trans('sanatorium/search::general.results') }}
    </p>

    <% _.each(results, function(r) { %>

    <div class="row">
        <div class="col-md-12">
            <div class="">
                <a href="<%= r.url %>" class="inline p-t-5">
                    <h5 class="m-b-5">
                        <span class="semi-bold result-name"><%= r.name %></span>
                    </h5>
                    <p class="hint-text"><%= r.description %></p>
                </a>
            </div>
        </div>
    </div>

    <% }); %>

</script>