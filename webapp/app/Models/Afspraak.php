<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 16 Jan 2018 10:32:17 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Afspraak
 * 
 * @property int $id
 * @property int $medewerker_id
 * @property int $user_id
 * @property \Carbon\Carbon $email_verstuurd
 * 
 * @property \App\Models\Medewerker $medewerker
 * @property \App\Models\Gebruiker $gebruiker
 *
 * @package App\Models
 */
class Afspraak extends Eloquent
{
	protected $table = 'afspraak';
	public $timestamps = false;

	protected $casts = [
		'medewerker_id' => 'int',
		'user_id' => 'int'
	];

	protected $dates = [
		'email_verstuurd'
	];

	protected $fillable = [
		'medewerker_id',
		'user_id',
		'email_verstuurd'
	];

	public function medewerker()
	{
		return $this->belongsTo(Gebruiker::class, 'medewerker_id');
	}

	public function gebruiker()
	{
		return $this->belongsTo(Gebruiker::class, 'user_id');
	}
}
