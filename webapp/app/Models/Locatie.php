<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 16 Jan 2018 10:32:17 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Locaty
 * 
 * @property int $id
 * @property string $naam
 * @property string $Stad
 * @property string $Straat
 * @property string $Huisnummer
 * 
 * @property \Illuminate\Database\Eloquent\Collection $automatens
 * @property \Illuminate\Database\Eloquent\Collection $medewerkers
 *
 * @package App\Models
 */
class Locatie extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'naam',
		'Stad',
		'Straat',
		'Huisnummer'
	];

	public function automaten()
	{
		return $this->hasMany(Automaat::class, 'locatie_id');
	}

	public function medewerkers()
	{
		return $this->hasMany(Medewerker::class, 'locatie_id');
	}
}
