<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 15 Jan 2018 13:24:25 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class User
 * 
 * @property int $id
 * @property string $voornaam
 * @property string $tussenvoegsel
 * @property string $achternaam
 * @property \Carbon\Carbon $geboortedatum
 * @property string $pasnummer
 * 
 * @property \Illuminate\Database\Eloquent\Collection $activiteits
 * @property \Illuminate\Database\Eloquent\Collection $transacties
 *
 * @package App\Models
 */
class User extends Eloquent
{
	public $timestamps = false;

	protected $dates = [
		'geboortedatum'
	];

	protected $fillable = [
		'voornaam',
		'tussenvoegsel',
		'achternaam',
		'geboortedatum',
		'pasnummer'
	];

	public function activiteiten()
	{
		return $this->hasMany(Activiteit::class);
	}

	public function transacties()
	{
		return $this->hasMany(Transactie::class);
	}
}
