<?php

namespace App\Database\Models;

use App\Database\ActiveRecord\ActiveRecord;

class User extends ActiveRecord
{
    protected ?string $table = "users";
}