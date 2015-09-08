<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 07.09.15
 * Time: 20:21
 */

namespace AppBundle\EntityService;


use AppBundle\Entity\BonusCard;
use AppBundle\Entity\SeriesCard;
use AppBundle\Repository\BonusCardRepository;
use AppBundle\Repository\SeriesCardRepository;

class BonusCardService extends  EntityServiceBase
{

    public function generateCard(array $params){

        $s=$this->getSeriesCardRepository()->find(6);

        $em = $this->getDoctrine()->getManager();


        for ($i=0;$i<100000;$i++) {

          $card= new BonusCard();
          $card->setNumber(4);
          $card->setAmount(50);
          $card->setSeriesCard($s);
          $em->persist($card);

          if (($i % 50) === 0) {
            $em->flush();
            $em->clear();
              $s=$this->getSeriesCardRepository()->find(6);

          }


        }
        $em->flush();
    }


    /**
     * @return int
     */
    protected function createSeries(){
        $series=new SeriesCard();
        $series->setStarted(new \DateTime());
        $series->setFinished(new \DateTime());
        $series->setNumber(0);
        $this->saveObject($series);
        return $series->getId();
    }

    /**
     * @return BonusCardRepository
     */
    protected function getRepository() {
        return $this->getDoctrine()->getRepository('AppBundle:BonusCard');
    }

    /**
     * @return SeriesCardRepository
     */
    protected function getSeriesCardRepository() {
        return $this->getDoctrine()->getRepository('AppBundle:SeriesCard');
    }
}