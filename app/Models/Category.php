<?php
namespace App\Models;



class Category extends Model
{
     protected $fillable = ['name'];

    public function recipes() {
        return $this->hasMany(Recipe::class);
}}
