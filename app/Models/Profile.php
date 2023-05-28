<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;
use App\Models\Township;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['profiable_type', 'profilable_id', 'phone_no', 'city_id', 'township_id', 'address', 'cover_photo', 'profile_picture', 'bio', 'socials'];
    protected $casts = [
        'address' => 'json',
        'cover_photo' => 'json',
        'profile_picture' => 'json',
        'socials' => 'json',
    ];
    public function profilable()
    {
        return $this->morphTo();
    }
    // public function city()
    // {
    //     return $this->belongsTo(City::class);
    // }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function township()
    {
        return $this->belongsTo(Township::class);
    }
}
