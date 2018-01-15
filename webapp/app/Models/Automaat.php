<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 15 Jan 2018 13:24:24 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Automaat
 * 
 * @property int $id
 * @property string $naam
 * @property float $bedrag_per_minuut
 * 
 * @property \Illuminate\Database\Eloquent\Collection $activiteits
 *
 * @package App\Models
 */
class Automaat extends Eloquent
{
	protected $table = 'automaat';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'bedrag_per_minuut' => 'float'
	];

	protected $fillable = [
		'naam',
		'bedrag_per_minuut'
	];

	public function activiteiten()
	{
		return $this->hasMany(Activiteit::class);
	}
}
