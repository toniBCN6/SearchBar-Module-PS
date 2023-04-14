<div class="fmc-search-products">
    <form method="get" action="{$search_action}" class="fmc-search-form">
        <input type="text" name="search_query" value="{$search_query}" placeholder="{$search_query|default:'Search...'}" class="fmc-search-input">
        <input type="hidden" name="controller" value="search">
        <input type="hidden" name="orderby" value="position">
        <input type="hidden" name="orderway" value="desc">
        <button type="submit" class="fmc-search-button"><i class="icon-search"></i></button>
        <input type="hidden" name="search_query" value="{$search_query}">
        <input type="hidden" name="fc" value="module">
        <input type="hidden" name="module" value="fmc_searchproducts">
        <input type="hidden" name="token" value="{$search_token}">
    </form>
</div>