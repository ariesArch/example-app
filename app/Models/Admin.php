<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\FilamentUser;

class Admin extends Authenticatable implements FilamentUser
{
    use HasFactory, HasApiTokens, SoftDeletes;
    protected $fillable = ['name', 'email', 'password', 'phone_no'];
    public function canAccessFilament(): bool
    {
        return str_ends_with($this->email, '@gmail.com');
    }
}
