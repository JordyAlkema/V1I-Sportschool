<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 16 Jan 2018 10:32:17 +0000.
 */

namespace App\Models;

use Carbon\Carbon;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Activiteiten
 * 
 * @property int $id
 * @property int $user_id
 * @property int $automaat_id
 * @property \Carbon\Carbon $begin_datum
 * @property \Carbon\Carbon $eind_datum
 * 
 * @property \App\Models\Automaat $automaten
 * @property \App\Models\Gebruiker $gebruiker
 * @property \Illuminate\Database\Eloquent\Collection $transacties
 *
 * @package App\Models
 */
class Activiteiten extends Eloquent
{
	protected $table = 'activiteiten';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'automaat_id' => 'int'
	];

	protected $dates = [
		'begin_datum',
		'eind_datum'
	];

	protected $fillable = [
		'user_id',
		'automaat_id',
		'begin_datum',
		'eind_datum'
	];

	public function automaat()
	{
		return $this->belongsTo(Automaat::class, 'automaat_id');
	}

	public function gebruiker()
	{
		return $this->belongsTo(Gebruiker::class, 'user_id');
	}

	public function transacties()
	{
		return $this->hasMany(Transactie::class, 'activiteit_id');
	}

    public function getTijdAttribute()
    {
        if($this->eind_datum == null){
            $tijd = "Bezig met activiteit";
        }else{
            $tijd = $this->begin_datum->diffInMinutes($this->eind_datum) . " Minuten";
        }

        return $tijd;
	}
}
