<?php

namespace App\Models;
use App\Http\Controllers\OuvrageController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ouvrages extends Model
{
    use HasFactory;

    // Nom de la table dans la base mariadb
    protected $table = 'ouvrages'; 


    protected $primaryKey = 'id_ouvrage';


    public $timestamps = false;


    protected $fillable = [
        'code_isbn', 
        'titre', 
        'type', 
        'id_editeur' 
    ];
    
    

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_ouvrages', 'id_ouvrage', 'id_genre');
    }

    
    public function auteurs()
    {
        return $this->belongsToMany(Auteur::class, 'auteur_ouvrages', 'id_ouvrage', 'id_auteur');
    }

    public function editeur()
    {
        return $this->belongsTo(Editeur::class, 'id_editeur');
    }


}

