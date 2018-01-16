<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 16 Jan 2018 10:32:17 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Automaattype
 * 
 * @property int $id
 * @property string $naam
 * 
 * @property \Illuminate\Database\Eloquent\Collection $automatens
 *
 * @package App\Models
 */
class Automaattype extends Eloquent
{
	protected $table = 'automaattype';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'naam'
	];

	public function automaten()
	{
		return $this->hasMany(Automaat::class, 'automaat_type_id');
	}
}
