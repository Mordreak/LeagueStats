<?php

namespace LSTATS\RiotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 *
 * @ORM\Table(name="lstats_game")
 * @ORM\Entity(repositoryClass="LSTATS\RiotBundle\Repository\GameRepository")
 */
class Game
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
     * @ORM\Column(name="seasonId", type="integer")
     */
    private $seasonId;

    /**
     * @var int
     *
     * @ORM\Column(name="gameId", type="bigint", unique=true)
     */
    private $gameId;

    /**
     * @var string
     *
     * @ORM\Column(name="participantIdentities", type="text")
     */
    private $participantIdentities;

    /**
     * @var int
     *
     * @ORM\Column(name="queueId", type="integer")
     */
    private $queueId;

    /**
     * @var string
     *
     * @ORM\Column(name="gameVersion", type="string", length=255)
     */
    private $gameVersion;

    /**
     * @var string
     *
     * @ORM\Column(name="gameMode", type="string", length=255)
     */
    private $gameMode;

    /**
     * @var string
     *
     * @ORM\Column(name="gameType", type="string", length=255)
     */
    private $gameType;

    /**
     * @var int
     *
     * @ORM\Column(name="gameDuration", type="integer")
     */
    private $gameDuration;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="gameCreation", type="datetime")
     */
    private $gameCreation;


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
     * Set seasonId
     *
     * @param integer $seasonId
     *
     * @return Game
     */
    public function setSeasonId($seasonId)
    {
        $this->seasonId = $seasonId;

        return $this;
    }

    /**
     * Get seasonId
     *
     * @return int
     */
    public function getSeasonId()
    {
        return $this->seasonId;
    }

    /**
     * Set gameId
     *
     * @param integer $gameId
     *
     * @return Game
     */
    public function setGameId($gameId)
    {
        $this->gameId = $gameId;

        return $this;
    }

    /**
     * Get gameId
     *
     * @return int
     */
    public function getGameId()
    {
        return $this->gameId;
    }

    /**
     * Set participantIdentities
     *
     * @param string $participantIdentities
     *
     * @return Game
     */
    public function setParticipantIdentities($participantIdentities)
    {
        try {
            $this->participantIdentities = json_encode($participantIdentities);
        } catch (\Exception $e) {
            $this->participantIdentities = '';
        }

        return $this;
    }

    /**
     * Get participantIdentities
     *
     * @return string
     */
    public function getParticipantIdentities()
    {
        try {
            return json_decode($this->participantIdentities, true);
        } catch (\Exception $e) {
            return array();
        }
    }

    /**
     * Set queueId
     *
     * @param integer $queueId
     *
     * @return Game
     */
    public function setQueueId($queueId)
    {
        $this->queueId = $queueId;

        return $this;
    }

    /**
     * Get queueId
     *
     * @return int
     */
    public function getQueueId()
    {
        return $this->queueId;
    }

    /**
     * Set gameVersion
     *
     * @param string $gameVersion
     *
     * @return Game
     */
    public function setGameVersion($gameVersion)
    {
        $this->gameVersion = $gameVersion;

        return $this;
    }

    /**
     * Get gameVersion
     *
     * @return string
     */
    public function getGameVersion()
    {
        return $this->gameVersion;
    }

    /**
     * Set gameMode
     *
     * @param string $gameMode
     *
     * @return Game
     */
    public function setGameMode($gameMode)
    {
        $this->gameMode = $gameMode;

        return $this;
    }

    /**
     * Get gameMode
     *
     * @return string
     */
    public function getGameMode()
    {
        return $this->gameMode;
    }

    /**
     * Set gameType
     *
     * @param string $gameType
     *
     * @return Game
     */
    public function setGameType($gameType)
    {
        $this->gameType = $gameType;

        return $this;
    }

    /**
     * Get gameType
     *
     * @return string
     */
    public function getGameType()
    {
        return $this->gameType;
    }

    /**
     * Set gameDuration
     *
     * @param integer $gameDuration
     *
     * @return Game
     */
    public function setGameDuration($gameDuration)
    {
        $this->gameDuration = $gameDuration;

        return $this;
    }

    /**
     * Get gameDuration
     *
     * @return int
     */
    public function getGameDuration()
    {
        return $this->gameDuration;
    }

    /**
     * Set gameCreation
     *
     * @param \DateTime $gameCreation
     *
     * @return Game
     */
    public function setGameCreation($gameCreation)
    {
        $this->gameCreation = $gameCreation;

        return $this;
    }

    /**
     * Get gameCreation
     *
     * @return \DateTime
     */
    public function getGameCreation()
    {
        return $this->gameCreation;
    }

    public function toArray()
    {
        return array(
            'seasonId' => $this->getSeasonId(),
            'gameId' => $this->getGameId(),
            'participantIdentities' => $this->getParticipantIdentities(),
            'queueId' => $this->getQueueId(),
            'gameVersion' => $this->getGameVersion(),
            'gameMode' => $this->getGameMode(),
            'gameType' => $this->getGameType(),
            'gameDuration' => $this->getGameDuration(),
            'gameCreation' => $this->getGameCreation()->format('m/d/Y H:i:s')
        );
    }
}

