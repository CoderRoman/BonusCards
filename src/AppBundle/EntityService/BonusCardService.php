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
use AppBundle\Entity\Validation;

class BonusCardService extends  EntityServiceBase
{

    public function getCardsListQuery($params=null) {

        return $this->getRepository()->getCardsListQuery($params);
    }

    public function generateCard(array $params){
        $seriesId=$this->createSeries($params);
        $series=$this->getSeriesCardRepository()->find($seriesId);
        $em = $this->getDoctrine()->getManager();
        for ($i=0;$i<$params['total'];$i++) {
          $card= new BonusCard();
          $card->setNumber($i);
          $card->setAmount(isset($params['amount'])?(int)$params['amount']:0);
          $card->setSeriesCard($series);
          $em->persist($card);
          if (($i % 50) === 0) {
            $em->flush();
            $em->clear();
              $series=$this->getSeriesCardRepository()->find($seriesId);
          }
        }
        $em->flush();
    }
    public function validate($form){
        $val = new Validation();

        //VALIDATE

        return $val;
    }

    /**
     * @param array $params
     * @return int
     */
    protected function createSeries(array $params){
        $series=new SeriesCard();
        $series->setNumber($params['number']);
        $series->setMonths($params['months']);
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