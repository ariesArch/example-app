<?php

namespace App\Models;

use App\Models\Profile as ModelsProfile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Page extends Authenticatable
{
    use HasFactory, SoftDeletes, HasApiTokens;
    protected $fillable = ['community_category_id', 'community_id', 'name', 'slug'];
    public function community_category()
    {
        return $this->belongsTo(CommunityCategory::class);
    }
    public function community()
    {
        return $this->belongsTo(Community::class);
    }
    public function profile()
    {
        return $this->morphOne(ModelsProfile::class, 'profilable');
    }
    public function society()
    {
        return $this->morphMany(Society::class, 'sociable');
    }
    public function teaching_classes()
    {
        return $this->hasMany(TeachingClass::class);
    }
}
