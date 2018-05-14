<?php

namespace LSTATS\RiotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ChallengerSummoner
 *
 * @ORM\Table(name="lstats_challenger_summoner")
 * @ORM\Entity(repositoryClass="LSTATS\RiotBundle\Repository\ChallengerSummonerRepository")
 */
class ChallengerSummoner
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
     * @ORM\Column(name="playerOrTeamId", type="integer", unique=true)
     */
    private $playerOrTeamId;

    /**
     * @var string
     *
     * @ORM\Column(name="playerOrTeamName", type="string", length=255, unique=true)
     */
    private $playerOrTeamName;

    /**
     * @var int
     *
     * @ORM\Column(name="leaguePoints", type="integer")
     */
    private $leaguePoints;

    /**
     * @var string
     *
     * @ORM\Column(name="rank", type="string", length=255)
     */
    private $rank;

    /**
     * @var int
     *
     * @ORM\Column(name="wins", type="integer")
     */
    private $wins;

    /**
     * @var string
     *
     * @ORM\Column(name="losses", type="string", length=255)
     */
    private $losses;

    /**
     * @var bool
     *
     * @ORM\Column(name="veteran", type="boolean")
     */
    private $veteran;

    /**
     * @var bool
     *
     * @ORM\Column(name="inactive", type="boolean")
     */
    private $inactive;

    /**
     * @var bool
     *
     * @ORM\Column(name="freshBlood", type="boolean")
     */
    private $freshBlood;

    /**
     * @var bool
     *
     * @ORM\Column(name="hotStreak", type="boolean")
     */
    private $hotStreak;

    /**
     * @var int
     *
     * @ORM\Column(name="points", type="integer")
     */
    private $points;


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
     * Set playerOrTeamId
     *
     * @param integer $playerOrTeamId
     *
     * @return ChallengerSummoner
     */
    public function setPlayerOrTeamId($playerOrTeamId)
    {
        $this->playerOrTeamId = $playerOrTeamId;

        return $this;
    }

    /**
     * Get playerOrTeamId
     *
     * @return int
     */
    public function getPlayerOrTeamId()
    {
        return $this->playerOrTeamId;
    }

    /**
     * Set playerOrTeamName
     *
     * @param string $playerOrTeamName
     *
     * @return ChallengerSummoner
     */
    public function setPlayerOrTeamName($playerOrTeamName)
    {
        $this->playerOrTeamName = $playerOrTeamName;

        return $this;
    }

    /**
     * Get playerOrTeamName
     *
     * @return string
     */
    public function getPlayerOrTeamName()
    {
        return $this->playerOrTeamName;
    }

    /**
     * Set leaguePoints
     *
     * @param integer $leaguePoints
     *
     * @return ChallengerSummoner
     */
    public function setLeaguePoints($leaguePoints)
    {
        $this->leaguePoints = $leaguePoints;

        return $this;
    }

    /**
     * Get leaguePoints
     *
     * @return int
     */
    public function getLeaguePoints()
    {
        return $this->leaguePoints;
    }

    /**
     * Set rank
     *
     * @param string $rank
     *
     * @return ChallengerSummoner
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank
     *
     * @return string
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set wins
     *
     * @param integer $wins
     *
     * @return ChallengerSummoner
     */
    public function setWins($wins)
    {
        $this->wins = $wins;

        return $this;
    }

    /**
     * Get wins
     *
     * @return int
     */
    public function getWins()
    {
        return $this->wins;
    }

    /**
     * Set losses
     *
     * @param string $loses
     *
     * @return ChallengerSummoner
     */
    public function setLosses($losses)
    {
        $this->losses = $losses;

        return $this;
    }

    /**
     * Get losses
     *
     * @return string
     */
    public function getLosses()
    {
        return $this->losses;
    }

    /**
     * Set veteran
     *
     * @param boolean $veteran
     *
     * @return ChallengerSummoner
     */
    public function setVeteran($veteran)
    {
        $this->veteran = $veteran;

        return $this;
    }

    /**
     * Get veteran
     *
     * @return bool
     */
    public function getVeteran()
    {
        return $this->veteran;
    }

    /**
     * Set inactive
     *
     * @param boolean $inactive
     *
     * @return ChallengerSummoner
     */
    public function setInactive($inactive)
    {
        $this->inactive = $inactive;

        return $this;
    }

    /**
     * Get inactive
     *
     * @return bool
     */
    public function getInactive()
    {
        return $this->inactive;
    }

    /**
     * Set freshBlood
     *
     * @param boolean $freshBlood
     *
     * @return ChallengerSummoner
     */
    public function setFreshBlood($freshBlood)
    {
        $this->freshBlood = $freshBlood;

        return $this;
    }

    /**
     * Get freshBlood
     *
     * @return bool
     */
    public function getFreshBlood()
    {
        return $this->freshBlood;
    }

    /**
     * @return boolean
     */
    public function isHotStreak()
    {
        return $this->hotStreak;
    }

    /**
     * @param boolean $hotStreak
     */
    public function setHotStreak($hotStreak)
    {
        $this->hotStreak = $hotStreak;
    }

    /**
     * Set points
     *
     * @param integer $points
     *
     * @return ChallengerSummoner
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }
}

