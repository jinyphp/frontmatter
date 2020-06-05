<?php
/*
 * This file is part of the jinyPHP package.
 *
 * (c) hojinlee <infohojin@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Jiny\Frontmatter;

// 출력 객체

class Body
{
    public $data;
    public $content;

    public function __construct($content, $data)
    {
        $this->content = $content;
        $this->data = $data;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

}