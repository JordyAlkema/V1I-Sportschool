<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 15 Jan 2018 13:24:25 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Transactietype
 * 
 * @property int $id
 * @property string $naam
 * 
 * @property \Illuminate\Database\Eloquent\Collection $transacties
 *
 * @package App\Models
 */
class Transactietype extends Eloquent
{
	protected $table = 'transactietype';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'naam'
	];

	public function transacties()
	{
		return $this->hasMany(Transactie::class, 'transactieType_id');
	}
}
