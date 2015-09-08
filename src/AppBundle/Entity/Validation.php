<?php

namespace AppBundle\Entity;


class Validation {

    private $messages = array();

    public function add($field, $message) {
        $this->messages[$field] = $message;
    }

    public function has($field) {
        return array_key_exists($field, $this->messages);
    }

    public function getMessage($field) {
        if($this->has($field)) {
            return $this->messages[$field];
        }

        return null;
    }

    public function isValid() {
        return count($this->messages) == 0;
    }

    public function getMessages() {
        return array_values($this->messages);
    }

} 