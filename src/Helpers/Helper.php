<?php
/*
 * This file is part of the jinyPHP package.
 *
 * (c) hojinlee <infohojin@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Jiny;

if (! function_exists('frontMatter')) {
    function frontMatter($body) : object
    {
        $FrontMatter = new \Jiny\Frontmatter\FrontMatter;
        $f = $FrontMatter->parse($body);
        
        return new \Jiny\Frontmatter\Body($f->getContent(), $f->getData());
        /*
        return [
            'data' => $f->getData(),
            'content' => $f->getContent()
        ];
        */
    }
}

require "Frontmatter.php";
 