<?php

namespace App\Models;

use Phalcon\Mvc\Model;

class UserDuplikat extends Model
{
    public $user_id;
    public $user_name;
    public $user_email;

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

    public function columnMap(){
        return [
            'id' => 'user_id',
            'name' => 'user_name',
            'email' => 'user_email'
        ];
    }

    public function toString(){
        return
            "ID : " . $this->user_id . ", " .
            "Nama : " . $this->user_name . ", " .
            "Email : " . $this->user_email . ", ";
    }
}