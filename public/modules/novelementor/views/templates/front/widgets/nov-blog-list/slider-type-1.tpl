{*
/******************
* Vinova Themes Framework for Prestashop 1.7.x
* @package    novmanagevcaddons
* @version    1.0.0
* @author     http://vinovathemes.com/
* @copyright  Copyright (C) May 2019 vinovathemes.com <@emai:vinovathemes@gmail.com>
* <vinovathemes@gmail.com>.All rights reserved.
* @license    GNU General Public License version 1
* *****************/
*}

{if isset($posts) && !empty($posts)}
    <div class="nov-bloglist slider-style-1 {$el_class}">
        <div class="block-blog clearfix">
            {if isset($title) && !empty($title)}
                <h2 class="title_block text-{$title_align} style-2">
                    <span class="title_content">{$title}</span>
                    {if isset($sub_title) && !empty($sub_title)}
                        <span class="sub_title">{$sub_title}</span>
                    {/if}
                </h2>
            {/if}
            <div class="block_content">
                <div class="nov-blogslick-owl row novblog-box-content slider-style-1 spacing-60" data-rows="{$number_row}" data-lg="{$xl}" data-md="{$md}" data-xs="{$xs}" data-arrows="{$show_arrows}" data-dots="{$show_dots}" data-autoplay="{$autoplay}">
                    {$xy= '1'}
                    {foreach from=$posts item=post}
                        {assign var="options" value=null}
                        {$options.id_post = $post.id}
                        {$options.slug = $post.link_rewrite}
                        <div class="item post-item col">
                            <div class="post-item">
                                {if $xy mod 2 eq 0}    
                                    <div class="post-image " style="height:300px;">
                                        <a class="img-a" href="{smartblog::GetSmartBlogLink('smartblog_post', $options)}">
                                            <img alt="{$post.title}" class="feat_img_small img-fluid" src="{$nov_modules_dir}/smartblog/images/{$post.post_img}-home-default.jpg">
                                        </a>
                                    </div>
                                {else}
                                    <div class="post-image">
                                        <a class="img-a" href="{smartblog::GetSmartBlogLink('smartblog_post', $options)}">
                                            <img alt="{$post.title}" class="feat_img_small img-fluid" src="{$nov_modules_dir}/smartblog/images/{$post.post_img}-home-default.jpg">
                                        </a>
                                    </div>
                                {/if}
                                <div class="blog-content">
                                    <div class="post_title"><a href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}">{$post.title}</a></div>
                                    <div class="post-desc">
                                        {$post.short_description|strip_tags:'UTF-8'|truncate:120:'...'}
                                    </div>
                                    <div class="d-flex mt-20">
                                        <div class="author">
                                            <i class="zmdi zmdi-account-o"></i>
                                            {l s='by' d='Modules.Blog'} {$post.firstname}{$post.lastname}
                                        </div>
                                        <div class="post-time">
                                            <i class="zmdi zmdi-calendar-note"></i>
                                            {$post.date_added|date_format:"%b %d ,%G"}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {$xy= $xy +1}              
                    {/foreach}
                </div>
            </div>
        </div>
    </div>
{/if}