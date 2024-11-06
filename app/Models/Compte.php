<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'solde',
        'libelle',
        'num_compte',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function CreditDemandes()
{
    return $this->hasMany(CreditDemande::class);
}


    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'de_compte_id')->union(
            $this->hasMany(Transaction::class, 'a_compte_id')
        );
    }
    public function operations()
{
    return $this->hasMany(Operation::class);
}
}
