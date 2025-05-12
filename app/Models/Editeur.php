<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Editeur extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id_editeur';
    protected $fillable = [
        'id_editeur',
        'libelle',
    ];
}