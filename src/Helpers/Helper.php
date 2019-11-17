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

// use Jiny\Frontmatter\FrontMatter;

require "Frontmatter.php";


if (! function_exists('frontMatter')) {
    function frontMatter($body)
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

 