<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;
use Phalcon\Db\Column;

class TutorialModelController extends ControllerBase
{
    public function findAction(){
        /**
         * find all data
         */
        $find_all = User::find();
        foreach ($find_all as $data){
            echo $data->toString() . "<br>";
        }

        echo "<br><br>";

        /**
         * findFirst, cari semua data dimana primary key (id) = 8
         */
        $find_first = User::findFirst(8);
        echo $find_first->toString();

        echo "<br><br>";

        /**
         * findBy*, cari semua data dimana name = coba
         */
        $find_by_name = User::findByName('coba');
        foreach ($find_by_name as $data){
            echo $data->toString() . "<br>";
        }

        echo "<br><br>";

        /**
         * cari semua data dengan name = coba dan email = email
         */
        $find_with_param = User::find([
            'conditions' => 'name = :name: and email = ?1',
            'bind' => [
                1 => 'email@email.com',
                'name' => 'coba',
            ],
            'bindTypes' => [
                'name' => Column::BIND_PARAM_STR,
                1 => Column::BIND_PARAM_STR,
            ],
            'limit' => 4,
            'order' => 'name desc, id desc'
        ]);
        echo json_encode($find_with_param->jsonSerialize());
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

