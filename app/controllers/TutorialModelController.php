<?php
declare(strict_types=1);

namespace App\Controllers;

// use App\Models\Users;
use Phalcon\Db\Adapter\AdapterInterface;
use Phalcon\Mvc\Model\MetaData\Memory;
use Phalcon\Mvc\ModelInterface;
use Phalcon\Cache;
use App\Models\User;
use App\Models\UserDuplikat;
use Phalcon\Db\Column;
use Phalcon\Mvc\Model\Transaction\Failed;
use Phalcon\Mvc\Model\Transaction\Manager;

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

        echo "<br><br>";


        /**
         * cari semua data dengan name = coba dan email = email
         */
        $find_query = User::query()
            ->where('name = :name:')
            ->andWhere('email = :email:')
            ->bind([
                'name' => 'coba',
                'email' => 'email@email.com'
            ])
            ->orderBy('name desc, id desc')
            ->execute();

        foreach ($find_query as $data){
            echo $data->toString() . "<br>";
        }

    }

    public function insertAction(){
        $user = new User();
        $user->name = $_GET['name'];
        $user->email = $_GET['email'];

        $success = $user->save();

        if (!$success){
            echo "unable to create new user";
            print_r($user->getMessages());
        }
        else {
            echo "success creating new user<br>" . $user->toString();
        }
    }

    public function insert2Action(){
        $user = new User();
        $user->assign(
            $_GET,
            [
                'name',
                'email'
            ]
        );

        $success = $user->save();

        if (!$success){
            echo "unable to create new user";
            print_r($user->getMessages());
        }
        else {
            echo "success creating new user<br>" . $user->toString();
        }
    }

    public function insert3Action(){
        $user = new User($_GET);

        $success = $user->save();

        if (!$success){
            echo "unable to create new user";
            print_r($user->getMessages());
        }
        else {
            echo "success creating new user<br>" . $user->toString();
        }
    }

    public function updateAction($id = null){
        $user = User::findFirst($id);

        if ($id == null || $user == null)
            return 'user not found';

        $user->assign(
            $_GET,
            [
                'name',
                'email'
            ]
        );

        $success = $user->update();

        if (!$success){
            echo "unable to save change(s)";
            print_r($user->getMessages());
        }
        else {
            echo "success saving change(s)<br>" . $user->toString();
        }
    }

    public function mappingAction(){
        /** @var UserDuplikat $user_copy */
        $user_copy = UserDuplikat::findFirst();

        $user_copy->user_name = 'yuuda';

        $user_copy->save();

        echo $user_copy->toString();
    }

    public function transactionAction(){
        try {
            $txManager = new Manager();
            $transaction = $txManager->get();

            $u1 = new User();
            $u1->setTransaction($transaction);
            $u1->assign(['nama' => 'yuda', 'email' => 'emailku@email.com']);
            if (!$u1->save())
                $transaction->rollback();

            /**
             * Pada bagian ini, user tidak diberikan inputan nama maupun email
             * sehingga proses penyimpanan seharusnya gagal
             */
            $u2 = new User();
            $u2->setTransaction($transaction);
            if (!$u2->save())
                $transaction->rollback();

            $transaction->commit();
        } catch (Failed $e){
            echo $e->getMessage();
        }
    }

    public function find2Action() {
        $find2 = User::find();
        
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
        $find3 = User::find();
        $find = $find3->getFirst(); 
        $concatResult = $find3->concat($find->name,$find->email);
        echo $concatResult;
    }

    public function filterAction() {
        
        $find4 = User::find();

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

    public function calculationAction() {
        $find5 = User::maximum(
            [
                'column' => 'id',
            ]
        );

        echo $find5;
    }

    public function deleteAction() {
        $find6 = User::findFirst(
            [
                'conditions' => 'id = :id:',
                'bind'       => [
                    'id' => 8,
                ]
            ]
        );

        if (false !== $find6) {
            if (false === $find6->delete()) {
                $messages = $find6->getMessages();
            
                foreach ($messages as $message) {
                    echo $message . PHP_EOL;
                }
            } else {
        
                echo 'Record Deleted';
            }
        }
        
    }

    
}

