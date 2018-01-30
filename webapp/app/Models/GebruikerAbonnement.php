<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GebruikerAbonnement extends Model
{
    //
    protected $table = 'gebruiker_abonnement';
    public $timestamps = false;

    protected $dates = [
        'begin_datum',
        'eind_datum'
    ];
}
