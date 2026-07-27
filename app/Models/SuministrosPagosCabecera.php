<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SuministrosPagosCabecera
 * 
 * @property int $id
 * @property int|null $proveedor_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $eliminadopor_id
 * @property string|null $nro_comprobante
 * @property Carbon|null $fecha_comprobante
 * @property int $estado
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * 
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class SuministrosPagosCabecera extends Model
{
	protected $table = 'suministros_pagos_cabecera';
	public $timestamps = false;

	protected $casts = [
		'proveedor_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'eliminadopor_id' => 'int',
		'fecha_comprobante' => 'datetime',
		'estado' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime'
	];

	protected $fillable = [
		'proveedor_id',
		'creadopor_id',
		'modificadopor_id',
		'eliminadopor_id',
		'nro_comprobante',
		'fecha_comprobante',
		'estado',
		'creado_en',
		'modificado_en',
		'borrado_en'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminadopor_id');
	}
}
