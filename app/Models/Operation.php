<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

    protected $fillable = [
        /*'user_id',*/
        'compte_id',
        'type',
        'solde',
    ];

  /*  public function user()
    {
        return $this->belongsTo(User::class);
    }*/
    public function compte()
{
    return $this->belongsTo(Compte::class);
}

}
