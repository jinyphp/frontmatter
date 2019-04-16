<?php
/*
 * This file is part of the jinyPHP package.
 *
 * (c) hojinlee <infohojin@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Jiny\Frontmatter\FrontMatter;

if (! function_exists('frontMatter')) {
    function frontMatter($body)
    {
        $FrontMatter = new FrontMatter;
        $f = $FrontMatter->parse($body);
        
        return [
            'data' => $f->getData(),
            'content' => $f->getContent()
        ];
    }
}

 