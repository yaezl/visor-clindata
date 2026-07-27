<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Familiarol
 * 
 * @property int $id
 * @property string $nombre
 * @property int $gf_orden
 * @property int|null $rolInversoFemenino_id
 * @property int|null $rolInversoMasculino_id
 * @property string|null $sexo
 * 
 * @property Familiarol|null $familiarol
 * @property Collection|Antecedenteheredofamiliar[] $antecedenteheredofamiliars
 * @property Collection|Familiarelacion[] $familiarelacions
 * @property Collection|Familiarol[] $familiarols
 *
 * @package App\Models
 */
class Familiarol extends Model
{
	protected $table = 'familiarol';
	public $timestamps = false;

	protected $casts = [
		'gf_orden' => 'int',
		'rolInversoFemenino_id' => 'int',
		'rolInversoMasculino_id' => 'int'
	];

	protected $fillable = [
		'nombre',
		'gf_orden',
		'rolInversoFemenino_id',
		'rolInversoMasculino_id',
		'sexo'
	];

	public function familiarol()
	{
		return $this->belongsTo(Familiarol::class, 'rolInversoMasculino_id');
	}

	public function antecedenteheredofamiliars()
	{
		return $this->hasMany(Antecedenteheredofamiliar::class, 'familiarrol_id');
	}

	public function familiarelacions()
	{
		return $this->hasMany(Familiarelacion::class, 'rol_individuo2_id');
	}

	public function familiarols()
	{
		return $this->hasMany(Familiarol::class, 'rolInversoMasculino_id');
	}
}
