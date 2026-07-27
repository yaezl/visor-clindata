<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Odontologium
 * 
 * @property int $id
 * @property string $motivo_consulta
 * @property string|null $examenfisico
 * @property string|null $tejidos_blandos
 * @property string|null $plan_tratamiento
 * @property string|null $snapshot
 * 
 * @property Consultadetalle $consultadetalle
 * @property Collection|Odontoaplicacion[] $odontoaplicacions
 * @property Collection|OdontologiaInformedeestudio[] $odontologia_informedeestudios
 *
 * @package App\Models
 */
class Odontologium extends Model
{
	protected $table = 'odontologia';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'motivo_consulta',
		'examenfisico',
		'tejidos_blandos',
		'plan_tratamiento',
		'snapshot'
	];

	public function consultadetalle()
	{
		return $this->belongsTo(Consultadetalle::class, 'id');
	}

	public function odontoaplicacions()
	{
		return $this->hasMany(Odontoaplicacion::class, 'consulta_cambioestado_id');
	}

	public function odontologia_informedeestudios()
	{
		return $this->hasMany(OdontologiaInformedeestudio::class, 'odontologia_id');
	}
}
