<?php
declare(strict_types=1);

namespace App\Controller;

use Phalcon\Db\Adapter\AdapterInterface;

class TutorialRawController extends ControllerBase
{

    protected AdapterInterface $connection;

    public function initialize(){
        $this->connection = $this->getDI()->get('db');
    }

    public function indexAction()
    {
        $query = "
            SELECT name, database_id, create_date FROM sys.databases 
            where name = :name and create_date < :date;
        ";
        $date_string = (new \DateTime('now'))->format('Y-m-d H:i:s');
        $data = $this->db->query(
            $query,
            [
                'date' => $date_string,
                'name' => "pbkk",
            ]
        );
        print_r($data->fetchAll());
    }

    public function createDatabaseAction(){
        $res = $this->db->execute("
            CREATE TABLE users ( 
                id BIGINT not NULL IDENTITY(1,1) PRIMARY KEY,
                name VARCHAR(200) not NULL,
                email VARCHAR(200),
            );
        ");
        print_r($res);
    }

    public function insertAction($name=null, $email=null){
        if ($name == null)
            return 'name should be filled';

        $res = $this->db->execute("
            INSERT INTO users (name, email) 
            values (:name, :email);
        ", [
            'name' => $name,
            'email' => $email,
        ]);

        print_r($res);
    }

    public function transactionAction(){
        try {
            $this->db->begin();

            $this->db->execute('DELETE FROM users WHERE id = 8');
            $this->db->execute('DELETE FROM users WHERE id = 2');
            $this->db->execute('DELETE FROM users WHERE id = 3');

            $this->db->commit();
            echo 'done';
        } catch (\Exception $e){
            $this->db->rollback();
            echo $e->getMessage();
        }
    }

}

