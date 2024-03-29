{if isset($posts) AND !empty($posts)}
    <div id="recent_article_smart_blog_block_left"  class="mt-40 pb-20 block block-blog blogModule boxPlain">
        <h4 class="text-uppercase h6"><a href="{smartblog::GetSmartBlogLink('smartblog')}">{l s='Recent Articles' mod='smartblogrecentposts'}</a></h4>
        <div class="block_content sdsbox-content">
            <ul class="recentArticles">
                {foreach from=$posts item="post"}
             {assign var="options" value=null}
             {$options.id_post= $post.id_smart_blog_post}
             {$options.slug= $post.link_rewrite}
                    <li>
                        <a class="image" title="{$post.meta_title}" href="{$smartbloglink->getSmartBlogPostLink($post.id_smart_blog_post,$post.link_rewrite)}">
                            <img class="img-fluid" alt="{$post.meta_title}" src="{$modules_dir}/smartblog/images/{$post.post_img}-home-small.jpg">
                        </a>
                        <a class="title"  title="{$post.meta_title}" href="{$smartbloglink->getSmartBlogPostLink($post.id_smart_blog_post,$post.link_rewrite)}">{$post.meta_title}</a>
                        <span class="info"><i class="zmdi zmdi-calendar-note"></i>{$post.created|date_format}</span>
                    </li>
                {/foreach}
            </ul>
        </div>
    </div>
{/if}