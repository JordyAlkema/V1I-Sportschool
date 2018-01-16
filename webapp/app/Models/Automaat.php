<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 16 Jan 2018 10:32:17 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Automaten
 * 
 * @property int $id
 * @property string $naam
 * @property float $bedrag_per_minuut
 * @property int $locatie_id
 * @property int $automaat_type_id
 * 
 * @property \App\Models\Automaattype $automaattype
 * @property \App\Models\Locatie $locaty
 * @property \Illuminate\Database\Eloquent\Collection $activiteitens
 *
 * @package App\Models
 */
class Automaat extends Eloquent
{
	protected $table = 'automaten';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'bedrag_per_minuut' => 'float',
		'locatie_id' => 'int',
		'automaat_type_id' => 'int'
	];

	protected $fillable = [
		'naam',
		'bedrag_per_minuut',
		'locatie_id',
		'automaat_type_id'
	];

	public function automaattype()
	{
		return $this->belongsTo(Automaattype::class, 'automaat_type_id');
	}

	public function locaty()
	{
		return $this->belongsTo(Locatie::class, 'locatie_id');
	}

	public function activiteitens()
	{
		return $this->hasMany(Activiteiten::class, 'automaat_id');
	}
}
