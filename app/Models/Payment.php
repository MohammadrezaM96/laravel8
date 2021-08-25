<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;


    protected $collection = 'payment';


    public function user()
    {
        return $this->belongsTo(User::class , 'userId' , 'userId');
    }

    public function item()
    {
        return $this->belongsTo(Market::class , 'itemId' , 'bazaar_id');
    }


}
