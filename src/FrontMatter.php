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

use Webuni\FrontMatter\Processor\JsonWithoutBracesProcessor;
use Webuni\FrontMatter\Processor\ProcessorInterface;
use Webuni\FrontMatter\Processor\TomlProcessor;
use Webuni\FrontMatter\Processor\YamlProcessor;
use Webuni\FrontMatter\FrontMatterInterface;
use Webuni\FrontMatter\Document;

/**
 * Webuni\FrontMatter 
 * 코드 복사후 조정
 */
class FrontMatter implements FrontMatterInterface
{
    private $startSep;
    private $endSep;
    private $processor;
    
    private $regexp;

    public $_front;

    /**
     * 생성자 재지정
     */
    public function __construct(ProcessorInterface $processor = null, $startSep = '---', $endSep = '---')
    {
        $this->startSep = $startSep;
        $this->endSep = $endSep;

        // YMAL 처리기 객체를 생성합니다. 기본은 Yaml 입니다.
        // 변경된 jinyYaml 로 변경합니다.
        // $this->processor = $processor ?: new YamlProcessor();
        $this->processor = $processor ?: new \Jiny\Yaml\Yaml();        

        $this->regexp = '{^(?:'.preg_quote($startSep).")[\r\n|\n]*(.*?)[\r\n|\n]+(?:".preg_quote($endSep).")[\r\n|\n]*(.*)$}s";
    }

    /**
     * 문서에서 머리말과 본문을 분리합니다.
     * {@inheritdoc}
     */
    public function parse($source)
    {
        // \TimeLog::set(__METHOD__);

        if (preg_match($this->regexp, $source, $matches) === 1) {
            $data = '' !== trim($matches[1]) ? $this->processor->parse(trim($matches[1])) : [];
            
            // 
            $this->_front = $matches[1];

            return new Document($matches[2], $data);
        }

        return new Document($source);
    }

    /**
     * {@inheritdoc}
     */
    public function dump(Document $document)
    {
        // \TimeLog::set(__METHOD__);

        $data = trim($this->processor->dump($document->getData()));
        if ('' === $data) {
            return $document->getContent();
        }

        return sprintf("%s\n%s\n%s\n%s", $this->startSep, $data, $this->endSep, $document->getContent());
    }

    public static function createYaml()
    {
        // return new static(new YamlProcessor(), '---', '---');
        // 변경된 jinyYaml 로 변경합니다.
        return new static(new \Jiny\Yaml\Yaml(), '---', '---');
    }

    public static function createToml()
    {
        return new static(new TomlProcessor(), '+++', '+++');
    }

    public static function createJson()
    {
        return new static(new JsonWithoutBracesProcessor(), '{', '}');
    }

    /**
     * 
     */
}