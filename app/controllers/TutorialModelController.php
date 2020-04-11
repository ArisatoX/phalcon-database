<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\User;
use Phalcon\Db\Adapter\AdapterInterface;
use Phalcon\Mvc\Model\MetaData\Memory;

class TutorialModelController extends ControllerBase
{
    public function findAction(){
        $find1 = User::findFirst(8);
        print_r($find1);
        exit();
        foreach ($a as $b){
            print_r($b->id);
        }
    }

    public function insertAction(){
        $user = new User();
        $user->name = "coba";
        $user->email = "email";

        $success = $user->save();

        if (!$success){
            echo "unable to create new user";
            print_r($user->getMessages());
        }
        else {
            echo "masuk";
        }
    }
}

