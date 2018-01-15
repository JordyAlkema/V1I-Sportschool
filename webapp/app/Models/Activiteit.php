<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 15 Jan 2018 13:24:24 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Activiteit
 * 
 * @property int $id
 * @property int $user_id
 * @property int $automaat_id
 * @property \Carbon\Carbon $begin_datum
 * @property \Carbon\Carbon $eind_datum
 * 
 * @property \App\Models\Automaat $automaat
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $transacties
 *
 * @package App\Models
 */
class Activiteit extends Eloquent
{
	protected $table = 'activiteit';
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
		return $this->belongsTo(Automaat::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function transacties()
	{
		return $this->hasMany(Transactie::class);
	}
}
