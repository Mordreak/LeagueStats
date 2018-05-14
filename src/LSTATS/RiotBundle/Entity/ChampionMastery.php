<?php

namespace LSTATS\RiotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ChampionMastery
 *
 * @ORM\Table(name="lstats_champion_mastery")
 * @ORM\Entity(repositoryClass="LSTATS\RiotBundle\Repository\ChampionMasteryRepository")
 */
class ChampionMastery
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
     * @ORM\ManyToOne(targetEntity="Champion")
     * @ORM\JoinColumn(name="champion_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $champion;

    /**
     * @ORM\ManyToOne(targetEntity="Summoner")
     * @ORM\JoinColumn(name="summoner_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $summoner;

    /**
     * @var int
     *
     * @ORM\Column(name="level", type="integer")
     */
    private $level;

    /**
     * @var int
     *
     * @ORM\Column(name="points", type="integer")
     */
    private $points;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastPlay", type="datetime")
     */
    private $lastPlay;

    /**
     * @var int
     *
     * @ORM\Column(name="pointsSinceLastLevel", type="integer")
     */
    private $pointsSinceLastLevel;

    /**
     * @var int
     *
     * @ORM\Column(name="pointsUntilNextLevel", type="integer")
     */
    private $pointsUntilNextLevel;

    /**
     * @var bool
     *
     * @ORM\Column(name="chestGranted", type="boolean")
     */
    private $chestGranted;

    /**
     * @var int
     *
     * @ORM\Column(name="tokensEarned", type="integer")
     */
    private $tokensEarned;

    public function __construct()
    {
        $this->lastPlay = new \DateTime();
    }

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
     * @return mixed
     */
    public function getChampion()
    {
        return $this->champion;
    }

    /**
     * @param mixed $champion
     */
    public function setChampion($champion)
    {
        $this->champion = $champion;
    }

    /**
     * @return mixed
     */
    public function getSummoner()
    {
        return $this->summoner;
    }

    /**
     * @param mixed $summoner
     */
    public function setSummoner($summoner)
    {
        $this->summoner = $summoner;
    }

    /**
     * Set level
     *
     * @param integer $level
     *
     * @return ChampionMastery
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set points
     *
     * @param integer $points
     *
     * @return ChampionMastery
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

    /**
     * Set lastPlay
     *
     * @param \DateTime $lastPlay
     *
     * @return ChampionMastery
     */
    public function setLastPlay($lastPlay)
    {
        $this->lastPlay = $lastPlay;

        return $this;
    }

    /**
     * Get lastPlay
     *
     * @return \DateTime
     */
    public function getLastPlay()
    {
        return $this->lastPlay;
    }

    /**
     * Set pointsSinceLastLevel
     *
     * @param integer $pointsSinceLastLevel
     *
     * @return ChampionMastery
     */
    public function setPointsSinceLastLevel($pointsSinceLastLevel)
    {
        $this->pointsSinceLastLevel = $pointsSinceLastLevel;

        return $this;
    }

    /**
     * Get pointsSinceLastLevel
     *
     * @return int
     */
    public function getPointsSinceLastLevel()
    {
        return $this->pointsSinceLastLevel;
    }

    /**
     * Set pointsUntilNextLevel
     *
     * @param integer $pointsUntilNextLevel
     *
     * @return ChampionMastery
     */
    public function setPointsUntilNextLevel($pointsUntilNextLevel)
    {
        $this->pointsUntilNextLevel = $pointsUntilNextLevel;

        return $this;
    }

    /**
     * Get pointsUntilNextLevel
     *
     * @return int
     */
    public function getPointsUntilNextLevel()
    {
        return $this->pointsUntilNextLevel;
    }

    /**
     * Set chestGranted
     *
     * @param boolean $chestGranted
     *
     * @return ChampionMastery
     */
    public function setChestGranted($chestGranted)
    {
        $this->chestGranted = $chestGranted;

        return $this;
    }

    /**
     * Get chestGranted
     *
     * @return bool
     */
    public function getChestGranted()
    {
        return $this->chestGranted;
    }

    /**
     * Set tokensEarned
     *
     * @param integer $tokensEarned
     *
     * @return ChampionMastery
     */
    public function setTokensEarned($tokensEarned)
    {
        $this->tokensEarned = $tokensEarned;

        return $this;
    }

    /**
     * Get tokensEarned
     *
     * @return int
     */
    public function getTokensEarned()
    {
        return $this->tokensEarned;
    }
}

