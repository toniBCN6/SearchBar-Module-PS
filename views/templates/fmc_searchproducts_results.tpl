{if $results}
<div class="fmc-search-results">
    <h3 class="fmc-search-title">{$search_query|default:'Search results'}</h3>
    <ul class="fmc-search-list">
        {foreach $results as $result}
        <li class="fmc-search-item">
            <a href="{$result.url}" class="fmc-search-link">{$result.name}</a>
        </li>
        {/foreach}
    </ul>
</div>
{else}
<div class="fmc-search-no-results">
    <h3 class="fmc-search-title">{$search_query|default:'Search results'}</h3>
    <p class="fmc-search-message">{l s='No results found' mod='fmc_searchproducts'}</p>
</div>
{/if}