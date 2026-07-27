<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProcedimientoArticulotipopresentacion
 * 
 * @property int $id
 * @property int $cantidad
 * @property int|null $procedimiento_id
 * @property int|null $atp_id
 * 
 * @property ArticuloTipopresentacion|null $articulo_tipopresentacion
 * @property InternacionProcedimiento|null $internacion_procedimiento
 *
 * @package App\Models
 */
class ProcedimientoArticulotipopresentacion extends Model
{
	protected $table = 'procedimiento_articulotipopresentacion';
	public $timestamps = false;

	protected $casts = [
		'cantidad' => 'int',
		'procedimiento_id' => 'int',
		'atp_id' => 'int'
	];

	protected $fillable = [
		'cantidad',
		'procedimiento_id',
		'atp_id'
	];

	public function articulo_tipopresentacion()
	{
		return $this->belongsTo(ArticuloTipopresentacion::class, 'atp_id');
	}

	public function internacion_procedimiento()
	{
		return $this->belongsTo(InternacionProcedimiento::class, 'procedimiento_id');
	}
}
