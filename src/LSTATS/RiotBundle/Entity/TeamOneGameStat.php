<?php

namespace LSTATS\RiotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TeamOneGameStat
 *
 * @ORM\Table(name="lstats_team_one_game_stat")
 * @ORM\Entity(repositoryClass="LSTATS\RiotBundle\Repository\TeamOneGameStatRepository")
 */
class TeamOneGameStat
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
     * @ORM\ManyToOne(targetEntity="Game")
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $game;


    /**
     * @var int
     * @ORM\Column(name="teamId", type="integer")
     */
    private $teamId;

    /**
     * @var bool
     *
     * @ORM\Column(name="win", type="boolean")
     */
    private $win;

    /**
     * @var bool
     *
     * @ORM\Column(name="firstBlood", type="boolean")
     */
    private $firstBlood;

    /**
     * @var bool
     *
     * @ORM\Column(name="firstTower", type="boolean")
     */
    private $firstTower;

    /**
     * @var bool
     *
     * @ORM\Column(name="firstInhibitor", type="boolean")
     */
    private $firstInhibitor;

    /**
     * @var bool
     *
     * @ORM\Column(name="firstBaron", type="boolean")
     */
    private $firstBaron;

    /**
     * @var bool
     *
     * @ORM\Column(name="firstDragon", type="boolean")
     */
    private $firstDragon;

    /**
     * @var bool
     *
     * @ORM\Column(name="firstRiftHerald", type="boolean")
     */
    private $firstRiftHerald;

    /**
     * @var int
     *
     * @ORM\Column(name="towerKills", type="integer")
     */
    private $towerKills;

    /**
     * @var int
     *
     * @ORM\Column(name="inhibitorKills", type="integer")
     */
    private $inhibitorKills;

    /**
     * @var int
     *
     * @ORM\Column(name="baronKills", type="integer")
     */
    private $baronKills;

    /**
     * @var int
     *
     * @ORM\Column(name="dragonKills", type="integer")
     */
    private $dragonKills;

    /**
     * @var int
     *
     * @ORM\Column(name="vilemawKills", type="integer")
     */
    private $vilemawKills;

    /**
     * @var int
     *
     * @ORM\Column(name="riftHeraldKills", type="integer")
     */
    private $riftHeraldKills;

    /**
     * @ORM\ManyToOne(targetEntity="Champion")
     * @ORM\JoinColumn(name="first_ban", referencedColumnName="id", onDelete="SET NULL")
     */
    private $firstBan;

    /**
     * @ORM\ManyToOne(targetEntity="Champion")
     * @ORM\JoinColumn(name="second_ban", referencedColumnName="id", onDelete="SET NULL")
     */
    private $secondBan;

    /**
     * @ORM\ManyToOne(targetEntity="Champion")
     * @ORM\JoinColumn(name="third_ban", referencedColumnName="id", onDelete="SET NULL")
     */
    private $thirdBan;

    /**
     * @ORM\ManyToOne(targetEntity="Champion")
     * @ORM\JoinColumn(name="fourth_ban", referencedColumnName="id", onDelete="SET NULL")
     */
    private $fourthBan;

    /**
     * @ORM\ManyToOne(targetEntity="Champion")
     * @ORM\JoinColumn(name="fifth_ban", referencedColumnName="id", onDelete="SET NULL")
     */
    private $fifthBan;


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
    public function getGame()
    {
        return $this->game;
    }

    /**
     * @param mixed $game
     */
    public function setGame($game)
    {
        $this->game = $game;
    }

    /**
     * @return int
     */
    public function getTeamId()
    {
        return $this->teamId;
    }

    /**
     * @param int $teamId
     */
    public function setTeamId($teamId)
    {
        $this->teamId = $teamId;
    }

    /**
     * Set win
     *
     * @param boolean $win
     *
     * @return TeamOneGameStat
     */
    public function setWin($win)
    {
        $this->win = $win;

        return $this;
    }

    /**
     * Get win
     *
     * @return bool
     */
    public function getWin()
    {
        return $this->win;
    }

    /**
     * Set firstBlood
     *
     * @param boolean $firstBlood
     *
     * @return TeamOneGameStat
     */
    public function setFirstBlood($firstBlood)
    {
        $this->firstBlood = $firstBlood;

        return $this;
    }

    /**
     * Get firstBlood
     *
     * @return bool
     */
    public function getFirstBlood()
    {
        return $this->firstBlood;
    }

    /**
     * Set firstTower
     *
     * @param boolean $firstTower
     *
     * @return TeamOneGameStat
     */
    public function setFirstTower($firstTower)
    {
        $this->firstTower = $firstTower;

        return $this;
    }

    /**
     * Get firstTower
     *
     * @return bool
     */
    public function getFirstTower()
    {
        return $this->firstTower;
    }

    /**
     * Set firstInhibitor
     *
     * @param boolean $firstInhibitor
     *
     * @return TeamOneGameStat
     */
    public function setFirstInhibitor($firstInhibitor)
    {
        $this->firstInhibitor = $firstInhibitor;

        return $this;
    }

    /**
     * Get firstInhibitor
     *
     * @return bool
     */
    public function getFirstInhibitor()
    {
        return $this->firstInhibitor;
    }

    /**
     * Set firstBaron
     *
     * @param boolean $firstBaron
     *
     * @return TeamOneGameStat
     */
    public function setFirstBaron($firstBaron)
    {
        $this->firstBaron = $firstBaron;

        return $this;
    }

    /**
     * Get firstBaron
     *
     * @return bool
     */
    public function getFirstBaron()
    {
        return $this->firstBaron;
    }

    /**
     * Set firstDragon
     *
     * @param boolean $firstDragon
     *
     * @return TeamOneGameStat
     */
    public function setFirstDragon($firstDragon)
    {
        $this->firstDragon = $firstDragon;

        return $this;
    }

    /**
     * Get firstDragon
     *
     * @return bool
     */
    public function getFirstDragon()
    {
        return $this->firstDragon;
    }

    /**
     * Set firstRiftHerald
     *
     * @param boolean $firstRiftHerald
     *
     * @return TeamOneGameStat
     */
    public function setFirstRiftHerald($firstRiftHerald)
    {
        $this->firstRiftHerald = $firstRiftHerald;

        return $this;
    }

    /**
     * Get firstRiftHerald
     *
     * @return bool
     */
    public function getFirstRiftHerald()
    {
        return $this->firstRiftHerald;
    }

    /**
     * Set towerKills
     *
     * @param integer $towerKills
     *
     * @return TeamOneGameStat
     */
    public function setTowerKills($towerKills)
    {
        $this->towerKills = $towerKills;

        return $this;
    }

    /**
     * Get towerKills
     *
     * @return int
     */
    public function getTowerKills()
    {
        return $this->towerKills;
    }

    /**
     * Set inhibitorKills
     *
     * @param integer $inhibitorKills
     *
     * @return TeamOneGameStat
     */
    public function setInhibitorKills($inhibitorKills)
    {
        $this->inhibitorKills = $inhibitorKills;

        return $this;
    }

    /**
     * Get inhibitorKills
     *
     * @return int
     */
    public function getInhibitorKills()
    {
        return $this->inhibitorKills;
    }

    /**
     * Set baronKills
     *
     * @param integer $baronKills
     *
     * @return TeamOneGameStat
     */
    public function setBaronKills($baronKills)
    {
        $this->baronKills = $baronKills;

        return $this;
    }

    /**
     * Get baronKills
     *
     * @return int
     */
    public function getBaronKills()
    {
        return $this->baronKills;
    }

    /**
     * Set dragonKills
     *
     * @param integer $dragonKills
     *
     * @return TeamOneGameStat
     */
    public function setDragonKills($dragonKills)
    {
        $this->dragonKills = $dragonKills;

        return $this;
    }

    /**
     * Get dragonKills
     *
     * @return int
     */
    public function getDragonKills()
    {
        return $this->dragonKills;
    }

    /**
     * Set vilemawKills
     *
     * @param integer $vilemawKills
     *
     * @return TeamOneGameStat
     */
    public function setVilemawKills($vilemawKills)
    {
        $this->vilemawKills = $vilemawKills;

        return $this;
    }

    /**
     * Get vilemawKills
     *
     * @return int
     */
    public function getVilemawKills()
    {
        return $this->vilemawKills;
    }

    /**
     * Set riftHeraldKills
     *
     * @param integer $riftHeraldKills
     *
     * @return TeamOneGameStat
     */
    public function setRiftHeraldKills($riftHeraldKills)
    {
        $this->riftHeraldKills = $riftHeraldKills;

        return $this;
    }

    /**
     * Get riftHeraldKills
     *
     * @return int
     */
    public function getRiftHeraldKills()
    {
        return $this->riftHeraldKills;
    }

    /**
     * @return mixed
     */
    public function getFirstBan()
    {
        return $this->firstBan;
    }

    /**
     * @param mixed $firstBan
     */
    public function setFirstBan($firstBan)
    {
        $this->firstBan = $firstBan;
    }

    /**
     * @return mixed
     */
    public function getSecondBan()
    {
        return $this->secondBan;
    }

    /**
     * @param mixed $secondBan
     */
    public function setSecondBan($secondBan)
    {
        $this->secondBan = $secondBan;
    }

    /**
     * @return mixed
     */
    public function getThirdBan()
    {
        return $this->thirdBan;
    }

    /**
     * @param mixed $thirdBan
     */
    public function setThirdBan($thirdBan)
    {
        $this->thirdBan = $thirdBan;
    }

    /**
     * @return mixed
     */
    public function getFourthBan()
    {
        return $this->fourthBan;
    }

    /**
     * @param mixed $fourthBan
     */
    public function setFourthBan($fourthBan)
    {
        $this->fourthBan = $fourthBan;
    }

    /**
     * @return mixed
     */
    public function getFifthBan()
    {
        return $this->fifthBan;
    }

    /**
     * @param mixed $fifthBan
     */
    public function setFifthBan($fifthBan)
    {
        $this->fifthBan = $fifthBan;
    }

    /**
     * @param $data
     * @return $this
     */
    public function set($data)
    {
        $has = get_object_vars($this);
        foreach ($has as $name => $oldValue) {
            if (isset($data[$name]) && $name != 'id')
                $this->$name = $data[$name];
        }
        return $this;
    }
}

