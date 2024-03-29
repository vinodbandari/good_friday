{extends file='page.tpl'}
{block name='page_content_container'}
	{if !empty($page_data)}
		{include file=$smarty.const._PS_MODULE_DIR_|cat:'novelementor/views/templates/hook/main_page.tpl'}
	{else}
		{include file=$smarty.const._PS_MODULE_DIR_|cat:'novelementor/views/templates/hook/empty_page.tpl'}
	{/if}
{/block}