<?php

namespace Jiny\Frontmatter;

class Body
{
    private $data;
    private $content;

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