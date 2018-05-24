<?php

namespace Devoogle\Src\SourceReader\Library\RssProcessor;

use Carbon\Carbon;
use Devoogle\Src\Category\Model\Category;
use Devoogle\Src\Lang\Model\Lang;
use Devoogle\Src\Lang\Repository\LangRepositoryRead;
use Devoogle\Src\Resource\Command\StoreResourceCommand;
use Devoogle\Src\Resource\Command\StoreResourceHandler;
use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;
use Devoogle\Src\ResourceRaw\Model\ResourceRaw;
use Devoogle\Src\ResourceRaw\Repository\ResourceRawRepositoryWrite;
use Devoogle\Src\Source\Model\Source;
use Devoogle\Src\Source\Repository\SourceRepositoryRead;
use Devoogle\Src\Source\Repository\SourceRepositoryWrite;
use Devoogle\Src\SourceReader\Library\ResourceWrapper;
use Devoogle\Src\SourceReader\Library\SourceProcessorInterface;
use Devoogle\Src\Tag\Library\TagExtractor\TagFinder;
use Devoogle\Src\User\Model\User;
use SimpleXMLElement;
use Webpatser\Uuid\Uuid;

abstract class ProcessorRss20 implements SourceProcessorInterface, RssProcessorInterface
{

    protected $rssContent;

    protected $source;

    protected $uuid;

    /**
     * @var TagFinder
     */
    protected $tagFinder;

    /**
     * @var LangRepositoryRead
     */
    protected $langRepositoryRead;

    /**
     * @var SourceRepositoryWrite
     */
    protected $sourceRepositoryWrite;

    /**
     * @var ResourceRawRepositoryWrite
     */
    protected $resourceRawRepositoryWrite;

    /**
     * @var SourceRepositoryRead
     */
    protected $sourceRepositoryRead;

    /**
     * @var ResourceRepositoryRead
     */
    protected $resourceRepositoryRead;


    public function __construct(
        TagFinder $tagFinder,
        SourceRepositoryWrite $sourceRepositoryWrite,
        SourceRepositoryRead $sourceRepositoryRead,
        ResourceRawRepositoryWrite $resourceRawRepositoryWrite,
        ResourceRepositoryRead $resourceRepositoryRead

    ) {
        $this->tagFinder = $tagFinder;
        $this->sourceRepositoryWrite = $sourceRepositoryWrite;
        $this->resourceRawRepositoryWrite = $resourceRawRepositoryWrite;
        $this->sourceRepositoryRead = $sourceRepositoryRead;
        $this->resourceRepositoryRead = $resourceRepositoryRead;
    }


    public function process(Source $source)
    {
        $this->initialize($source);

        $this->obtainContentFromRss();

        $this->processRss();

        $this->updateTimeProcessed();

    }


    protected function initialize(Source $source)
    {
        $this->source = $source;

    }

    protected function obtainContentFromRss()
    {

        $content = file_get_contents($this->rssSlug());

        $this->rssContent = new SimpleXmlElement($content);

    }


    abstract public function rssSlug(): string;


    protected function processRss()
    {

        foreach ($this->rssContent->channel->item as $item) {

            $this->generateUuid();

            $this->processItem($item);

        }
    }


    protected function generateUuid()
    {
        $this->uuid = Uuid::generate();
    }


    protected function processItem(SimpleXMLElement $item)
    {

        $wrapper = new AudioWrapper($item);

        if ($this->audioExists($wrapper)) {
            return;
        }

        $this->saveAudio($wrapper);

        $this->saveRaw($wrapper);

    }


    protected function audioExists(ResourceWrapper $audioWrapper)
    {

        return (bool)$this->resourceRepositoryRead->existsUrlPattern($audioWrapper->url());

    }


    protected function saveAudio(ResourceWrapper $audioWrapper)
    {

        $uuid = $this->uuid;
        $userId = User::ADMIN_USER_ID;
        $hasSource = true;
        $sourceId = $this->source->id();
        $title = $audioWrapper->title();
        $url = $audioWrapper->url();
        $categoryId = Category::AUDIO_CATEGORY_ID;
        $langId = Lang::LANG_UNSPECIFIED;
        $description = $this->sanitizeDescription($audioWrapper);
        $publishedAt = $audioWrapper->publishedAt();
        $tag = $this->tagFinder->findByCommonTags($audioWrapper->obtainTextsForSearch());
        $author = $this->tagFinder->findByAuthor($audioWrapper->obtainTextsForSearch());
        $event = $this->tagFinder->findByEvent($audioWrapper->obtainTextsForSearch());
        $technology = $this->tagFinder->findByTechnology($audioWrapper->obtainTextsForSearch());

        $command = new StoreResourceCommand($uuid, $userId, $hasSource, $sourceId, $title, $description, $publishedAt, $url, $categoryId, $langId, $tag, $author, $event, $technology);

        $handler = app(StoreResourceHandler::class);
        $handler($command);


    }


    private function sanitizeDescription(ResourceWrapper $audioWrapper)
    {
        return str_replace('.es/"', '.es/', $audioWrapper->description());
    }


    protected function saveRaw(ResourceWrapper $audio)
    {

        $resource = $this->resourceCreated();

        $audioRaw = new ResourceRaw();
        $audioRaw->resource_id = $resource->id();
        $audioRaw->info = json_encode($audio->element());

        $this->resourceRawRepositoryWrite->save($audioRaw);

    }


    protected function resourceCreated()
    {
        return $this->resourceRepositoryRead->findByUuid($this->uuid);
    }


    protected function updateTimeProcessed()
    {
        $this->source->last_time_processed = Carbon::now();

        $this->sourceRepositoryWrite->save($this->source);
    }


    abstract public function slug(): string;

}