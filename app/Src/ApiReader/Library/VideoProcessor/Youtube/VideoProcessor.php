<?php

namespace Devoogle\Src\ApiReader\Library\VideoProcessor\Youtube;

use Devoogle\Src\ApiReader\Exceptions\ResourceExistsException;
use Devoogle\Src\ApiReader\Library\TagExtractor\TagFinder;
use Devoogle\Src\ApiReader\Model\YoutubeVideo;
use Devoogle\Src\ApiReader\Repository\YoutubeRepositoryWrite;
use Devoogle\Src\Category\Model\Category;
use Devoogle\Src\Lang\Model\Lang;
use Devoogle\Src\Resource\Command\StoreResourceCommand;
use Devoogle\Src\Resource\Command\StoreResourceHandler;
use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;
use Devoogle\Src\Resource\Repository\ResourceRepositoryWrite;
use Devoogle\Src\User\Model\User;
use Devoogle\Src\User\Repository\UserRepository;
use Webpatser\Uuid\Uuid;

class VideoProcessor
{

    private $videoWrapper;

    private $user;

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


    public function __construct(
        YoutubeRepositoryWrite $youtubeRepositoryWrite,
        ResourceRepositoryRead $resourceRepositoryRead,
        UserRepository $userRepository,
        TagFinder $tagFinder
    ) {

        $this->youtubeRepositoryWrite = $youtubeRepositoryWrite;
        $this->resourceRepositoryRead = $resourceRepositoryRead;
        $this->userRepository = $userRepository;
        $this->tagFinder = $tagFinder;

        $this->textsForTagSearch = collect();
    }


    public function processVideo(VideoWrapper $videoWrapper, User $user)
    {

        $this->initializeVideo($videoWrapper);

        $this->initializeUser($user);

        $this->checkExists();

        $this->initializeTextsForTagSearch();

        $this->createResource();

        $this->saveFullVideo();

    }


    private function initializeVideo(VideoWrapper $videoWrapper)
    {
        $this->videoWrapper = $videoWrapper;
    }

    private function initializeUser(User $user)
    {
        $this->user = $user;
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
        $userId = $this->user->id();
        $title = $this->videoWrapper->title();
        $url = $this->videoWrapper->url();
        $categoryId = Category::VIDEO_CATEGORY_ID;
        $langId = Lang::LANG_UNSPECIFIED;
        $description = $this->videoWrapper->description();
        $tag = $this->tagFinder->findByCommonTags($this->textsForTagSearch);
        $author = $this->tagFinder->findByAuthor($this->textsForTagSearch);
        $event = $this->tagFinder->findByEvent($this->textsForTagSearch);
        $technology = $this->tagFinder->findByTechnology($this->textsForTagSearch);

        $command = new StoreResourceCommand($uuid, $userId, $title, $description, $url, $categoryId, $langId, $tag, $author, $event, $technology);
        $handler = app(StoreResourceHandler::class);
        $handler($command);

    }

    private function saveFullVideo()
    {

        if ($this->videoWrapper->hasFullVideo()) {

            $video = new YoutubeVideo();
            $video->info = json_encode($this->videoWrapper->fullVideo());

            $this->youtubeRepositoryWrite->saveVideo($video);
        }

    }

}