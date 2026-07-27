<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Prefacturacriterio
 * 
 * @property int $id
 * @property int|null $prefactura_id
 * @property int|null $tipobono_id
 * @property int|null $especialidad_id
 * @property int|null $plan_id
 * @property int|null $procedencia
 * @property int|null $factura_a_refacturar_id
 * @property bool|null $para_refacturar
 * 
 * @property Prefactura|null $prefactura
 * @property Tipobono|null $tipobono
 * @property Especialidad|null $especialidad
 * @property Plan|null $plan
 * @property Factura|null $factura
 *
 * @package App\Models
 */
class Prefacturacriterio extends Model
{
	protected $table = 'prefacturacriterio';
	public $timestamps = false;

	protected $casts = [
		'prefactura_id' => 'int',
		'tipobono_id' => 'int',
		'especialidad_id' => 'int',
		'plan_id' => 'int',
		'procedencia' => 'int',
		'factura_a_refacturar_id' => 'int',
		'para_refacturar' => 'bool'
	];

	protected $fillable = [
		'prefactura_id',
		'tipobono_id',
		'especialidad_id',
		'plan_id',
		'procedencia',
		'factura_a_refacturar_id',
		'para_refacturar'
	];

	public function prefactura()
	{
		return $this->belongsTo(Prefactura::class);
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

	public function factura()
	{
		return $this->belongsTo(Factura::class, 'factura_a_refacturar_id');
	}
}
