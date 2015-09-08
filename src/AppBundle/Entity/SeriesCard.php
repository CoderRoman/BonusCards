<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SeriesCardRepository")
 * @ORM\Table(name="series_cards")
 */
class SeriesCard
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * 
     */
    private $series;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $started;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $finished;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $number;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $months;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\BonusCard", mappedBy="seriesCard", cascade={"persist"})
     */
    private $bonusCard;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->started=new \DateTime();
        $this->finished=new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set series
     *
     * @param integer $series
     * @return SeriesCard
     */
    public function setSeries($series)
    {
        $this->series = $series;

        return $this;
    }

    /**
     * Get series
     *
     * @return integer 
     */
    public function getSeries()
    {
        return $this->series;
    }

    /**
     * Set started
     *
     * @param \DateTime $started
     * @return SeriesCard
     */
    public function setStarted($started)
    {
        $this->started = $started;

        return $this;
    }

    /**
     * Get started
     *
     * @return \DateTime 
     */
    public function getStarted()
    {
        return $this->started;
    }

    /**
     * Set finished
     *
     * @param \DateTime $finished
     * @return SeriesCard
     */
    public function setFinished($finished)
    {
        $this->finished = $finished;

        return $this;
    }

    /**
     * Get finished
     *
     * @return \DateTime 
     */
    public function getFinished()
    {
        return $this->finished;
    }


    /**
     * Set number
     *
     * @param integer $number
     * @return SeriesCard
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Add bonusCard
     *
     * @param \AppBundle\Entity\BonusCard $bonusCard
     * @return SeriesCard
     */
    public function addBonusCard(\AppBundle\Entity\BonusCard $bonusCard)
    {
        $this->bonusCard[] = $bonusCard;

        return $this;
    }

    /**
     * Remove bonusCard
     *
     * @param \AppBundle\Entity\BonusCard $bonusCard
     */
    public function removeBonusCard(\AppBundle\Entity\BonusCard $bonusCard)
    {
        $this->bonusCard->removeElement($bonusCard);
    }

    /**
     * Get bonusCard
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBonusCard()
    {
        return $this->bonusCard;
    }

    /**
     * Set months
     *
     * @param integer $months
     * @return SeriesCard
     */
    public function setMonths($months)
    {
        $this->months = $months;
        $this->finished->modify('+'.$months.' month');
        return $this;
    }

    /**
     * Get months
     *
     * @return integer 
     */
    public function getMonths()
    {
        return $this->months;
    }
}
