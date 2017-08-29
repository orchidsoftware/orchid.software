<?php

namespace App;

use Orchid\Platform\Core\Models\User as UserOrchid;

class User extends UserOrchid
{

    /**
     * @return string
     */
    public function getAvatar(){
        return '';
    }
}
