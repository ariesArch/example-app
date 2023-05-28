<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommunityCategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'slug', 'image_url', 'image_uploaded_at'];
}
