<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Auteur extends Model
{
    use HasFactory;

    protected $table = 'auteurs';
    protected $primaryKey = 'id_auteur';
    protected $fillable = ['prenom', 'nom'];

    public $timestamps = false;

    // Définir la relation avec Ouvrages 
    public function ouvrages()
    {
        return $this->belongsToMany(Ouvrages::class, 'auteur_ouvrages', 'id_auteur', 'id_ouvrage');
    }
}

