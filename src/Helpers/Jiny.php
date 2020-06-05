<?php
/*
 * This file is part of the jinyPHP package.
 *
 * (c) hojinlee <infohojin@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace jiny;

if (! function_exists('frontMatter')) {
    function frontMatter($body) : object
    {
        $FrontMatter = new \Jiny\Frontmatter\FrontMatter;
        $f = $FrontMatter->parse($body);
        
        return new \Jiny\Frontmatter\Body($f->getContent(), $f->getData());
    }
}

if (! function_exists('frontMatterFile')) {
    function frontMatterFile($filename) : object
    {
        if (\file_exists($filename)) {
            $body = \file_get_contents($filename);
            $FrontMatter = new \Jiny\Frontmatter\FrontMatter;
            $f = $FrontMatter->parse($body);
            
            return new \Jiny\Frontmatter\Body($f->getContent(), $f->getData());
        } else {
            echo __METHOD__."파일을 읽을 수 없습니다. exit";
            exit;
        }
    }
}