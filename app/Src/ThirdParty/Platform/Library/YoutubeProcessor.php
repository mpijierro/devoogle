<?php

namespace Devoogle\Src\ThirdParty\Platform\Library;

use Devoogle\Src\Category\Model\Category;
use Devoogle\Src\Lang\Model\Lang;
use Devoogle\Src\Resource\Command\StoreResourceCommand;
use Devoogle\Src\Resource\Command\StoreResourceHandler;
use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;
use Devoogle\Src\Resource\Repository\ResourceRepositoryWrite;
use Devoogle\Src\ThirdParty\Platform\Exceptions\ResourceExistsException;
use Devoogle\Src\User\Model\User;
use Illuminate\Support\Collection;
use Webpatser\Uuid\Uuid;

class YoutubeProcessor
{
    private $youtubeGateway;

    private $textsForTagSearch;

    /**
     * @var ResourceRepositoryWrite
     */
    private $resourceRepositoryWrite;
    /**
     * @var ResourceRepositoryRead
     */
    private $resourceRepositoryRead;
    /**
     * @var EventTagExtractor
     */
    private $eventTagExtractor;
    /**
     * @var AuthorTagExtractor
     */
    private $authorTagExtractor;
    /**
     * @var CommonTagExtractor
     */
    private $commonTagExtractor;


    public function __construct(
        ResourceRepositoryWrite $resourceRepositoryWrite,
        ResourceRepositoryRead $resourceRepositoryRead,
        EventTagExtractor $tagExtractor,
        AuthorTagExtractor $authorTagExtractor,
        CommonTagExtractor $commonTagExtractor
    )
    {
        $this->resourceRepositoryWrite = $resourceRepositoryWrite;
        $this->resourceRepositoryRead = $resourceRepositoryRead;
        $this->eventTagExtractor = $tagExtractor;
        $this->authorTagExtractor = $authorTagExtractor;
        $this->commonTagExtractor = $commonTagExtractor;

        $this->textsForTagSearch = collect();
    }

    public function __invoke(YoutubeGateway $youtubeGateway)
    {

        $this->initializeVideo($youtubeGateway);

        $this->checkExists();

        $this->initializeTagSearch();

        $this->createResource();

    }


    private function initializeVideo(YoutubeGateway $youtubeGateway)
    {
        $this->youtubeGateway = $youtubeGateway;
    }

    private function checkExists()
    {
        $exists = $this->resourceRepositoryRead->existsUrlPattern($this->youtubeGateway->videoId());

        if ($exists) {
            throw new ResourceExistsException();
        }
    }

    private function createResource()
    {

        $uuid = $uuid = Uuid::generate();
        $userId = User::ADMIN_ID;
        $title = $this->youtubeGateway->title();
        $url = $this->youtubeGateway->url();
        $categoryId = Category::VIDEO_CATEGORY_ID;
        $langId = Lang::LANG_UNSPECIFIED;
        $description = $this->youtubeGateway->description();
        $tag = $this->searchTags($this->commonTagExtractor);
        $author = $this->searchTags($this->authorTagExtractor);
        $event = $this->searchTags($this->eventTagExtractor);;

        $command = new StoreResourceCommand($uuid, $userId, $title, $description, $url, $categoryId, $langId, $tag, $author, $event);
        $handler = app(StoreResourceHandler::class);
        $handler($command);

    }

    private function searchTags(TagExtractor $tagExtractor)
    {

        if ( ! $this->textsForTagSearch->count()) {
            return '';
        }

        ($tagExtractor)($this->textsForTagSearch);

        if ($tagExtractor->isTagFound()) {
            return $tagExtractor->tagFound();
        }

        return '';

    }

    private function initializeTagSearch()
    {

        $this->textsForTagSearch = collect();

        if ( ! empty($this->youtubeGateway->title())) {
            $this->textsForTagSearch->push($this->youtubeGateway->title());
        }

        if ( ! empty($this->youtubeGateway->description())) {
            $this->textsForTagSearch->push($this->youtubeGateway->description());
        }
    }
}