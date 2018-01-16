<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 16 Jan 2018 10:32:17 +0000.
 */

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Medewerker
 * 
 * @property int $id
 * @property string $naam
 * @property string $tussenvoegsel
 * @property string $achternaam
 * @property string $email
 * @property string $telefoonnummer
 * @property int $locatie_id
 * 
 * @property \App\Models\Locatie $locaty
 * @property \Illuminate\Database\Eloquent\Collection $afspraaks
 *
 * @package App\Models
 */
class Medewerker extends Eloquent implements Authenticatable
{
    use AuthenticableTrait;

	protected $table = 'medewerker';
	public $timestamps = false;

	protected $casts = [
		'locatie_id' => 'int'
	];

	protected $fillable = [
		'naam',
		'tussenvoegsel',
		'achternaam',
		'email',
		'telefoonnummer',
		'locatie_id'
	];

	public function locatie()
	{
		return $this->belongsTo(Locatie::class, 'locatie_id');
	}

	public function afspraken()
	{
		return $this->hasMany(Afspraak::class);
	}
}
