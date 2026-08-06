<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Facturacriterio
 * 
 * @property int $id
 * @property int|null $factura_id
 * @property int|null $tipobono_id
 * @property int|null $especialidad_id
 * @property int|null $plan_id
 * @property int|null $institucion_id
 * @property int|null $procedencia
 * @property int|null $factura_a_refacturar_id
 * @property bool|null $para_refacturar
 * 
 * @property Factura|null $factura
 * @property Tipobono|null $tipobono
 * @property Especialidad|null $especialidad
 * @property Plan|null $plan
 * @property Institucion|null $institucion
 *
 * @package App\Models
 */
class Facturacriterio extends Model
{
	protected $table = 'facturacriterio';
	public $timestamps = false;

	protected $casts = [
		'factura_id' => 'int',
		'tipobono_id' => 'int',
		'especialidad_id' => 'int',
		'plan_id' => 'int',
		'institucion_id' => 'int',
		'procedencia' => 'int',
		'factura_a_refacturar_id' => 'int',
		'para_refacturar' => 'bool'
	];

	protected $fillable = [
		'factura_id',
		'tipobono_id',
		'especialidad_id',
		'plan_id',
		'institucion_id',
		'procedencia',
		'factura_a_refacturar_id',
		'para_refacturar'
	];

	public function factura()
	{
		return $this->belongsTo(Factura::class, 'factura_a_refacturar_id');
	}

	public function tipobono()
	{
		return $this->belongsTo(Tipobono::class);
	}

	public function especialidad()
	{
		return $this->belongsTo(Especialidad::class);
	}

	public function plan()
	{
		return $this->belongsTo(Plan::class);
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}
}
