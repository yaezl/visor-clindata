<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionHiSolicitudMedicamento
 * 
 * @property int $id
 * @property int|null $hoja_indicaciones_id
 * @property int|null $solicitud_medicamento_id
 * @property string $tipo
 * 
 * @property InternacionHojaIndicacione|null $internacion_hoja_indicacione
 * @property FarSolicitudMedicamento|null $far_solicitud_medicamento
 *
 * @package App\Models
 */
class InternacionHiSolicitudMedicamento extends Model
{
	protected $table = 'internacion_hi_solicitud_medicamento';
	public $timestamps = false;

	protected $casts = [
		'hoja_indicaciones_id' => 'int',
		'solicitud_medicamento_id' => 'int'
	];

	protected $fillable = [
		'hoja_indicaciones_id',
		'solicitud_medicamento_id',
		'tipo'
	];

	public function internacion_hoja_indicacione()
	{
		return $this->belongsTo(InternacionHojaIndicacione::class, 'hoja_indicaciones_id');
	}

	public function far_solicitud_medicamento()
	{
		return $this->belongsTo(FarSolicitudMedicamento::class, 'solicitud_medicamento_id');
	}
}
