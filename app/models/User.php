<?php

namespace App\Models;

use Phalcon\Mvc\Model;
use App\Models\Resultset\custom;

class User extends Model
{
    public $id;
    public $name;
    public $email;

    /**
     *  Dipanggil sekali untuk digunakan seluruh instance
     */
    public function initialize(){
        // Untuk mengeset database service yang digunakan untuk read data, default: 'db'
        // database service harus diregister di container dependecy injector
        $this->setReadConnectionService('db');

        // Untuk mengeset database service yang digunakan untuk write data, default : 'db'
        $this->setWriteConnectionService('db');

        // Untuk mengeset schema, default : empty string
        $this->setSchema('dbo');

        // Untuk mengeset nama tabel, default : nama class
        $this->setSource('users');
    }

    /**
     *  Dipanggil setiap pembuatan instace class baru
     */
    public function onConstruct(){

    }

    public function toString(){
        return
            "ID : " . $this->id . ", " .
            "Nama : " . $this->name . ", " .
            "Email : " . $this->email . "";
    }

    public function getResultsetClass()
    {
        return custom::class;
    }

    // public function beforeSave()
    // {
    //     $this->email = join(',', $this->email);
    // }

    // public function afterFetch()
    // {
    //     $this->email = explode(',', $this->email);
    // }
    
    // public function afterSave()
    // {
    //     $this->email = explode(',', $this->email);
    // }
}