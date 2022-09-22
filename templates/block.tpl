{**
 * plugins/blocks/navigation/block.tpl
 *
 * Copyright (c) 2013-2019 Simon Fraser University
 * Copyright (c) 2003-2019 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Common site sidebar menu -- navigation links.
 *
 *}

 
{if !$currentJournal || $currentJournal->getSetting('publishingMode') != $smarty.const.PUBLISHING_MODE_NONE}
<div class="pkp_block block_navigation">
	<span class="title">{translate key="plugins.block.navigation.journalContent"}</span>
	<div class="content">
    {capture assign=searchFormUrl}{url page="search" op="search" escape=false}{/capture}
		{$searchFormUrl|parse_url:$smarty.const.PHP_URL_QUERY|parse_str:$formUrlParameters}
		<form id="simpleSearchForm" class="cmp_form" action="{$searchFormUrl|strtok:"?"|escape}">
			{foreach from=$formUrlParameters key=paramKey item=paramValue}
				<input type="hidden" name="{$paramKey|escape}" value="{$paramValue|escape}"/>
			{/foreach}

			{capture assign="filterInput"}{call_hook name="Templates::Search::SearchResults::FilterInput" filterName="simpleQuery" filterValue="" size=15}{/capture}

			{if empty($filterInput)}
				<p>
					<label for="simpleQuery">{translate key="navigation.search"}</label>
					<input type="text" id="simpleQuery" name="simpleQuery" size="15" maxlength="255" value="{$query|escape}" />
				</p>
			{else}
				{$filterInput}
			{/if}

			<p>
				<label for="searchField">{translate key="plugins.block.navigation.searchScope"}</label>
				<select id="searchField" name="searchField" size="1" class="selectMenu">
					{html_options_translate options=$articleSearchByOptions}
				</select>
			</p>

			<p><input type="submit" value="{translate key="common.search"}" class="cmp_button" /></p>
		</form>

		{if $currentJournal}
			<p class="subtitle">{translate key="navigation.browse"}</p>
			<ul>
				<li><a href="{url page="issue" op="archive"}">{translate key="navigation.browseByIssue"}</a></li>
				<li><a href="{url page="search" op="authors"}">{translate key="navigation.browseByAuthor"}</a></li>
				{* <li><a href="{url page="search" op="titles"}">{translate key="navigation.browseByTitle"}</a></li>*}
				{call_hook name="Plugins::Blocks::Navigation::BrowseBy"}
				{if $hasOtherJournals}
					<li><a href="{url journal="index"}">{translate key="navigation.otherJournals"}</a></li>
					{if $siteCategoriesEnabled}<li><a href="{url journal="index" page="search" op="categories"}">{translate key="navigation.categories"}</a></li>{/if}
				{/if}
			</ul>
		{/if}
	</div>
</div>
{/if}
