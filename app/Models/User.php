<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // ⬅️ Assurez-vous d'avoir cet import !
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; 

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_admin'
    ];

    protected $hidden = [
        'password',
    ];

    public function recipes() {
        return $this->hasMany(Recipe::class);
    }

    public function favorites() {
        return $this->hasMany(Favorite::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function ratings() {
        return $this->hasMany(Rating::class);
    }

    public function mealPlans() {
        return $this->hasMany(MealPlan::class);
    }
    public function isAdmin(): bool
{
    // Supposons que vous avez une colonne 'role' ou 'is_admin' dans votre table users
    return $this->role === 'admin'; 
}
}
