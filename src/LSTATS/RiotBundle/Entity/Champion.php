<?php

namespace LSTATS\RiotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use LSTATS\RiotBundle\Services\ChampionsService;

/**
 * Champion
 *
 * @ORM\Table(name="lstats_champion")
 * @ORM\Entity(repositoryClass="LSTATS\RiotBundle\Repository\ChampionRepository")
 */
class Champion
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
     * @ORM\Column(name="championId", type="integer", unique=true)
     */
    private $championId;

    /**
     * @var string
     *
     * @ORM\Column(name="infos", type="text")
     */
    private $infos;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="images", type="text")
     */
    private $images;

    /**
     * @var string
     *
     * @ORM\Column(name="championKey", type="string", length=255, unique=true)
     */
    private $key;

    /**
     * @var string
     *
     * @ORM\Column(name="allytips", type="text")
     */
    private $allytips;

    /**
     * @var string
     *
     * @ORM\Column(name="enemytips", type="text")
     */
    private $enemytips;


    /**
     * @var string
     *
     * @ORM\Column(name="blurb", type="text")
     */
    private $blurb;

    /**
     * @var string
     *
     * @ORM\Column(name="lore", type="text")
     */
    private $lore;

    /**
     * @var string
     *
     * @ORM\Column(name="passive", type="text")
     */
    private $passive;

    /**
     * @var string
     *
     * @ORM\Column(name="recommended", type="text")
     */
    private $recommended;

    /**
     * @var string
     *
     * @ORM\Column(name="skins", type="text")
     */
    private $skins;

    /**
     * @var string
     *
     * @ORM\Column(name="spells", type="text")
     */
    private $spells;

    /**
     * @var string
     *
     * @ORM\Column(name="stats", type="text")
     */
    private $stats;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;

    public function __construct()
    {
        $this->updatedAt = new \DateTime();
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
     * Set championId
     *
     * @param integer $championId
     *
     * @return Champion
     */
    public function setChampionId($championId)
    {
        $this->championId = $championId;

        return $this;
    }

    /**
     * Get championId
     *
     * @return int
     */
    public function getChampionId()
    {
        return $this->championId;
    }

    /**
     * @return array
     */
    public function getInfos()
    {
        try {
            return json_decode($this->infos, true);
        } catch (\Exception $e) {
            return array();
        }
    }

    /**
     * @param array $infos
     */
    public function setInfos($infos, $encode = true)
    {
        try {
            if ($encode)
                $this->infos = json_encode($infos);
            else
                $this->infos = $infos;
        } catch (\Exception $e) {
            $this->infos = '';
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return array
     */
    public function getImages()
    {
        try {
            return json_decode($this->images, true);
        } catch (\Exception $e) {
            return array();
        }
    }

    /**
     * @param array $images
     */
    public function setImages($images)
    {
        try {
            $this->images = json_encode($images);
        } catch (\Exception $e) {
            $this->images = '';
        }
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getAllytips()
    {
        return json_decode($this->allytips, true);
    }

    /**
     * @param string $allytips
     */
    public function setAllytips($allytips)
    {
        try {
            $this->allytips = json_encode($allytips);
        } catch (\Exception $e) {
            $this->allytips = '';
        }
    }

    /**
     * @return string
     */
    public function getEnemytips()
    {
        return json_decode($this->enemytips, true);
    }

    /**
     * @param string $enemytips
     */
    public function setEnemytips($enemytips)
    {
        try {
            $this->enemytips = json_encode($enemytips);
        } catch (\Exception $e) {
            $this->enemytips = '';
        }
    }

    /**
     * @return string
     */
    public function getBlurb()
    {
        return $this->blurb;
    }

    /**
     * @param string $blurb
     */
    public function setBlurb($blurb)
    {
        $this->blurb = $blurb;
    }

    /**
     * @return string
     */
    public function getLore()
    {
        return $this->lore;
    }

    /**
     * @param string $lore
     */
    public function setLore($lore)
    {
        $this->lore = $lore;
    }

    /**
     * @return string
     */
    public function getPassive()
    {
        return json_decode($this->passive, true);
    }

    /**
     * @param string $passive
     */
    public function setPassive($passive)
    {
        try {
            $this->passive = json_encode($passive);
        } catch (\Exception $e) {
            $this->passive = '';
        }
    }

    /**
     * @return string
     */
    public function getRecommended()
    {
        return json_decode($this->recommended, true);
    }

    /**
     * @param string $recommended
     */
    public function setRecommended($recommended)
    {
        try {
            $this->recommended = json_encode($recommended);
        } catch (\Exception $e) {
            $this->recommended = '';
        }
    }

    /**
     * @return string
     */
    public function getSkins()
    {
        return json_decode($this->skins, true);
    }

    /**
     * @param string $skins
     */
    public function setSkins($skins)
    {
        try {
            $this->skins = json_encode($skins);
        } catch (\Exception $e) {
            $this->skins = '';
        }
    }

    /**
     * @return string
     */
    public function getSpells()
    {
        return json_decode($this->spells, true);
    }

    /**
     * @param string $spells
     */
    public function setSpells($spells)
    {
        try {
            $this->spells = json_encode($spells);
        } catch (\Exception $e) {
            $this->spells = '';
        }
    }

    /**
     * @return string
     */
    public function getStats()
    {
        $stats = json_decode($this->stats, true);
        unset($stats['crit']);
        unset($stats['critperlevel']);
        $result = array();
        foreach ($stats as $key => $stat) {
            if (strpos($key, 'perlevel') !== false) {
                $baseKey = substr($key, 0, -8);
                if (!isset($stats[$baseKey]))
                    $baseKey .= 'offset';
                $result[ChampionsService::STATS_CODE_TO_LABEL[$baseKey]] = $stats[$baseKey] . ' (+' . $stat . ')';
            }
        }
        return $result;
    }

    /**
     * @param string $stats
     */
    public function setStats($stats)
    {
        try {
            $this->stats = json_encode($stats);
        } catch (\Exception $e) {
            $this->stats = '';
        }
    }

    public function getSquareImage()
    {
        $images = $this->getImages();
        return 'https://ddragon.leagueoflegends.com/cdn/7.18.1/img/champion/'. $images['full'];
    }

    public function getSplashArt()
    {
        return 'https://ddragon.leagueoflegends.com/cdn/img/champion/splash/'. $this->getKey() .'_0.jpg';
    }

    public function getLoadingArt()
    {
        return 'https://ddragon.leagueoflegends.com/cdn/img/champion/loading/'. $this->getKey() .'_0.jpg';
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function toArray()
    {
        return array(
            'championId' => $this->getChampionId(),
            'infos' => $this->getInfos(),
            'name' => $this->getName(),
            'images' => $this->getImages(),
            'championKey' => $this->getKey(),
            'squareImage' => $this->getSquareImage(),
            'splashArt' => $this->getSplashArt(),
            'enemytips' => $this->getEnemytips(),
            'stats' => $this->getStats(),
            'title' => $this->getTitle(),
            'skins' => $this->getSkins(),
            'passive' => $this->getPassive(),
            'recommended' => $this->getRecommended(),
            'allytips' => $this->getAllytips(),
            'lore' => $this->getLore(),
            'blurb' => $this->getBlurb(),
            'spells' => $this->getSpells()
        );
    }

    public function __toString()
    {
        return $this->getName();
    }
}

