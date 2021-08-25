<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model;


class User extends Model
{
    use  Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $connection = 'mongodb';
    protected $primaryKey = '_id';
//    protected $keyType = 'string';

    protected $collection = 'user';
    protected $guarded = [];

    public function information()
    {
        return $this->hasOne(UserInformation::class , 'userId' , 'userId');
    }

    public function coin()
    {
        return $this->hasOne(Coin::class , 'userId' , 'userId');
    }

    public function orders()
    {
        return $this->hasMany(Order::class , 'userId' , 'userId');
    }


}
