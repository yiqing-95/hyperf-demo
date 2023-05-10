<?php

namespace App\Model;

class User /* extends Model*/
{

    public function __construct()
    {

    }

    public function save()
    {
        return [
          'id'=> rand(1,100) ,

        ];
    }

}