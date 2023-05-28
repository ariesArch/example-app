<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Community extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'community_category_id', 'slug', 'image_url', 'image_uploaded_at'];
    public function community_category()
    {
        return $this->belongsTo(CommunityCategory::class);
    }
}
