<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class UserInformation extends Model
{
    use HasFactory;

    protected $collection = 'user_information';


}
