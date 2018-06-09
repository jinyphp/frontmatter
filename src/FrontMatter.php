<?php
namespace Jiny\Frontmatter;

use Webuni\FrontMatter\Processor\JsonWithoutBracesProcessor;
use Webuni\FrontMatter\Processor\ProcessorInterface;
use Webuni\FrontMatter\Processor\TomlProcessor;
use Webuni\FrontMatter\Processor\YamlProcessor;
use Webuni\FrontMatter\FrontMatterInterface;
use Webuni\FrontMatter\Document;

/**
 * Webuni\FrontMatter 코드 복사
 */
class FrontMatter implements FrontMatterInterface
{
    private $startSep;
    private $endSep;
    private $processor;
    private $regexp;

    public static function createYaml()
    {
        return new static(new YamlProcessor(), '---', '---');
    }

    public static function createToml()
    {
        return new static(new TomlProcessor(), '+++', '+++');
    }

    public static function createJson()
    {
        return new static(new JsonWithoutBracesProcessor(), '{', '}');
    }

    public function __construct(ProcessorInterface $processor = null, $startSep = '---', $endSep = '---')
    {
        // echo __CLASS__."객체를 생성하였습니다. <br>";

        $this->startSep = $startSep;
        $this->endSep = $endSep;

        // 기본 설정은 Yaml 입니다.
        $this->processor = $processor ?: new YamlProcessor();

        $this->regexp = '{^(?:'.preg_quote($startSep).")[\r\n|\n]*(.*?)[\r\n|\n]+(?:".preg_quote($endSep).")[\r\n|\n]*(.*)$}s";
    }

    /**
     * 문서에서 머리말과 본문을 분리합니다.
     * {@inheritdoc}
     */
    public function parse($source)
    {
        if (preg_match($this->regexp, $source, $matches) === 1) {
            $data = '' !== trim($matches[1]) ? $this->processor->parse(trim($matches[1])) : [];

            return new Document($matches[2], $data);
        }

        return new Document($source);
    }

    /**
     * {@inheritdoc}
     */
    public function dump(Document $document)
    {
        $data = trim($this->processor->dump($document->getData()));
        if ('' === $data) {
            return $document->getContent();
        }

        return sprintf("%s\n%s\n%s\n%s", $this->startSep, $data, $this->endSep, $document->getContent());
    }

}