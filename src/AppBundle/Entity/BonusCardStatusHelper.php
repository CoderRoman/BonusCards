<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 07.09.15
 * Time: 20:31
 */

namespace AppBundle\Entity;


class BonusCardStatusHelper
{
    const STATUS_OPEN = 0;
    const STATUS_CLOSED = 1;
    const STATUS_EXPIRED = 2;

    private static $self = null;
    private $status = null;

    private function __construct() {
        $this->status = array(
            self::STATUS_OPEN => "Активирована",
            self::STATUS_CLOSED => "Не активирована",
            self::STATUS_EXPIRED => "Просрочена",

        );
    }

    public function getStatus($id) {
        if(!array_key_exists($id, $this->status)) {
            throw new \Exception('Invalid status ID');
        }
        return $this->status[$id];
    }

    public static function instance() {
        if(!self::$self) {
            self::$self = new BonusCardStatusHelper();
        }

        return self::$self;

    }

}