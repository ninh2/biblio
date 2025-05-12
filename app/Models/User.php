<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class User extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'utilisateurs';
    protected $primaryKey = 'id_utilisateur'; // Définition de la clé primaire
    public $incrementing = true; // Indique que c'est un ID auto-incrémenté



    protected $fillable = [
        'id_utilisateur',
        'statut',
        'nom',
        'prenom',
        'date_naissance',
        'email',
        'mot_de_passe',
        'adresse',
        'code_postal',
        'ville',
        'reception_newsletter',
        'role',
    ];


}
