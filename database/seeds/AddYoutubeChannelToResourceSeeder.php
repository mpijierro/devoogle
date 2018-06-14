<?php

use Illuminate\Database\Seeder;

class AddYoutubeChannelToResourceSeeder extends Seeder
{


    public function run()
    {


        $resources = Devoogle\Src\Resource\Model\Resource::where('source_id', 1)->cursor();

        foreach ($resources as $resource) {
            $info = json_decode($resource->raw->info);

            $channelId = $info->snippet->channelId;

            if ($channelId == 'UCTl9VkbMHHG5AnnfnaZOdHA') {
                $youtubeChannel = \Devoogle\Src\SourceReader\Model\YoutubeChannel::find(2); //Agile Spain
            } elseif ($channelId == 'UCvZKhclM_r1SDWUGRtU6NOA') {
                $youtubeChannel = \Devoogle\Src\SourceReader\Model\YoutubeChannel::find(1); //Aprendiendo TDD
            } elseif ($channelId == 'UC1sZ-Fx7binoCG1Qq9hSbHA') {
                $youtubeChannel = \Devoogle\Src\SourceReader\Model\YoutubeChannel::find(19); //PHP valencia
            } else {
                $youtubeChannel = \Devoogle\Src\SourceReader\Model\YoutubeChannel::where('slug_id', $channelId)->first();
            }

            if ($youtubeChannel) {

                $resource->channel()->sync($youtubeChannel);
            } else {
                echo "\r\n No asociado para: " . $resource->id . ' - ' . $resource->title;
            }
        }

    }

}