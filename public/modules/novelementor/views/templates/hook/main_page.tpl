{$ver=$nov_elements->getVersion()}
<div class="elementor elementor-{$page_id|intval}" data-version="{$ver}">
    <div id="elementor-inner">
        <div id="elementor-section-wrap">
            {foreach from=$page_data item=section_data}
                {include file=$smarty.const._PS_MODULE_DIR_|cat:'novelementor/views/templates/hook/element_section.tpl' this = NovElementor::factory('ElementSection', $section_data)}
            {/foreach}
        </div>
    </div>
</div>