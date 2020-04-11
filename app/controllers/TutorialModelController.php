<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Users;
use Phalcon\Db\Adapter\AdapterInterface;
use Phalcon\Mvc\Model\MetaData\Memory;
use Phalcon\Mvc\ModelInterface;
use Phalcon\Cache;

class TutorialModelController extends ControllerBase
{
    public function findAction(){

        /** @var User $find1 */
        $find1 = Users::findFirst(2);
        print_r($find1);
        exit();
        foreach ($a as $b){
            print_r($b->id);
        }
    }

    public function insertAction(){
        $user = new Users();
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

    public function find2Action() {
        $find2 = Users::find();
        
        // foreach
        echo nl2br("foreach:\n");
        foreach ($find2 as $find) {
            echo $find->name, PHP_EOL;
        }

        // while
        echo nl2br("\nwhile:\n");
        $find2->rewind();
        while ($find2->valid()) {
            $find = $find2->current();

            echo $find->name, PHP_EOL;

            $find2->next();
        }

        // count
        echo nl2br("\nCount:\n");
        echo count($find2);
        echo $find2->count();

        // seek
        echo nl2br("\nSeek(2):\n");
        $find2->seek(2);
        $find = $find2->current();
        echo $find->name, PHP_EOL;

        // array
        echo nl2br("\nArray[2]:\n");
        $find = $find2[2];
        echo $find->name, PHP_EOL;

        // array - isset
        echo nl2br("\nArray[2] - isset:\n");
        if (true === isset($find2[2])) {
        $find = $find2[2];
        echo $find->name, PHP_EOL;
        }

        // First
        echo nl2br("\nFirst:\n");
        $find = $find2->getFirst();
        echo $find->name, PHP_EOL;

        // Last
        echo nl2br("\nLast:\n");
        $find = $find2->getLast();
        echo $find->name, PHP_EOL;
    }

    // public function putCacheAction() {
    //     $find3 = Users::find();

    //     file_put_contents(
    //         'invoices.cache',
    //         serialize($find3)
    //     );

    //     $find3 = unserialize(
    //         file_get_contents('invoices.cache')
    //     );

    //     foreach ($find3 as $find) {
    //         echo $find->name,' ', $find->email,' ';
    //         }
    // }

    public function concatAction() {
        $find3 = Users::find();
        $find = $find3->getFirst(); 
        $concatResult = $find3->concat($find->name,$find->email);
        echo $concatResult;
    }

    public function filterAction() {
        
        $find4 = Users::find();

        $find4 = $find4->filter(
            function ($find) {
                // echo $find->email;
                if (substr_compare($find->email, ".com", -4, 4) == 0) {
                    // echo "yes";
                    return $find;
                }
                else print_r($find->jsonSerialize()); 
                
            }
        );
    }
}

