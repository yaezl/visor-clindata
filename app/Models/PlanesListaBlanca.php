<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PlanesListaBlanca
 * 
 * @property int $id
 * @property int|null $plan_id
 * @property int|null $regla_id
 * @property int $cantidad
 * @property bool $os_completa
 * 
 * @property ReglaAgendaPlanListaBlanca|null $regla_agenda_plan_lista_blanca
 * @property Plan|null $plan
 *
 * @package App\Models
 */
class PlanesListaBlanca extends Model
{
	protected $table = 'planes_lista_blanca';
	public $timestamps = false;

	protected $casts = [
		'plan_id' => 'int',
		'regla_id' => 'int',
		'cantidad' => 'int',
		'os_completa' => 'bool'
	];

	protected $fillable = [
		'plan_id',
		'regla_id',
		'cantidad',
		'os_completa'
	];

	public function regla_agenda_plan_lista_blanca()
	{
		return $this->belongsTo(ReglaAgendaPlanListaBlanca::class, 'regla_id');
	}

	public function plan()
	{
		return $this->belongsTo(Plan::class);
	}
}
