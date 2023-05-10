<?php

namespace App\Service\v2;

class UserService
{

    /**
     * @param int $id
     * @return array
     */
    public function getInfoById(int $id)
    {
        return [
          'id' => $id,
          'name'=> 'yiqing',
            'gender'=> 1,
        ];
    }
}