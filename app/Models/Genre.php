<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;


    protected $table = 'genres';


    protected $primaryKey = 'id_genre';


    public $timestamps = false;


    protected $fillable = [
        'libelle',
    ];


    public function ouvrages()
    {
        return $this->belongsToMany(Ouvrages::class, 'genre_ouvrages', 'id_genre', 'id_ouvrage');
    }
}
