<?php

namespace Devoogle\Src\SourceReader\Library\ApiProcessor\Youtube;

use Devoogle\Src\Category\Model\Category;
use Devoogle\Src\Lang\Model\Lang;
use Devoogle\Src\Resource\Command\StoreResourceCommand;
use Devoogle\Src\Resource\Command\StoreResourceHandler;
use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;
use Devoogle\Src\ResourceRaw\Model\ResourceRaw;
use Devoogle\Src\ResourceRaw\Repository\ResourceRawRepositoryWrite;
use Devoogle\Src\Source\Repository\SourceRepositoryRead;
use Devoogle\Src\SourceReader\Exceptions\ResourceExistsException;
use Devoogle\Src\SourceReader\Library\VideoWrapper;
use Devoogle\Src\Tag\Library\TagExtractor\TagFinder;
use Devoogle\Src\User\Model\User;
use Devoogle\Src\User\Repository\UserRepository;
use Webpatser\Uuid\Uuid;

class VideoProcessor
{

    private $uuid = '';

    private $videoWrapper;

    private $textsForTagSearch;

    /**
     * @var ResourceRepositoryRead
     */
    private $resourceRepositoryRead;

    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var TagFinder
     */
    private $tagFinder;

    /**
     * @var SourceRepositoryRead
     */
    private $sourceRepositoryRead;

    private $source;

    /**
     * @var ResourceRawRepositoryWrite
     */
    private $resourceRawRepositoryWrite;


    public function __construct(
        ResourceRawRepositoryWrite $resourceRawRepositoryWrite,
        ResourceRepositoryRead $resourceRepositoryRead,
        UserRepository $userRepository,
        SourceRepositoryRead $sourceRepositoryRead,
        TagFinder $tagFinder
    ) {

        $this->resourceRepositoryRead = $resourceRepositoryRead;
        $this->userRepository = $userRepository;
        $this->tagFinder = $tagFinder;

        $this->textsForTagSearch = collect();
        $this->sourceRepositoryRead = $sourceRepositoryRead;

        $this->uuid = Uuid::generate();
        $this->resourceRawRepositoryWrite = $resourceRawRepositoryWrite;
    }


    public function processVideo(VideoWrapper $videoWrapper)
    {

        $this->initializeVideo($videoWrapper);

        $this->checkExists();

        $this->obtainSource();

        $this->initializeTextsForTagSearch();

        $this->createResource();

        $this->saveRaw();

    }


    private function initializeVideo(VideoWrapper $videoWrapper)
    {
        $this->videoWrapper = $videoWrapper;
    }


    private function obtainSource()
    {
        $this->source = $this->sourceRepositoryRead->obtainYoutube();
    }

    private function checkExists()
    {
        $exists = $this->resourceRepositoryRead->existsUrlPattern($this->videoWrapper->videoId());

        if ($exists) {
            throw new ResourceExistsException();
        }
    }


    private function initializeTextsForTagSearch()
    {
        $this->textsForTagSearch = $this->videoWrapper->obtainTextsForSearch();
    }


    private function createResource()
    {

        $userId = User::ADMIN_USER_ID;
        $sourceId = $this->source->id();
        $title = $this->videoWrapper->title();
        $url = $this->videoWrapper->url();
        $categoryId = Category::VIDEO_CATEGORY_ID;
        $langId = Lang::LANG_UNSPECIFIED;
        $description = $this->videoWrapper->description();
        $publishedAt = $this->videoWrapper->publishedAt();
        $tag = $this->tagFinder->findByCommonTags($this->textsForTagSearch);
        $author = $this->tagFinder->findByAuthor($this->textsForTagSearch);
        $event = $this->tagFinder->findByEvent($this->textsForTagSearch);
        $technology = $this->tagFinder->findByTechnology($this->textsForTagSearch);

        $command = new StoreResourceCommand($this->uuid, $userId, true, $sourceId, $title, $description, $publishedAt, $url, $categoryId,
            $langId, $tag, $author, $event, $technology);
        $handler = app(StoreResourceHandler::class);
        $handler($command);
    }


    private function saveRaw()
    {

        if ($this->videoWrapper->hasFullVideo()) {

            $resource = $this->resourceCreated();

            $videoRaw = new ResourceRaw();
            $videoRaw->resource_id = $resource->id();
            $videoRaw->info = json_encode($this->videoWrapper->fullVideo());

            $this->resourceRawRepositoryWrite->save($videoRaw);
        }

    }


    private function resourceCreated()
    {
        return $this->resourceRepositoryRead->findByUuid($this->uuid);
    }

}