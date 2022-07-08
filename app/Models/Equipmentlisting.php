<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipmentlisting extends Model
{
    use HasFactory;
    protected $primaryKey = 'equipmentID'; //Specifies the primary key to the model, otherwise by defualt
                                            //the model looks for a primary key called 'id'
}
