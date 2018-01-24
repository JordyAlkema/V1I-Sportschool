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
 * Class Gebruiker
 * 
 * @property int $id
 * @property string $voornaam
 * @property string $tussenvoegsel
 * @property string $achternaam
 * @property \Carbon\Carbon $geboortedatum
 * @property string $pasnummer
 * 
 * @property \Illuminate\Database\Eloquent\Collection $activiteitens
 * @property \Illuminate\Database\Eloquent\Collection $afspraaks
 * @property \Illuminate\Database\Eloquent\Collection $transacties
 *
 * @package App\Models
 */
class Gebruiker extends Eloquent implements Authenticatable
{
    use AuthenticableTrait;

	public $timestamps = false;

	protected $dates = [
		'geboortedatum'
	];

    protected $hidden = [
        'wachtwoord',
        'remember_token'
    ];

	protected $fillable = [
		'voornaam',
		'tussenvoegsel',
		'achternaam',
		'geboortedatum',
		'pasnummer'
	];

	public function activiteiten()
	{
		return $this->hasMany(Activiteiten::class, 'user_id');
	}

	public function afspraaken()
	{
		return $this->hasMany(Afspraak::class, 'user_id');
	}

	public function transacties()
	{
		return $this->hasMany(Transactie::class, 'user_id');
	}

	public function getBalanceAttribute(){
	    $transacties = $this->transacties;

        $sumArray = [];
        foreach ($transacties as $transactie){
            $sumArray[] = $transactie['bedrag'];
        }

        $sum = array_sum($sumArray);

        if(!$sum){
            $sum = 0;
        }

        return $sum;
    }

    public function getNameAttribute(){

	    $name = $this->voornaam;

	    if($this->tussenvoegsel){
            $name .= ' ' . $this->tussenvoegsel;
        }

        $name .= ' ' . $this->achternaam;

        return $name;
    }
}
