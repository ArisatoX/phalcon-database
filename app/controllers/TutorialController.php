<?php
declare(strict_types=1);

namespace App\Controller;

use Phalcon\Db\Adapter\AdapterInterface;

class TutorialController extends ControllerBase
{

    protected AdapterInterface $connection;

    public function initialize(){
        $this->connection = $this->getDI()->get('db');
    }

    public function selectAction()
    {
        $query = "SELECT name, database_id, create_date FROM sys.databases where name = :nama;";
        $success = $this->connection->query(
            $query,
            [
                "pbkk"
            ]
        );
        print_r($success->getInternalResult()->rowCount());
    }

}

