<?php

namespace App\Models\Resultset;

use \Phalcon\Mvc\Model\Resultset\Simple;

class Custom extends Simple
{
    public function concat($name, $email) {
        $result = $name.'->'.$email;
        echo $result;
    }
}