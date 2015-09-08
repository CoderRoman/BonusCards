<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;
use AppBundle\Entity\BonusCardStatusHelper;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BonusCardRepository")
 * @ORM\Table(name="bonus_cards", indexes={@ORM\Index(name="bonus_card_number_idx", columns={"number"})})
 */
class BonusCard
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $number;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $amount;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $deleted;

    /**
     *
     @ORM\OneToMany(targetEntity="AppBundle\Entity\Order", mappedBy="bonusCard")*/
    private $order;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SeriesCard", inversedBy="bonusCard", cascade={"persist"})
     * @ORM\JoinColumn(name="series_card_id", referencedColumnName="id")
     */
    private $seriesCard;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->order = new \Doctrine\Common\Collections\ArrayCollection();
        $this->status=BonusCardStatusHelper::STATUS_OPEN;
        $this->deleted=false;
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
     * Set number
     *
     * @param integer $number
     * @return BonusCard
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
     * Set status
     *
     * @param integer $status
     * @return BonusCard
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     * @return BonusCard
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Add order
     *
     * @param \AppBundle\Entity\Order $order
     * @return BonusCard
     */
    public function addOrder(\AppBundle\Entity\Order $order)
    {
        $this->order[] = $order;

        return $this;
    }

    /**
     * Remove order
     *
     * @param \AppBundle\Entity\Order $order
     */
    public function removeOrder(\AppBundle\Entity\Order $order)
    {
        $this->order->removeElement($order);
    }

    /**
     * Get order
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set seriesCard
     *
     * @param \AppBundle\Entity\SeriesCard $seriesCard
     * @return BonusCard
     */
    public function setSeriesCard(\AppBundle\Entity\SeriesCard $seriesCard = null)
    {
        $this->seriesCard = $seriesCard;

        return $this;
    }

    /**
     * Get seriesCard
     *
     * @return \AppBundle\Entity\SeriesCard 
     */
    public function getSeriesCard()
    {
        return $this->seriesCard;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     * @return BonusCard
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean 
     */
    public function getDeleted()
    {
        return $this->deleted;
    }


}
