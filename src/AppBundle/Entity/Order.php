<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrderRepository")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * 
     * 
     */
    private $bonusCard;

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
     * Set bonusCard
     *
     * @param \AppBundle\Entity\BonusCard $bonusCard
     * @return Order
     */
    public function setBonusCard(\AppBundle\Entity\BonusCard $bonusCard = null)
    {
        $this->bonusCard = $bonusCard;

        return $this;
    }

    /**
     * Get bonusCard
     *
     * @return \AppBundle\Entity\BonusCard 
     */
    public function getBonusCard()
    {
        return $this->bonusCard;
    }
}
