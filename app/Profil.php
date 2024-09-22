<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    use HasFactory;

    protected $table = 'profil';
    protected $fillable = ['prenom', 'nom', 'image', 'statut'];


//    relation avec la table user
    public function user() {
        return $this->belongsTo(User::class);
    }
}
