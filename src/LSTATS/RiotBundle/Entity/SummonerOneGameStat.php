<?php

namespace LSTATS\RiotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * SummonerOneGameStat
 *
 * @ORM\Table(name="lstats_summoner_one_game_stat")
 * @ORM\Entity(repositoryClass="LSTATS\RiotBundle\Repository\SummonerOneGameStatRepository")
 */
class SummonerOneGameStat
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
     * @ORM\ManyToOne(targetEntity="Game")
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $game;

    /**
     * @ORM\ManyToOne(targetEntity="Summoner")
     * @ORM\JoinColumn(name="summoner_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $summoner;

    /**
     * @var int
     *
     * @ORM\Column(name="spell1Id", type="integer")
     */
    private $spell1Id;

    /**
     * @var int
     *
     * @ORM\Column(name="spell2Id", type="integer")
     */
    private $spell2Id;

    /**
     * @var string
     *
     * @ORM\Column(name="masteries", type="text")
     */
    private $masteries;

    /**
     * @var string
     *
     * @ORM\Column(name="runes", type="text")
     */
    private $runes;

    /**
     * @var string
     *
     * @ORM\Column(name="highestAchievedSeasonTier", type="string", length=255)
     */
    private $highestAchievedSeasonTier;

    /**
     * @var bool
     *
     * @ORM\Column(name="win", type="boolean")
     */
    private $win;

    /**
     * @var int
     *
     * @ORM\Column(name="item0", type="integer")
     */
    private $item0;

    /**
     * @var int
     *
     * @ORM\Column(name="item1", type="integer")
     */
    private $item1;

    /**
     * @var int
     *
     * @ORM\Column(name="item2", type="integer")
     */
    private $item2;

    /**
     * @var int
     *
     * @ORM\Column(name="item3", type="integer")
     */
    private $item3;

    /**
     * @var int
     *
     * @ORM\Column(name="item4", type="integer")
     */
    private $item4;

    /**
     * @var int
     *
     * @ORM\Column(name="item5", type="integer")
     */
    private $item5;

    /**
     * @var int
     *
     * @ORM\Column(name="item6", type="integer")
     */
    private $item6;

    /**
     * @var int
     *
     * @ORM\Column(name="kills", type="integer")
     */
    private $kills;

    /**
     * @var int
     *
     * @ORM\Column(name="deaths", type="integer")
     */
    private $deaths;

    /**
     * @var int
     *
     * @ORM\Column(name="assists", type="integer")
     */
    private $assists;

    /**
     * @var int
     *
     * @ORM\Column(name="largestKillingSpree", type="integer")
     */
    private $largestKillingSpree;

    /**
     * @var int
     *
     * @ORM\Column(name="largestMultiKill", type="integer")
     */
    private $largestMultiKill;

    /**
     * @var int
     *
     * @ORM\Column(name="killingSprees", type="integer")
     */
    private $killingSprees;

    /**
     * @var int
     *
     * @ORM\Column(name="longestTimeSpentLiving", type="integer")
     */
    private $longestTimeSpentLiving;

    /**
     * @var int
     *
     * @ORM\Column(name="doubleKills", type="integer")
     */
    private $doubleKills;

    /**
     * @var int
     *
     * @ORM\Column(name="tripleKills", type="integer")
     */
    private $tripleKills;

    /**
     * @var int
     *
     * @ORM\Column(name="quadraKills", type="integer")
     */
    private $quadraKills;

    /**
     * @var int
     *
     * @ORM\Column(name="pentaKills", type="integer")
     */
    private $pentaKills;

    /**
     * @var int
     *
     * @ORM\Column(name="unrealKills", type="integer")
     */
    private $unrealKills;

    /**
     * @var int
     *
     * @ORM\Column(name="totalDamageDealt", type="integer")
     */
    private $totalDamageDealt;

    /**
     * @var int
     *
     * @ORM\Column(name="magicDamageDealt", type="integer")
     */
    private $magicDamageDealt;

    /**
     * @var int
     *
     * @ORM\Column(name="physicalDamageDealt", type="integer")
     */
    private $physicalDamageDealt;

    /**
     * @var int
     *
     * @ORM\Column(name="trueDamageDealt", type="integer")
     */
    private $trueDamageDealt;

    /**
     * @var int
     *
     * @ORM\Column(name="largestCriticalStrike", type="integer")
     */
    private $largestCriticalStrike;

    /**
     * @var int
     *
     * @ORM\Column(name="totalDamageDealtToChampions", type="integer")
     */
    private $totalDamageDealtToChampions;

    /**
     * @var int
     *
     * @ORM\Column(name="magicDamageDealtToChampions", type="integer")
     */
    private $magicDamageDealtToChampions;

    /**
     * @var int
     *
     * @ORM\Column(name="physicalDamageDealtToChampions", type="integer")
     */
    private $physicalDamageDealtToChampions;

    /**
     * @var int
     *
     * @ORM\Column(name="trueDamageDealtToChampions", type="integer")
     */
    private $trueDamageDealtToChampions;

    /**
     * @var int
     *
     * @ORM\Column(name="totalHeal", type="integer")
     */
    private $totalHeal;

    /**
     * @var int
     *
     * @ORM\Column(name="totalUnitsHealed", type="integer")
     */
    private $totalUnitsHealed;

    /**
     * @var int
     *
     * @ORM\Column(name="damageSelfMitigated", type="integer")
     */
    private $damageSelfMitigated;

    /**
     * @var int
     *
     * @ORM\Column(name="damageDealtToObjectives", type="integer")
     */
    private $damageDealtToObjectives;

    /**
     * @var int
     *
     * @ORM\Column(name="damageDealtToTurrets", type="integer")
     */
    private $damageDealtToTurrets;

    /**
     * @var int
     *
     * @ORM\Column(name="visionScore", type="integer")
     */
    private $visionScore;

    /**
     * @var int
     *
     * @ORM\Column(name="timeCCingOthers", type="integer")
     */
    private $timeCCingOthers;

    /**
     * @var int
     *
     * @ORM\Column(name="totalDamageTaken", type="integer")
     */
    private $totalDamageTaken;

    /**
     * @var int
     *
     * @ORM\Column(name="magicalDamageTaken", type="integer")
     */
    private $magicalDamageTaken;

    /**
     * @var int
     *
     * @ORM\Column(name="physicalDamageTaken", type="integer")
     */
    private $physicalDamageTaken;

    /**
     * @var int
     *
     * @ORM\Column(name="trueDamageTaken", type="integer")
     */
    private $trueDamageTaken;

    /**
     * @var int
     *
     * @ORM\Column(name="goldEarned", type="integer")
     */
    private $goldEarned;

    /**
     * @var int
     *
     * @ORM\Column(name="goldSpent", type="integer")
     */
    private $goldSpent;

    /**
     * @var int
     *
     * @ORM\Column(name="turretKills", type="integer")
     */
    private $turretKills;

    /**
     * @var int
     *
     * @ORM\Column(name="inhibitorKills", type="integer")
     */
    private $inhibitorKills;

    /**
     * @var int
     *
     * @ORM\Column(name="totalMinionsKilled", type="integer")
     */
    private $totalMinionsKilled;

    /**
     * @var int
     *
     * @ORM\Column(name="neutralMinionsKilled", type="integer")
     */
    private $neutralMinionsKilled;

    /**
     * @var int
     *
     * @ORM\Column(name="neutralMinionsKilledTeamJungle", type="integer")
     */
    private $neutralMinionsKilledTeamJungle;

    /**
     * @var int
     *
     * @ORM\Column(name="neutralMinionsKilledEnemyJungle", type="integer")
     */
    private $neutralMinionsKilledEnemyJungle;

    /**
     * @var int
     *
     * @ORM\Column(name="totalTimeCrowdControlDealt", type="integer")
     */
    private $totalTimeCrowdControlDealt;

    /**
     * @var int
     *
     * @ORM\Column(name="champLevel", type="integer")
     */
    private $champLevel;

    /**
     * @var int
     *
     * @ORM\Column(name="visionWardsBoughtInGame", type="integer")
     */
    private $visionWardsBoughtInGame;

    /**
     * @var int
     *
     * @ORM\Column(name="sightWardsBoughtInGame", type="integer")
     */
    private $sightWardsBoughtInGame;

    /**
     * @var int
     *
     * @ORM\Column(name="wardsPlaced", type="integer")
     */
    private $wardsPlaced;

    /**
     * @var int
     *
     * @ORM\Column(name="wardsKilled", type="integer")
     */
    private $wardsKilled;

    /**
     * @var bool
     *
     * @ORM\Column(name="firstBloodKill", type="boolean")
     */
    private $firstBloodKill;

    /**
     * @var bool
     *
     * @ORM\Column(name="firstBloodAssist", type="boolean")
     */
    private $firstBloodAssist;

    /**
     * @var float
     *
     * @ORM\Column(name="firstTowerKill", type="boolean")
     */
    private $firstTowerKill;

    /**
     * @var bool
     *
     * @ORM\Column(name="firstTowerAssist", type="boolean")
     */
    private $firstTowerAssist;

    /**
     * @var bool
     *
     * @ORM\Column(name="firstInhibitorKill", type="boolean")
     */
    private $firstInhibitorKill;

    /**
     * @var bool
     *
     * @ORM\Column(name="firstInhibitorAssist", type="boolean")
     */
    private $firstInhibitorAssist;

    /**
     * @var int
     *
     * @ORM\Column(name="combatPlayerScore", type="integer")
     */
    private $combatPlayerScore;

    /**
     * @var string
     *
     * @ORM\Column(name="objectivePlayerScore", type="integer")
     */
    private $objectivePlayerScore;

    /**
     * @var int
     *
     * @ORM\Column(name="totalPlayerScore", type="integer")
     */
    private $totalPlayerScore;

    /**
     * @var int
     *
     * @ORM\Column(name="totalScoreRank", type="integer")
     */
    private $totalScoreRank;

    /**
     * @var string
     *
     * @ORM\Column(name="creepsPerMinDeltas", type="text")
     */
    private $creepsPerMinDeltas;

    /**
     * @var string
     *
     * @ORM\Column(name="xpPerMinDeltas", type="text")
     */
    private $xpPerMinDeltas;

    /**
     * @var string
     *
     * @ORM\Column(name="goldPerMinDeltas", type="text")
     */
    private $goldPerMinDeltas;

    /**
     * @var string
     *
     * @ORM\Column(name="csDiffPerMinDeltas", type="text")
     */
    private $csDiffPerMinDeltas;

    /**
     * @var string
     *
     * @ORM\Column(name="xpDiffPerMinDeltas", type="text")
     */
    private $xpDiffPerMinDeltas;

    /**
     * @var string
     *
     * @ORM\Column(name="damageTakenPerMinDeltas", type="text")
     */
    private $damageTakenPerMinDeltas;

    /**
     * @var string
     *
     * @ORM\Column(name="damageTakenDiffPerMinDeltas", type="text")
     */
    private $damageTakenDiffPerMinDeltas;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=255)
     */
    private $role;

    /**
     * @var string
     *
     * @ORM\Column(name="lane", type="string", length=255)
     */
    private $lane;

    public function __construct()
    {
        $has = get_object_vars($this);
        foreach ($has as $name => $oldValue) {
            $this->$name = 0;
        }
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
     * Set spell1Id
     *
     * @param integer $spell1Id
     *
     * @return SummonerOneGameStat
     */
    public function setSpell1Id($spell1Id)
    {
        $this->spell1Id = $spell1Id;

        return $this;
    }

    /**
     * Get spell1Id
     *
     * @return int
     */
    public function getSpell1Id()
    {
        return $this->spell1Id;
    }

    /**
     * Set spell2Id
     *
     * @param integer $spell2Id
     *
     * @return SummonerOneGameStat
     */
    public function setSpell2Id($spell2Id)
    {
        $this->spell2Id = $spell2Id;

        return $this;
    }

    /**
     * Get spell2Id
     *
     * @return int
     */
    public function getSpell2Id()
    {
        return $this->spell2Id;
    }

    /**
     * Set masteries
     *
     * @param string $masteries
     *
     * @return SummonerOneGameStat
     */
    public function setMasteries($masteries)
    {

        try {
            $this->masteries = json_encode($masteries);
        } catch (\Exception $e) {
            $this->masteries = '';
        }
        return $this;
    }

    /**
     * Get masteries
     *
     * @return string
     */
    public function getMasteries()
    {
        return json_decode($this->masteries, true);
    }

    /**
     * Set runes
     *
     * @param string $runes
     *
     * @return SummonerOneGameStat
     */
    public function setRunes($runes)
    {
        try {
            $this->runes = json_encode($runes);
        } catch (\Exception $e) {
            $this->runes = '';
        }
        return $this;
    }

    /**
     * Get runes
     *
     * @return string
     */
    public function getRunes()
    {
        return json_decode($this->runes, true);
    }

    /**
     * Set highestAchievedSeasonTier
     *
     * @param string $highestAchievedSeasonTier
     *
     * @return SummonerOneGameStat
     */
    public function setHighestAchievedSeasonTier($highestAchievedSeasonTier)
    {
        $this->highestAchievedSeasonTier = $highestAchievedSeasonTier;

        return $this;
    }

    /**
     * Get highestAchievedSeasonTier
     *
     * @return string
     */
    public function getHighestAchievedSeasonTier()
    {
        return $this->highestAchievedSeasonTier;
    }

    /**
     * Set win
     *
     * @param boolean $win
     *
     * @return SummonerOneGameStat
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
     * Set item0
     *
     * @param integer $item0
     *
     * @return SummonerOneGameStat
     */
    public function setItem0($item0)
    {
        $this->item0 = $item0;

        return $this;
    }

    /**
     * Get item0
     *
     * @return int
     */
    public function getItem0()
    {
        return $this->item0;
    }

    /**
     * Set item1
     *
     * @param integer $item1
     *
     * @return SummonerOneGameStat
     */
    public function setItem1($item1)
    {
        $this->item1 = $item1;

        return $this;
    }

    /**
     * Get item1
     *
     * @return int
     */
    public function getItem1()
    {
        return $this->item1;
    }

    /**
     * Set item2
     *
     * @param integer $item2
     *
     * @return SummonerOneGameStat
     */
    public function setItem2($item2)
    {
        $this->item2 = $item2;

        return $this;
    }

    /**
     * Get item2
     *
     * @return int
     */
    public function getItem2()
    {
        return $this->item2;
    }

    /**
     * Set item3
     *
     * @param integer $item3
     *
     * @return SummonerOneGameStat
     */
    public function setItem3($item3)
    {
        $this->item3 = $item3;

        return $this;
    }

    /**
     * Get item3
     *
     * @return int
     */
    public function getItem3()
    {
        return $this->item3;
    }

    /**
     * Set item4
     *
     * @param integer $item4
     *
     * @return SummonerOneGameStat
     */
    public function setItem4($item4)
    {
        $this->item4 = $item4;

        return $this;
    }

    /**
     * Get item4
     *
     * @return int
     */
    public function getItem4()
    {
        return $this->item4;
    }

    /**
     * Set item5
     *
     * @param integer $item5
     *
     * @return SummonerOneGameStat
     */
    public function setItem5($item5)
    {
        $this->item5 = $item5;

        return $this;
    }

    /**
     * Get item5
     *
     * @return int
     */
    public function getItem5()
    {
        return $this->item5;
    }

    /**
     * Set item6
     *
     * @param integer $item6
     *
     * @return SummonerOneGameStat
     */
    public function setItem6($item6)
    {
        $this->item6 = $item6;

        return $this;
    }

    /**
     * Get item6
     *
     * @return int
     */
    public function getItem6()
    {
        return $this->item6;
    }

    /**
     * Set kills
     *
     * @param integer $kills
     *
     * @return SummonerOneGameStat
     */
    public function setKills($kills)
    {
        $this->kills = $kills;

        return $this;
    }

    /**
     * Get kills
     *
     * @return int
     */
    public function getKills()
    {
        return $this->kills;
    }

    /**
     * Set deaths
     *
     * @param integer $deaths
     *
     * @return SummonerOneGameStat
     */
    public function setDeaths($deaths)
    {
        $this->deaths = $deaths;

        return $this;
    }

    /**
     * Get deaths
     *
     * @return int
     */
    public function getDeaths()
    {
        return $this->deaths;
    }

    /**
     * Set assists
     *
     * @param integer $assists
     *
     * @return SummonerOneGameStat
     */
    public function setAssists($assists)
    {
        $this->assists = $assists;

        return $this;
    }

    /**
     * Get assists
     *
     * @return int
     */
    public function getAssists()
    {
        return $this->assists;
    }

    /**
     * Set largestKillingSpree
     *
     * @param integer $largestKillingSpree
     *
     * @return SummonerOneGameStat
     */
    public function setLargestKillingSpree($largestKillingSpree)
    {
        $this->largestKillingSpree = $largestKillingSpree;

        return $this;
    }

    /**
     * Get largestKillingSpree
     *
     * @return int
     */
    public function getLargestKillingSpree()
    {
        return $this->largestKillingSpree;
    }

    /**
     * Set largestMultiKill
     *
     * @param integer $largestMultiKill
     *
     * @return SummonerOneGameStat
     */
    public function setLargestMultiKill($largestMultiKill)
    {
        $this->largestMultiKill = $largestMultiKill;

        return $this;
    }

    /**
     * Get largestMultiKill
     *
     * @return int
     */
    public function getLargestMultiKill()
    {
        return $this->largestMultiKill;
    }

    /**
     * Set killingSprees
     *
     * @param integer $killingSprees
     *
     * @return SummonerOneGameStat
     */
    public function setKillingSprees($killingSprees)
    {
        $this->killingSprees = $killingSprees;

        return $this;
    }

    /**
     * Get killingSprees
     *
     * @return int
     */
    public function getKillingSprees()
    {
        return $this->killingSprees;
    }

    /**
     * Set longestTimeSpentLiving
     *
     * @param integer $longestTimeSpentLiving
     *
     * @return SummonerOneGameStat
     */
    public function setLongestTimeSpentLiving($longestTimeSpentLiving)
    {
        $this->longestTimeSpentLiving = $longestTimeSpentLiving;

        return $this;
    }

    /**
     * Get longestTimeSpentLiving
     *
     * @return int
     */
    public function getLongestTimeSpentLiving()
    {
        return $this->longestTimeSpentLiving;
    }

    /**
     * Set doubleKills
     *
     * @param integer $doubleKills
     *
     * @return SummonerOneGameStat
     */
    public function setDoubleKills($doubleKills)
    {
        $this->doubleKills = $doubleKills;

        return $this;
    }

    /**
     * Get doubleKills
     *
     * @return int
     */
    public function getDoubleKills()
    {
        return $this->doubleKills;
    }

    /**
     * Set tripleKills
     *
     * @param integer $tripleKills
     *
     * @return SummonerOneGameStat
     */
    public function setTripleKills($tripleKills)
    {
        $this->tripleKills = $tripleKills;

        return $this;
    }

    /**
     * Get tripleKills
     *
     * @return int
     */
    public function getTripleKills()
    {
        return $this->tripleKills;
    }

    /**
     * Set quadraKills
     *
     * @param integer $quadraKills
     *
     * @return SummonerOneGameStat
     */
    public function setQuadraKills($quadraKills)
    {
        $this->quadraKills = $quadraKills;

        return $this;
    }

    /**
     * Get quadraKills
     *
     * @return int
     */
    public function getQuadraKills()
    {
        return $this->quadraKills;
    }

    /**
     * Set pentaKills
     *
     * @param integer $pentaKills
     *
     * @return SummonerOneGameStat
     */
    public function setPentaKills($pentaKills)
    {
        $this->pentaKills = $pentaKills;

        return $this;
    }

    /**
     * Get pentaKills
     *
     * @return int
     */
    public function getPentaKills()
    {
        return $this->pentaKills;
    }

    /**
     * Set unrealKills
     *
     * @param integer $unrealKills
     *
     * @return SummonerOneGameStat
     */
    public function setUnrealKills($unrealKills)
    {
        $this->unrealKills = $unrealKills;

        return $this;
    }

    /**
     * Get unrealKills
     *
     * @return int
     */
    public function getUnrealKills()
    {
        return $this->unrealKills;
    }

    /**
     * Set totalDamageDealt
     *
     * @param integer $totalDamageDealt
     *
     * @return SummonerOneGameStat
     */
    public function setTotalDamageDealt($totalDamageDealt)
    {
        $this->totalDamageDealt = $totalDamageDealt;

        return $this;
    }

    /**
     * Get totalDamageDealt
     *
     * @return int
     */
    public function getTotalDamageDealt()
    {
        return $this->totalDamageDealt;
    }

    /**
     * Set magicDamageDealt
     *
     * @param integer $magicDamageDealt
     *
     * @return SummonerOneGameStat
     */
    public function setMagicDamageDealt($magicDamageDealt)
    {
        $this->magicDamageDealt = $magicDamageDealt;

        return $this;
    }

    /**
     * Get magicDamageDealt
     *
     * @return int
     */
    public function getMagicDamageDealt()
    {
        return $this->magicDamageDealt;
    }

    /**
     * Set physicalDamageDealt
     *
     * @param integer $physicalDamageDealt
     *
     * @return SummonerOneGameStat
     */
    public function setPhysicalDamageDealt($physicalDamageDealt)
    {
        $this->physicalDamageDealt = $physicalDamageDealt;

        return $this;
    }

    /**
     * Get physicalDamageDealt
     *
     * @return int
     */
    public function getPhysicalDamageDealt()
    {
        return $this->physicalDamageDealt;
    }

    /**
     * Set trueDamageDealt
     *
     * @param integer $trueDamageDealt
     *
     * @return SummonerOneGameStat
     */
    public function setTrueDamageDealt($trueDamageDealt)
    {
        $this->trueDamageDealt = $trueDamageDealt;

        return $this;
    }

    /**
     * Get trueDamageDealt
     *
     * @return int
     */
    public function getTrueDamageDealt()
    {
        return $this->trueDamageDealt;
    }

    /**
     * Set largestCriticalStrike
     *
     * @param integer $largestCriticalStrike
     *
     * @return SummonerOneGameStat
     */
    public function setLargestCriticalStrike($largestCriticalStrike)
    {
        $this->largestCriticalStrike = $largestCriticalStrike;

        return $this;
    }

    /**
     * Get largestCriticalStrike
     *
     * @return int
     */
    public function getLargestCriticalStrike()
    {
        return $this->largestCriticalStrike;
    }

    /**
     * Set totalDamageDealtToChampions
     *
     * @param integer $totalDamageDealtToChampions
     *
     * @return SummonerOneGameStat
     */
    public function setTotalDamageDealtToChampions($totalDamageDealtToChampions)
    {
        $this->totalDamageDealtToChampions = $totalDamageDealtToChampions;

        return $this;
    }

    /**
     * Get totalDamageDealtToChampions
     *
     * @return int
     */
    public function getTotalDamageDealtToChampions()
    {
        return $this->totalDamageDealtToChampions;
    }

    /**
     * Set magicDamageDealtToChampions
     *
     * @param integer $magicDamageDealtToChampions
     *
     * @return SummonerOneGameStat
     */
    public function setMagicDamageDealtToChampions($magicDamageDealtToChampions)
    {
        $this->magicDamageDealtToChampions = $magicDamageDealtToChampions;

        return $this;
    }

    /**
     * Get magicDamageDealtToChampions
     *
     * @return int
     */
    public function getMagicDamageDealtToChampions()
    {
        return $this->magicDamageDealtToChampions;
    }

    /**
     * Set physicalDamageDealtToChampions
     *
     * @param integer $physicalDamageDealtToChampions
     *
     * @return SummonerOneGameStat
     */
    public function setPhysicalDamageDealtToChampions($physicalDamageDealtToChampions)
    {
        $this->physicalDamageDealtToChampions = $physicalDamageDealtToChampions;

        return $this;
    }

    /**
     * Get physicalDamageDealtToChampions
     *
     * @return int
     */
    public function getPhysicalDamageDealtToChampions()
    {
        return $this->physicalDamageDealtToChampions;
    }

    /**
     * Set trueDamageDealtToChampions
     *
     * @param integer $trueDamageDealtToChampions
     *
     * @return SummonerOneGameStat
     */
    public function setTrueDamageDealtToChampions($trueDamageDealtToChampions)
    {
        $this->trueDamageDealtToChampions = $trueDamageDealtToChampions;

        return $this;
    }

    /**
     * Get trueDamageDealtToChampions
     *
     * @return int
     */
    public function getTrueDamageDealtToChampions()
    {
        return $this->trueDamageDealtToChampions;
    }

    /**
     * Set totalHeal
     *
     * @param integer $totalHeal
     *
     * @return SummonerOneGameStat
     */
    public function setTotalHeal($totalHeal)
    {
        $this->totalHeal = $totalHeal;

        return $this;
    }

    /**
     * Get totalHeal
     *
     * @return int
     */
    public function getTotalHeal()
    {
        return $this->totalHeal;
    }

    /**
     * Set totalUnitsHealed
     *
     * @param integer $totalUnitsHealed
     *
     * @return SummonerOneGameStat
     */
    public function setTotalUnitsHealed($totalUnitsHealed)
    {
        $this->totalUnitsHealed = $totalUnitsHealed;

        return $this;
    }

    /**
     * Get totalUnitsHealed
     *
     * @return int
     */
    public function getTotalUnitsHealed()
    {
        return $this->totalUnitsHealed;
    }

    /**
     * Set damageSelfMitigated
     *
     * @param integer $damageSelfMitigated
     *
     * @return SummonerOneGameStat
     */
    public function setDamageSelfMitigated($damageSelfMitigated)
    {
        $this->damageSelfMitigated = $damageSelfMitigated;

        return $this;
    }

    /**
     * Get damageSelfMitigated
     *
     * @return int
     */
    public function getDamageSelfMitigated()
    {
        return $this->damageSelfMitigated;
    }

    /**
     * Set damageDealtToObjectives
     *
     * @param integer $damageDealtToObjectives
     *
     * @return SummonerOneGameStat
     */
    public function setDamageDealtToObjectives($damageDealtToObjectives)
    {
        $this->damageDealtToObjectives = $damageDealtToObjectives;

        return $this;
    }

    /**
     * Get damageDealtToObjectives
     *
     * @return int
     */
    public function getDamageDealtToObjectives()
    {
        return $this->damageDealtToObjectives;
    }

    /**
     * Set damageDealtToTurrets
     *
     * @param integer $damageDealtToTurrets
     *
     * @return SummonerOneGameStat
     */
    public function setDamageDealtToTurrets($damageDealtToTurrets)
    {
        $this->damageDealtToTurrets = $damageDealtToTurrets;

        return $this;
    }

    /**
     * Get damageDealtToTurrets
     *
     * @return int
     */
    public function getDamageDealtToTurrets()
    {
        return $this->damageDealtToTurrets;
    }

    /**
     * Set visionScore
     *
     * @param integer $visionScore
     *
     * @return SummonerOneGameStat
     */
    public function setVisionScore($visionScore)
    {
        $this->visionScore = $visionScore;

        return $this;
    }

    /**
     * Get visionScore
     *
     * @return int
     */
    public function getVisionScore()
    {
        return $this->visionScore;
    }

    /**
     * Set timeCCingOthers
     *
     * @param integer $timeCCingOthers
     *
     * @return SummonerOneGameStat
     */
    public function setTimeCCingOthers($timeCCingOthers)
    {
        $this->timeCCingOthers = $timeCCingOthers;

        return $this;
    }

    /**
     * Get timeCCingOthers
     *
     * @return int
     */
    public function getTimeCCingOthers()
    {
        return $this->timeCCingOthers;
    }

    /**
     * Set totalDamageTaken
     *
     * @param integer $totalDamageTaken
     *
     * @return SummonerOneGameStat
     */
    public function setTotalDamageTaken($totalDamageTaken)
    {
        $this->totalDamageTaken = $totalDamageTaken;

        return $this;
    }

    /**
     * Get totalDamageTaken
     *
     * @return int
     */
    public function getTotalDamageTaken()
    {
        return $this->totalDamageTaken;
    }

    /**
     * Set magicalDamageTaken
     *
     * @param integer $magicalDamageTaken
     *
     * @return SummonerOneGameStat
     */
    public function setMagicalDamageTaken($magicalDamageTaken)
    {
        $this->magicalDamageTaken = $magicalDamageTaken;

        return $this;
    }

    /**
     * Get magicalDamageTaken
     *
     * @return int
     */
    public function getMagicalDamageTaken()
    {
        return $this->magicalDamageTaken;
    }

    /**
     * Set physicalDamageTaken
     *
     * @param integer $physicalDamageTaken
     *
     * @return SummonerOneGameStat
     */
    public function setPhysicalDamageTaken($physicalDamageTaken)
    {
        $this->physicalDamageTaken = $physicalDamageTaken;

        return $this;
    }

    /**
     * Get physicalDamageTaken
     *
     * @return int
     */
    public function getPhysicalDamageTaken()
    {
        return $this->physicalDamageTaken;
    }

    /**
     * Set trueDamageTaken
     *
     * @param integer $trueDamageTaken
     *
     * @return SummonerOneGameStat
     */
    public function setTrueDamageTaken($trueDamageTaken)
    {
        $this->trueDamageTaken = $trueDamageTaken;

        return $this;
    }

    /**
     * Get trueDamageTaken
     *
     * @return int
     */
    public function getTrueDamageTaken()
    {
        return $this->trueDamageTaken;
    }

    /**
     * Set goldEarned
     *
     * @param integer $goldEarned
     *
     * @return SummonerOneGameStat
     */
    public function setGoldEarned($goldEarned)
    {
        $this->goldEarned = $goldEarned;

        return $this;
    }

    /**
     * Get goldEarned
     *
     * @return int
     */
    public function getGoldEarned()
    {
        return $this->goldEarned;
    }

    /**
     * Set goldSpent
     *
     * @param integer $goldSpent
     *
     * @return SummonerOneGameStat
     */
    public function setGoldSpent($goldSpent)
    {
        $this->goldSpent = $goldSpent;

        return $this;
    }

    /**
     * Get goldSpent
     *
     * @return int
     */
    public function getGoldSpent()
    {
        return $this->goldSpent;
    }

    /**
     * Set turretKills
     *
     * @param integer $turretKills
     *
     * @return SummonerOneGameStat
     */
    public function setTurretKills($turretKills)
    {
        $this->turretKills = $turretKills;

        return $this;
    }

    /**
     * Get turretKills
     *
     * @return int
     */
    public function getTurretKills()
    {
        return $this->turretKills;
    }

    /**
     * Set inhibitorKills
     *
     * @param integer $inhibitorKills
     *
     * @return SummonerOneGameStat
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
     * Set totalMinionsKilled
     *
     * @param integer $totalMinionsKilled
     *
     * @return SummonerOneGameStat
     */
    public function setTotalMinionsKilled($totalMinionsKilled)
    {
        $this->totalMinionsKilled = $totalMinionsKilled;

        return $this;
    }

    /**
     * Get totalMinionsKilled
     *
     * @return int
     */
    public function getTotalMinionsKilled()
    {
        return $this->totalMinionsKilled;
    }

    /**
     * Set neutralMinionsKilled
     *
     * @param integer $neutralMinionsKilled
     *
     * @return SummonerOneGameStat
     */
    public function setNeutralMinionsKilled($neutralMinionsKilled)
    {
        $this->neutralMinionsKilled = $neutralMinionsKilled;

        return $this;
    }

    /**
     * Get neutralMinionsKilled
     *
     * @return int
     */
    public function getNeutralMinionsKilled()
    {
        return $this->neutralMinionsKilled;
    }

    /**
     * Set neutralMinionsKilledTeamJungle
     *
     * @param integer $neutralMinionsKilledTeamJungle
     *
     * @return SummonerOneGameStat
     */
    public function setNeutralMinionsKilledTeamJungle($neutralMinionsKilledTeamJungle)
    {
        $this->neutralMinionsKilledTeamJungle = $neutralMinionsKilledTeamJungle;

        return $this;
    }

    /**
     * Get neutralMinionsKilledTeamJungle
     *
     * @return int
     */
    public function getNeutralMinionsKilledTeamJungle()
    {
        return $this->neutralMinionsKilledTeamJungle;
    }

    /**
     * Set neutralMinionsKilledEnemyJungle
     *
     * @param integer $neutralMinionsKilledEnemyJungle
     *
     * @return SummonerOneGameStat
     */
    public function setNeutralMinionsKilledEnemyJungle($neutralMinionsKilledEnemyJungle)
    {
        $this->neutralMinionsKilledEnemyJungle = $neutralMinionsKilledEnemyJungle;

        return $this;
    }

    /**
     * Get neutralMinionsKilledEnemyJungle
     *
     * @return int
     */
    public function getNeutralMinionsKilledEnemyJungle()
    {
        return $this->neutralMinionsKilledEnemyJungle;
    }

    /**
     * Set totalTimeCrowdControlDealt
     *
     * @param integer $totalTimeCrowdControlDealt
     *
     * @return SummonerOneGameStat
     */
    public function setTotalTimeCrowdControlDealt($totalTimeCrowdControlDealt)
    {
        $this->totalTimeCrowdControlDealt = $totalTimeCrowdControlDealt;

        return $this;
    }

    /**
     * Get totalTimeCrowdControlDealt
     *
     * @return int
     */
    public function getTotalTimeCrowdControlDealt()
    {
        return $this->totalTimeCrowdControlDealt;
    }

    /**
     * Set champLevel
     *
     * @param integer $champLevel
     *
     * @return SummonerOneGameStat
     */
    public function setChampLevel($champLevel)
    {
        $this->champLevel = $champLevel;

        return $this;
    }

    /**
     * Get champLevel
     *
     * @return int
     */
    public function getChampLevel()
    {
        return $this->champLevel;
    }

    /**
     * Set visionWardsBoughtInGame
     *
     * @param integer $visionWardsBoughtInGame
     *
     * @return SummonerOneGameStat
     */
    public function setVisionWardsBoughtInGame($visionWardsBoughtInGame)
    {
        $this->visionWardsBoughtInGame = $visionWardsBoughtInGame;

        return $this;
    }

    /**
     * Get visionWardsBoughtInGame
     *
     * @return int
     */
    public function getVisionWardsBoughtInGame()
    {
        return $this->visionWardsBoughtInGame;
    }

    /**
     * Set sightWardsBoughtInGame
     *
     * @param integer $sightWardsBoughtInGame
     *
     * @return SummonerOneGameStat
     */
    public function setSightWardsBoughtInGame($sightWardsBoughtInGame)
    {
        $this->sightWardsBoughtInGame = $sightWardsBoughtInGame;

        return $this;
    }

    /**
     * Get sightWardsBoughtInGame
     *
     * @return int
     */
    public function getSightWardsBoughtInGame()
    {
        return $this->sightWardsBoughtInGame;
    }

    /**
     * Set wardsPlaced
     *
     * @param integer $wardsPlaced
     *
     * @return SummonerOneGameStat
     */
    public function setWardsPlaced($wardsPlaced)
    {
        $this->wardsPlaced = $wardsPlaced;

        return $this;
    }

    /**
     * Get wardsPlaced
     *
     * @return int
     */
    public function getWardsPlaced()
    {
        return $this->wardsPlaced;
    }

    /**
     * Set wardsKilled
     *
     * @param integer $wardsKilled
     *
     * @return SummonerOneGameStat
     */
    public function setWardsKilled($wardsKilled)
    {
        $this->wardsKilled = $wardsKilled;

        return $this;
    }

    /**
     * Get wardsKilled
     *
     * @return int
     */
    public function getWardsKilled()
    {
        return $this->wardsKilled;
    }

    /**
     * Set firstBloodKill
     *
     * @param boolean $firstBloodKill
     *
     * @return SummonerOneGameStat
     */
    public function setFirstBloodKill($firstBloodKill)
    {
        $this->firstBloodKill = $firstBloodKill;

        return $this;
    }

    /**
     * Get firstBloodKill
     *
     * @return bool
     */
    public function getFirstBloodKill()
    {
        return $this->firstBloodKill;
    }

    /**
     * Set firstBloodAssist
     *
     * @param boolean $firstBloodAssist
     *
     * @return SummonerOneGameStat
     */
    public function setFirstBloodAssist($firstBloodAssist)
    {
        $this->firstBloodAssist = $firstBloodAssist;

        return $this;
    }

    /**
     * Get firstBloodAssist
     *
     * @return bool
     */
    public function getFirstBloodAssist()
    {
        return $this->firstBloodAssist;
    }

    /**
     * Set firstTowerKill
     *
     * @param float $firstTowerKill
     *
     * @return SummonerOneGameStat
     */
    public function setFirstTowerKill($firstTowerKill)
    {
        $this->firstTowerKill = $firstTowerKill;

        return $this;
    }

    /**
     * Get firstTowerKill
     *
     * @return float
     */
    public function getFirstTowerKill()
    {
        return $this->firstTowerKill;
    }

    /**
     * Set firstTowerAssist
     *
     * @param boolean $firstTowerAssist
     *
     * @return SummonerOneGameStat
     */
    public function setFirstTowerAssist($firstTowerAssist)
    {
        $this->firstTowerAssist = $firstTowerAssist;

        return $this;
    }

    /**
     * Get firstTowerAssist
     *
     * @return bool
     */
    public function getFirstTowerAssist()
    {
        return $this->firstTowerAssist;
    }

    /**
     * Set firstInhibitorKill
     *
     * @param boolean $firstInhibitorKill
     *
     * @return SummonerOneGameStat
     */
    public function setFirstInhibitorKill($firstInhibitorKill)
    {
        $this->firstInhibitorKill = $firstInhibitorKill;

        return $this;
    }

    /**
     * Get firstInhibitorKill
     *
     * @return bool
     */
    public function getFirstInhibitorKill()
    {
        return $this->firstInhibitorKill;
    }

    /**
     * Set firstInhibitorAssist
     *
     * @param boolean $firstInhibitorAssist
     *
     * @return SummonerOneGameStat
     */
    public function setFirstInhibitorAssist($firstInhibitorAssist)
    {
        $this->firstInhibitorAssist = $firstInhibitorAssist;

        return $this;
    }

    /**
     * Get firstInhibitorAssist
     *
     * @return bool
     */
    public function getFirstInhibitorAssist()
    {
        return $this->firstInhibitorAssist;
    }

    /**
     * Set combatPlayerScore
     *
     * @param integer $combatPlayerScore
     *
     * @return SummonerOneGameStat
     */
    public function setCombatPlayerScore($combatPlayerScore)
    {
        $this->combatPlayerScore = $combatPlayerScore;

        return $this;
    }

    /**
     * Get combatPlayerScore
     *
     * @return int
     */
    public function getCombatPlayerScore()
    {
        return $this->combatPlayerScore;
    }

    /**
     * Set objectivePlayerScore
     *
     * @param string $objectivePlayerScore
     *
     * @return SummonerOneGameStat
     */
    public function setObjectivePlayerScore($objectivePlayerScore)
    {
        $this->objectivePlayerScore = $objectivePlayerScore;

        return $this;
    }

    /**
     * Get objectivePlayerScore
     *
     * @return string
     */
    public function getObjectivePlayerScore()
    {
        return $this->objectivePlayerScore;
    }

    /**
     * Set totalPlayerScore
     *
     * @param integer $totalPlayerScore
     *
     * @return SummonerOneGameStat
     */
    public function setTotalPlayerScore($totalPlayerScore)
    {
        $this->totalPlayerScore = $totalPlayerScore;

        return $this;
    }

    /**
     * Get totalPlayerScore
     *
     * @return int
     */
    public function getTotalPlayerScore()
    {
        return $this->totalPlayerScore;
    }

    /**
     * Set totalScoreRank
     *
     * @param integer $totalScoreRank
     *
     * @return SummonerOneGameStat
     */
    public function setTotalScoreRank($totalScoreRank)
    {
        $this->totalScoreRank = $totalScoreRank;

        return $this;
    }

    /**
     * Get totalScoreRank
     *
     * @return int
     */
    public function getTotalScoreRank()
    {
        return $this->totalScoreRank;
    }

    /**
     * Set creepsPerMinDeltas
     *
     * @param float $creepsPerMinDeltas
     *
     * @return SummonerOneGameStat
     */
    public function setCreepsPerMinDeltas($creepsPerMinDeltas)
    {
        try {
            $this->creepsPerMinDeltas = json_encode($creepsPerMinDeltas);
        } catch (Exception $e) {
            $this->creepsPerMinDeltas = '';
        }
        return $this;
    }

    /**
     * Get creepsPerMinDeltas
     *
     * @return float
     */
    public function getCreepsPerMinDeltas()
    {
        return json_decode($this->creepsPerMinDeltas, true);
    }

    /**
     * Set xpPerMinDeltas
     *
     * @param float $xpPerMinDeltas
     *
     * @return SummonerOneGameStat
     */
    public function setXpPerMinDeltas($xpPerMinDeltas)
    {
        try {
            $this->xpPerMinDeltas = json_encode($xpPerMinDeltas);
        } catch (Exception $e) {
            $this->xpPerMinDeltas = '';
        }
        return $this;
    }

    /**
     * Get xpPerMinDeltas
     *
     * @return float
     */
    public function getXpPerMinDeltas()
    {
        return json_decode($this->xpPerMinDeltas, true);
    }

    /**
     * Set goldPerMinDeltas
     *
     * @param float $goldPerMinDeltas
     *
     * @return SummonerOneGameStat
     */
    public function setGoldPerMinDeltas($goldPerMinDeltas)
    {
        try {
            $this->goldPerMinDeltas = json_encode($goldPerMinDeltas);
        } catch (Exception $e) {
            $this->goldPerMinDeltas = '';
        }
        return $this;
    }

    /**
     * Get goldPerMinDeltas
     *
     * @return float
     */
    public function getGoldPerMinDeltas()
    {
        return json_decode($this->goldPerMinDeltas, true);
    }

    /**
     * Set csDiffPerMinDeltas
     *
     * @param float $csDiffPerMinDeltas
     *
     * @return SummonerOneGameStat
     */
    public function setCsDiffPerMinDeltas($csDiffPerMinDeltas)
    {
        try {
            $this->csDiffPerMinDeltas = json_encode($csDiffPerMinDeltas);
        } catch (Exception $e) {
            $this->csDiffPerMinDeltas = '';
        }
        return $this;
    }

    /**
     * Get csDiffPerMinDeltas
     *
     * @return float
     */
    public function getCsDiffPerMinDeltas()
    {
        return json_decode($this->csDiffPerMinDeltas, true);
    }

    /**
     * Set xpDiffPerMinDeltas
     *
     * @param float $xpDiffPerMinDeltas
     *
     * @return SummonerOneGameStat
     */
    public function setXpDiffPerMinDeltas($xpDiffPerMinDeltas)
    {
        try {
            $this->xpDiffPerMinDeltas = json_encode($xpDiffPerMinDeltas);
        } catch (Exception $e) {

        }
        return $this;
    }

    /**
     * Get xpDiffPerMinDeltas
     *
     * @return float
     */
    public function getXpDiffPerMinDeltas()
    {
        return json_decode($this->xpDiffPerMinDeltas, true);
    }

    /**
     * Set damageTakenPerMinDeltas
     *
     * @param float $damageTakenPerMinDeltas
     *
     * @return SummonerOneGameStat
     */
    public function setDamageTakenPerMinDeltas($damageTakenPerMinDeltas)
    {
        try {
            $this->damageTakenPerMinDeltas = json_encode($damageTakenPerMinDeltas);
        } catch (Exception $e) {
            $this->damageTakenPerMinDeltas = '';
        }
        return $this;
    }

    /**
     * Get damageTakenPerMinDeltas
     *
     * @return float
     */
    public function getDamageTakenPerMinDeltas()
    {
        return json_decode($this->damageTakenPerMinDeltas, true);
    }

    /**
     * Set damageTakenDiffPerMinDeltas
     *
     * @param float $damageTakenDiffPerMinDeltas
     *
     * @return SummonerOneGameStat
     */
    public function setDamageTakenDiffPerMinDeltas($damageTakenDiffPerMinDeltas)
    {
        try {
            $this->damageTakenDiffPerMinDeltas = json_encode($damageTakenDiffPerMinDeltas);
        } catch (Exception $e) {
            $this->damageTakenDiffPerMinDeltas = '';
        }
        return $this;
    }

    /**
     * Get damageTakenDiffPerMinDeltas
     *
     * @return float
     */
    public function getDamageTakenDiffPerMinDeltas()
    {
        return json_decode($this->damageTakenDiffPerMinDeltas, true);
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return SummonerOneGameStat
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set lane
     *
     * @param string $lane
     *
     * @return SummonerOneGameStat
     */
    public function setLane($lane)
    {
        $this->lane = $lane;

        return $this;
    }

    /**
     * Get lane
     *
     * @return string
     */
    public function getLane()
    {
        return $this->lane;
    }

    /**
     * @param $data
     * @return $this
     */
    public function set($data)
    {
        $has = get_object_vars($this);
        foreach ($has as $name => $oldValue) {
            if (isset($data[$name]) && $name != 'id') {
                if (is_array($data[$name]))
                    $data[$name] = json_encode($data[$name]);
                $this->$name = $data[$name];
            }
        }
        return $this;
    }
}

