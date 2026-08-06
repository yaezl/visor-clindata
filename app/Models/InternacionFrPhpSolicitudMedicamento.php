<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionFrPhpSolicitudMedicamento
 * 
 * @property int $id
 * @property int|null $frasco_php_id
 * @property int|null $solicitud_medicamento_id
 * @property string $tipo
 * @property bool $activo
 * 
 * @property FarFrascoPlanHidratacion|null $far_frasco_plan_hidratacion
 * @property FarSolicitudMedicamento|null $far_solicitud_medicamento
 *
 * @package App\Models
 */
class InternacionFrPhpSolicitudMedicamento extends Model
{
	protected $table = 'internacion_fr_php_solicitud_medicamento';
	public $timestamps = false;

	protected $casts = [
		'frasco_php_id' => 'int',
		'solicitud_medicamento_id' => 'int',
		'activo' => 'bool'
	];

	protected $fillable = [
		'frasco_php_id',
		'solicitud_medicamento_id',
		'tipo',
		'activo'
	];

	public function far_frasco_plan_hidratacion()
	{
		return $this->belongsTo(FarFrascoPlanHidratacion::class, 'frasco_php_id');
	}

	public function far_solicitud_medicamento()
	{
		return $this->belongsTo(FarSolicitudMedicamento::class, 'solicitud_medicamento_id');
	}
}
