<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{
    protected $fillable = ['user_id', 'recipe_id', 'day', 'title', 'meal_type'];


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class, 'recipe_id');
    }

    // Relation avec User (optionnel)
    
}
