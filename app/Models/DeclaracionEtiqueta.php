<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DeclaracionEtiqueta
 * 
 * @property int $id
 * @property int $created_by
 * @property int $modified_by
 * @property int $etiqueta_id
 * @property int $orden_id
 * @property string $estado
 * @property string|null $codigo_ad_hoc
 * @property string $tipo_operacion
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @property int|null $evento_relacionado
 * 
 * @property Usuario $usuario
 * @property DeclaracionEtiqueta|null $declaracion_etiqueta
 * @property InternacionOrden $internacion_orden
 * @property InternacionEtiquetum $internacion_etiquetum
 *
 * @package App\Models
 */
class DeclaracionEtiqueta extends Model
{
	protected $table = 'declaracion_etiquetas';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'etiqueta_id' => 'int',
		'orden_id' => 'int',
		'evento_relacionado' => 'int'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'etiqueta_id',
		'orden_id',
		'estado',
		'codigo_ad_hoc',
		'tipo_operacion',
		'evento_relacionado'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function declaracion_etiqueta()
	{
		return $this->hasOne(DeclaracionEtiqueta::class, 'evento_relacionado');
	}

	public function internacion_orden()
	{
		return $this->belongsTo(InternacionOrden::class, 'orden_id');
	}

	public function internacion_etiquetum()
	{
		return $this->belongsTo(InternacionEtiquetum::class, 'etiqueta_id');
	}
}
