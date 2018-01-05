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
use Webpatser\Uuid\Uuid;

class YoutubeProcessor
{
    private $youtubeGateway;
    private $resource;

    /**
     * @var ResourceRepositoryWrite
     */
    private $resourceRepositoryWrite;
    /**
     * @var ResourceRepositoryRead
     */
    private $resourceRepositoryRead;


    public function __construct(ResourceRepositoryWrite $resourceRepositoryWrite, ResourceRepositoryRead $resourceRepositoryRead)
    {
        $this->resourceRepositoryWrite = $resourceRepositoryWrite;
        $this->resourceRepositoryRead = $resourceRepositoryRead;
    }

    public function __invoke(YoutubeGateway $youtubeGateway)
    {

        $this->initializeVideo($youtubeGateway);

        $this->checkExists();

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
        $tag = '';
        $author = '';
        $event = '';

        //public function __construct($uuid, $userId, $title, $description, $url, $categoryId, $langId, $tag, $author, $event)

        $command = new StoreResourceCommand($uuid, $userId, $title, $description, $url, $categoryId, $langId, $tag, $author, $event);
        $handler = app(StoreResourceHandler::class);
        $handler($command);

    }
}