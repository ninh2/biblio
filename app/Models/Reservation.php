<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';
    public $timestamps = false;
    protected $primaryKey = 'id_reservation'; 

    protected $fillable = [
        'id_ouvrage',
        'id_utilisateur',
        'date_reservation',
    ];

    // Définir les relations
    public function ouvrage()
    {
        return $this->belongsTo(Ouvrages::class, 'id_ouvrage');
    }

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'id_utilisateur');
    }
}
