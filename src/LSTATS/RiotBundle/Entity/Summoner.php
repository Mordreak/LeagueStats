<?php

namespace LSTATS\RiotBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\Mapping\ClassMetadata;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectManagerAware;
use Doctrine\ORM\Mapping as ORM;

/**
 * Summoner
 *
 * @ORM\Table(name="lstats_summoner")
 * @ORM\Entity(repositoryClass="LSTATS\RiotBundle\Repository\SummonerRepository")
 */
class Summoner implements ObjectManagerAware
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
     * @var int
     *
     * @ORM\Column(name="profileIconId", type="integer", nullable=true)
     */
    private $profileIconId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="level", type="integer")
     */
    private $level;

    /**
     * @var string
     *
     * @ORM\Column(name="ranks", type="text")
     */
    private $ranks;

    /**
     * @var int
     *
     * @ORM\Column(name="accountId", type="integer", unique=true)
     */
    private $accountId;

    /**
     * @var \DateTime
     *
     * @Orm\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;

    private $_em;

    public function __construct()
    {
        $this->ranks = '';
        $this->championsMastered = '';
        $this->updatedAt = new \DateTime();
    }

    public function injectObjectManager(ObjectManager $objectManager, ClassMetadata $classMetadata)
    {
        $this->_em = $objectManager;
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
     * Set summonerId
     *
     * @param integer $summonerId
     *
     * @return Summoner
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
     * Set profileIconId
     *
     * @param integer $profileIconId
     *
     * @return Summoner
     */
    public function setProfileIconId($profileIconId)
    {
        $this->profileIconId = $profileIconId;

        return $this;
    }

    /**
     * Get profileIconId
     *
     * @return int
     */
    public function getProfileIconId()
    {
        return $this->profileIconId;
    }

    public function getProfileIcon()
    {
        $version = $this->_em->getRepository('LSTATSConfigBundle:Entry')
            ->findOneBy(array('code' => 'euw1-version'));
        return 'https://ddragon.leagueoflegends.com/cdn/'. $version->getValue() .'/img/profileicon/'. $this->getProfileIconId() .'.png';
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Summoner
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set level
     *
     * @param integer $level
     *
     * @return Summoner
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
     * @return string
     */
    public function getRanks()
    {
        try {
            return json_decode($this->ranks, true);
        } catch (\Exception $e) {
            return array();
        }
    }

    /**
     * @param string $ranks
     */
    public function setRanks($ranks)
    {
        try {
            $this->ranks = json_encode($ranks);
        } catch (\Exception $e) {
            $this->ranks = '';
        }
    }

    /**
     * @return int
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @param int $accountId
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
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
}

