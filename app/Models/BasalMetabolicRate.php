<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasalMetabolicRate extends Model
{
    protected $fillable = [
        'user_id',
        'user_name',
        'gender',
        'age',
        'weight',
        'stature',
        'activity_rate_factor',
        'objective',
        'type_of_diet',
        'imc',
        'water',
        'basal_metabolic_rate',
        'daily_calories',
        'daily_protein',
        'daily_carbohydrate',
        'daily_fat',
        'daily_protein_kcal',
        'daily_carbohydrate_kcal',
        'daily_fat_kcal'
    ];
}

