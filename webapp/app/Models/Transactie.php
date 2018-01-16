<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 16 Jan 2018 10:32:17 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Transacty
 * 
 * @property int $id
 * @property int $user_id
 * @property int $transactieType_id
 * @property float $bedrag
 * @property \Carbon\Carbon $datum
 * @property int $activiteit_id
 * 
 * @property \App\Models\Activiteiten $activiteiten
 * @property \App\Models\Transactietype $transactietype
 * @property \App\Models\Gebruiker $gebruiker
 *
 * @package App\Models
 */
class Transactie extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'transactieType_id' => 'int',
		'bedrag' => 'float',
		'activiteit_id' => 'int'
	];

	protected $dates = [
		'datum'
	];

	protected $fillable = [
		'user_id',
		'transactieType_id',
		'bedrag',
		'datum',
		'activiteit_id'
	];

	public function activiteiten()
	{
		return $this->belongsTo(Activiteiten::class, 'activiteit_id');
	}

	public function transactietype()
	{
		return $this->belongsTo(Transactietype::class, 'transactieType_id');
	}

	public function gebruiker()
	{
		return $this->belongsTo(Gebruiker::class, 'user_id');
	}
}
