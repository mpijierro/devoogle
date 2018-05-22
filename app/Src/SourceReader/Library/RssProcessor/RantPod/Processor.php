<?php

namespace Devoogle\Src\SourceReader\Library\RssProcessor\RantPod;

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
use Devoogle\Src\SourceReader\Library\RssProcessor\AudioWrapper;
use Devoogle\Src\SourceReader\Library\SourceProcessorInterface;
use Devoogle\Src\Tag\Library\TagExtractor\TagFinder;
use Devoogle\Src\User\Model\User;
use SimpleXMLElement;
use Webpatser\Uuid\Uuid;

class Processor implements SourceProcessorInterface
{

    const RSS_URL = 'http://feeds.feedburner.com/rantpod/rss';

    const SLUG = 'rantpod';

    private $rssContent;

    private $source;

    private $uuid;

    /**
     * @var TagFinder
     */
    private $tagFinder;

    /**
     * @var LangRepositoryRead
     */
    private $langRepositoryRead;

    private $lang;

    /**
     * @var SourceRepositoryWrite
     */
    private $sourceRepositoryWrite;

    /**
     * @var ResourceRawRepositoryWrite
     */
    private $resourceRawRepositoryWrite;

    /**
     * @var SourceRepositoryRead
     */
    private $sourceRepositoryRead;

    /**
     * @var ResourceRepositoryRead
     */
    private $resourceRepositoryRead;


    public function __construct(
        TagFinder $tagFinder,
        LangRepositoryRead $langRepositoryRead,
        SourceRepositoryWrite $sourceRepositoryWrite,
        SourceRepositoryRead $sourceRepositoryRead,
        ResourceRawRepositoryWrite $resourceRawRepositoryWrite,
        ResourceRepositoryRead $resourceRepositoryRead

    ) {
        $this->tagFinder = $tagFinder;
        $this->langRepositoryRead = $langRepositoryRead;
        $this->sourceRepositoryWrite = $sourceRepositoryWrite;
        $this->resourceRawRepositoryWrite = $resourceRawRepositoryWrite;
        $this->sourceRepositoryRead = $sourceRepositoryRead;
        $this->resourceRepositoryRead = $resourceRepositoryRead;
    }


    public function slug(): string
    {
        return self::SLUG;
    }


    public function process(Source $source)
    {
        $this->initialize($source);

        $this->obtainLang();

        $this->obtainContentFromRss();

        $this->processRss();

        $this->updateTimeProcessed();

    }


    private function initialize(Source $source)
    {
        $this->source = $source;

    }


    private function obtainLang()
    {
        $this->lang = $this->langRepositoryRead->findByCode(Lang::SPANISH_CODE);
    }


    private function obtainContentFromRss()
    {

        $content = file_get_contents(self::RSS_URL);

        $this->rssContent = new SimpleXmlElement($content);

    }


    private function processRss()
    {

        foreach ($this->rssContent->channel->item as $item) {

            $this->generateUuid();

            $this->processItem($item);

        }
    }


    private function generateUuid()
    {
        $this->uuid = Uuid::generate();
    }


    private function processItem(SimpleXMLElement $item)
    {

        $wrapper = new AudioWrapper($item);

        if ($this->audioExists($wrapper)) {
            return;
        }

        $this->saveAudio($wrapper);

        $this->saveRaw($wrapper);

    }


    private function audioExists(AudioWrapper $audioWrapper)
    {

        return (bool)$this->resourceRepositoryRead->existsUrlPattern($audioWrapper->url());

    }


    private function saveAudio(AudioWrapper $audioWrapper)
    {

        $uuid = $this->uuid;
        $userId = User::ADMIN_USER_ID;
        $hasSource = true;
        $sourceId = $this->source->id();
        $title = $audioWrapper->title();
        $url = $audioWrapper->url();
        $categoryId = Category::AUDIO_CATEGORY_ID;
        $langId = $this->lang->id();
        $description = $audioWrapper->description();
        $publishedAt = $audioWrapper->publishedAt();
        $tag = $this->tagFinder->findByCommonTags($audioWrapper->obtainTextsForSearch());
        $author = $this->tagFinder->findByAuthor($audioWrapper->obtainTextsForSearch());
        $event = $this->tagFinder->findByEvent($audioWrapper->obtainTextsForSearch());
        $technology = $this->tagFinder->findByTechnology($audioWrapper->obtainTextsForSearch());

        $command = new StoreResourceCommand($uuid, $userId, $hasSource, $sourceId, $title, $description, $publishedAt, $url, $categoryId, $langId, $tag, $author, $event, $technology);

        $handler = app(StoreResourceHandler::class);
        $handler($command);


    }


    private function saveRaw(AudioWrapper $audio)
    {

        $resource = $this->resourceCreated();

        $audioRaw = new ResourceRaw();
        $audioRaw->resource_id = $resource->id();
        $audioRaw->info = json_encode($audio->element());

        $this->resourceRawRepositoryWrite->save($audioRaw);

    }


    private function resourceCreated()
    {
        return $this->resourceRepositoryRead->findByUuid($this->uuid);
    }


    private function updateTimeProcessed()
    {
        $this->source->last_time_processed = Carbon::now();

        $this->sourceRepositoryWrite->save($this->source);
    }

}