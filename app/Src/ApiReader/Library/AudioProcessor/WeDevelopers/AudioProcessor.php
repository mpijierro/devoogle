<?php

namespace Devoogle\Src\ApiReader\Library\AudioProcessor\WeDevelopers;

use Devoogle\Src\ApiReader\Library\TagExtractor\TagFinder;
use Devoogle\Src\Category\Model\Category;
use Devoogle\Src\Lang\Model\Lang;
use Devoogle\Src\Lang\Repository\LangRepositoryRead;
use Devoogle\Src\Resource\Command\StoreResourceCommand;
use Devoogle\Src\Resource\Command\StoreResourceHandler;
use Devoogle\Src\User\Model\User;
use Webpatser\Uuid\Uuid;
use SimpleXMLElement;

class AudioProcessor
{

    const RSS_URL = 'http://wedevelopers.com/feed/podcast/';

    private $rssContent;

    private $user;

    /**
     * @var TagFinder
     */
    private $tagFinder;

    /**
     * @var LangRepositoryRead
     */
    private $langRepositoryRead;

    private $lang;


    public function __construct(TagFinder $tagFinder, LangRepositoryRead $langRepositoryRead)
    {
        $this->tagFinder = $tagFinder;
        $this->langRepositoryRead = $langRepositoryRead;
    }


    public function processChannel(User $user)
    {

        $this->user = $user;

        $this->obtainLang();

        $this->obtainContentFromRss();

        $this->processRss();

    }


    private function obtainContentFromRss()
    {

        $content = file_get_contents(self::RSS_URL);

        $this->rssContent = new SimpleXmlElement($content);

    }


    private function processRss()
    {

        foreach ($this->rssContent->channel->item as $item) {

            $wrapper = new AudioWrapper($item);

            $this->saveAudio($wrapper);

        }

    }


    private function obtainLang()
    {
        $this->lang = $this->langRepositoryRead->findByCode(Lang::SPANISH_CODE);
    }


    private function saveAudio(AudioWrapper $audioWrapper)
    {

        $uuid = $uuid = Uuid::generate();
        $userId = $this->user->id();
        $title = $audioWrapper->title();
        $url = $audioWrapper->url();
        $categoryId = Category::VIDEO_CATEGORY_ID;
        $langId = $this->lang->id();
        $description = $audioWrapper->description();
        $publishedAt = $audioWrapper->publishedAt();
        $tag = $this->tagFinder->findByCommonTags($audioWrapper->obtainTextsForSearch());
        $author = $this->tagFinder->findByAuthor($audioWrapper->obtainTextsForSearch());
        $event = $this->tagFinder->findByEvent($audioWrapper->obtainTextsForSearch());
        $technology = $this->tagFinder->findByTechnology($audioWrapper->obtainTextsForSearch());

        $command = new StoreResourceCommand($uuid, $userId, $title, $description, $publishedAt, $url, $categoryId, $langId, $tag, $author, $event, $technology);

        $handler = app(StoreResourceHandler::class);
        $handler($command);


    }

}