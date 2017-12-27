<?php

namespace Mulidev\Src\Social\Repository;

use Mulidev\Src\Social\Model\Social;

class SocialRepository
{
    /**
     * @var \Mulidev\Src\Social\Model\Social
     */
    private $social;

    public function __construct(Social $social)
    {
        $this->social = $social;
    }

    public function findBySocialIdAndProvider($socialId, $provider)
    {
        return $this->social->where('social_id', '=', $socialId)->where('provider', '=', $provider)->first();
    }

}
