<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        /*'de_user_id',
        'a_user_id',*/
        'de_compte_id',
        'a_compte_id',
        'solde',
        'type',
    ];

   /* public function fromUser()
    {
        return $this->belongsTo(User::class, 'de_user_id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'a_user_id');
    }*/
    public function fromCompte()
    {
        return $this->belongsTo(Compte::class, 'de_compte_id');
    }

    public function toCompte()
    {
        return $this->belongsTo(Compte::class, 'a_compte_id');
    }
}
