<?php

namespace Devoogle\Http\Controllers\ThirdPartyVideo;


use Alaouy\Youtube\Facades\Youtube;

class ChannelListController
{

    public function __invoke()
    {

        $sngularChannel = 'UCJDkEoAAZclorR4jEF9Kv3Q';

        $autentiaChannel = 'AutentiaMedia';

        $channel = Youtube::getChannelByName($autentiaChannel);

        dd($channel);

        $channelId = 'UCvZ6HKYcDtqtK1SfbIpB97g';

        // List videos in a given channel, return an array of PHP objects
        $videoList = Youtube::listChannelVideos($channelId, 40);


        dd($videoList);


    }
}
