<?php

namespace LSTATS\RiotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SummonerToRefresh
 *
 * @ORM\Table(name="lstats_summoner_to_refresh")
 * @ORM\Entity(repositoryClass="LSTATS\RiotBundle\Repository\SummonerToRefreshRepository")
 */
class SummonerToRefresh
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="summonerId", type="integer", unique=true)
     */
    private $summonerId;

    /**
     * @var string
     *
     * @ORM\Column(name="platform", type="string", length=255)
     */
    private $platform;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set summonerId
     *
     * @param integer $summonerId
     *
     * @return SummonerToRefresh
     */
    public function setSummonerId($summonerId)
    {
        $this->summonerId = $summonerId;

        return $this;
    }

    /**
     * Get summonerId
     *
     * @return int
     */
    public function getSummonerId()
    {
        return $this->summonerId;
    }

    /**
     * @return string
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * @param string $platform
     */
    public function setPlatform($platform)
    {
        $this->platform = $platform;
    }
}

