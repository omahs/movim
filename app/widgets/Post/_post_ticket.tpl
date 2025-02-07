<li id="{$post->nodeid|cleanupId}"
    class="block {if="$post->embed"}embed{/if}"
    onclick="MovimUtils.reload('{$c->route('post', [$post->server, $post->node, $post->nodeid])}'); Drawer.clear()">
    {if="$post->picture != null"}
        <img class="main"
            src="{$post->picture->href|protectPicture}"
            {if="!empty($post->picture->title)"}
                alt="{$post->picture->title}"
                title="{$post->picture->title}"
            {/if}>
        <span class="control icon thumb color
            {if="$post->contact"}
                {$post->contact->jid|stringToColor}
            {else}
                {$post->node|stringToColor}
            {/if}
        "
            style="background-image: url({$post->picture->href|protectPicture});"
        >
        </span>
    {elseif="!$post->contact"}
        <span class="control icon bubble">
            {if="$post->info"}
                <img src="{$post->info->getPicture('m')}">
            {else}
                <img src="{$post->node|avatarPlaceholder}">
            {/if}
        </span>
    {/if}
    <div>
        <p class="line two" title="{$post->getTitle()}">
            {autoescape="off"}
                {$post->getTitle()}
            {/autoescape}
        </p>
        <p dir="auto">{autoescape="off"}{$post->getSummary()|prepareString}{/autoescape}</p>
        <p>
            {if="$post->contact"}
                <span class="icon bubble tiny">
                    <img src="{$post->contact->getPicture()}">
                </span>
                <a href="{$c->route('contact', $post->contact->jid)}">
                    {$post->contact->truename}
                </a>
            {/if}

            {if="!$post->isMicroblog()"}
                <a class="node"
                   title="{$post->server} / {$post->node}"
                   href="{$c->route('community', [$post->server, $post->node])}">
                   {if="$post->contact"}·{/if}
                   {$post->node}
                </a>
            {/if}

            <span class="info" title="{$post->published|strtotime|prepareDate}">
                {$count = $post->pictures->count()}
                {if="$count > 1"}
                    {$count} <i class="material-icons">collections</i> ·
                {/if}

                {if="$post->embed"}
                    <i class="material-icons">movie</i> ·
                {/if}

                {$count = $post->user_views_count}
                {if="$count > 2"}
                    {$count} <i class="material-icons">visibility</i> ·
                {/if}

                {$count = $post->likes->count()}
                {if="$count > 0"}
                    {$count} <i class="material-icons">favorite_border</i> ·
                {/if}

                {$count = $post->comments->count()}
                {if="$count > 0"}
                    {$count} <i class="material-icons">chat_bubble_outline</i> ·
                {/if}

                {$post->published|strtotime|prepareDate:true,true}
            </span>
        </p>
    </div>
</li>
