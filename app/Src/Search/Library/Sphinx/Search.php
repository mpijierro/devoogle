<?php
/**
 * Created by PhpStorm.
 * User: mpijierro
 * Date: 26/03/19
 * Time: 0:43
 */

namespace Devoogle\Src\Search\Library\Sphinx;

use SphinxClient;

class Search
{

    /**
     * @var SphinxClient
     */
    private $sphinxClient;

    /**
     * @var string
     */
    private $search;


    public function __construct(SphinxClient $sphinxClient, string $search)
    {
        $this->sphinxClient = $sphinxClient;
        $this->search = $search;
    }


    /**
     * @return SphinxClient
     */
    public function sphinxClient(): SphinxClient
    {
        return $this->sphinxClient;
    }


    /**
     * @return string
     */
    public function search(): string
    {
        return $this->search;
    }



}