<?php
namespace jiny\frontMatter;

function parse($body)
{
    $FrontMatter = new \Jiny\Frontmatter\FrontMatter;
    $f = $FrontMatter->parse($body);
        
    return [
            'data' => $f->getData(),
            'content' => $f->getContent()
    ];

}