<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 15 Jan 2018 13:24:25 +0000.
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
 * @property \App\Models\Activiteit $activiteit
 * @property \App\Models\Transactietype $transactietype
 * @property \App\Models\User $user
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

	public function activiteit()
	{
		return $this->belongsTo(Activiteit::class);
	}

	public function transactietype()
	{
		return $this->belongsTo(Transactietype::class, 'transactieType_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
