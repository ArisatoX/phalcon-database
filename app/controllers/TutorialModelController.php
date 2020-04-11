<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Model\User;
use Phalcon\Db\Adapter\AdapterInterface;
use Phalcon\Mvc\Model\MetaData\Memory;
use Phalcon\Mvc\ModelInterface;

class TutorialModelController extends ControllerBase
{
    public function findAction(){

        /** @var User $find1 */
        $find1 = User::findFirst(8);
        print_r($find1->wow());
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

