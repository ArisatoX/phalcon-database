<?php

namespace App\Model;

use Phalcon\Mvc\Model;

class User extends Model
{
    public $id;
    public string $name;
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
}