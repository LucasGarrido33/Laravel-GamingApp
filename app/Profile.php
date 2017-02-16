<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    /**
     * Fillable fields for a Profile
     *
     * @var array
     */
    protected $fillable = [
        'location', 'bio','gender',
        'twitter_username', 'github_username'
    ];

    /**
     * A profile belongs to a user
     *
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'foreign_key');
    }


    public function location(){
        return $this->belongsTo('\Moharrum\LaravelGeoIPWorldCities\City', 'city_id');
    }

    public function getAvatarUrlAttribute()
    {
        return asset("avatars/{$this->avatar}");
    }

}
