<?php

namespace Devoogle\Src\SourceReader\Library\VideoProcessor\Youtube;

use Devoogle\Src\Category\Model\Category;
use Devoogle\Src\Lang\Model\Lang;
use Devoogle\Src\Resource\Command\StoreResourceCommand;
use Devoogle\Src\Resource\Command\StoreResourceHandler;
use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;
use Devoogle\Src\Source\Model\Source;
use Devoogle\Src\Source\Repository\SourceRepositoryRead;
use Devoogle\Src\SourceReader\Exceptions\ResourceExistsException;
use Devoogle\Src\SourceReader\Library\TagExtractor\TagFinder;
use Devoogle\Src\SourceReader\Repository\YoutubeRepositoryWrite;
use Devoogle\Src\User\Model\User;
use Devoogle\Src\User\Repository\UserRepository;
use Webpatser\Uuid\Uuid;

class VideoProcessor
{
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
     * @var YoutubeRepositoryWrite
     */
    private $youtubeRepositoryWrite;

    /**
     * @var SourceRepositoryRead
     */
    private $sourceRepositoryRead;


    public function __construct(
        YoutubeRepositoryWrite $youtubeRepositoryWrite,
        ResourceRepositoryRead $resourceRepositoryRead,
        UserRepository $userRepository,
        SourceRepositoryRead $sourceRepositoryRead,
        TagFinder $tagFinder
    ) {

        $this->youtubeRepositoryWrite = $youtubeRepositoryWrite;
        $this->resourceRepositoryRead = $resourceRepositoryRead;
        $this->userRepository = $userRepository;
        $this->tagFinder = $tagFinder;

        $this->textsForTagSearch = collect();
        $this->sourceRepositoryRead = $sourceRepositoryRead;
    }


    public function processVideo(VideoWrapper $videoWrapper)
    {

        $this->initializeVideo($videoWrapper);

        $this->checkExists();

        $this->initializeTextsForTagSearch();

        $this->createResource();

        $this->saveFullVideo();

    }


    private function initializeVideo(VideoWrapper $videoWrapper)
    {
        $this->videoWrapper = $videoWrapper;
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

        $uuid = $uuid = Uuid::generate();
        $userId = User::ADMIN_USER_ID;
        $sourceId = Source::YOUTUBE_ID;
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

        $command = new StoreResourceCommand($uuid, $userId, true, $sourceId, $title, $description, $publishedAt, $url, $categoryId,
            $langId, $tag, $author, $event, $technology);
        $handler = app(StoreResourceHandler::class);
        $handler($command);
    }

    private function saveFullVideo()
    {

        //TODO: save here in resource_raw table.

        if ($this->videoWrapper->hasFullVideo()) {


            //$video = new YoutubeVideo();
            //$video->info = json_encode($this->videoWrapper->fullVideo());

            //$this->youtubeRepositoryWrite->saveVideo($video);
        }

    }

}