<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AutorizacionesMedicacion
 * 
 * @property int $id
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property int|null $deleted_by
 * @property int|null $autorizacion_id
 * @property int|null $articulo_tipopresentacion_id
 * @property float $cobertura
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string|null $deleted_at
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 * @property AutorizacionesAutorizacion|null $autorizaciones_autorizacion
 * @property ArticuloTipopresentacion|null $articulo_tipopresentacion
 *
 * @package App\Models
 */
class AutorizacionesMedicacion extends Model
{
	use SoftDeletes;
	protected $table = 'autorizaciones_medicacion';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'autorizacion_id' => 'int',
		'articulo_tipopresentacion_id' => 'int',
		'cobertura' => 'float',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'deleted_by',
		'autorizacion_id',
		'articulo_tipopresentacion_id',
		'cobertura',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function autorizaciones_autorizacion()
	{
		return $this->belongsTo(AutorizacionesAutorizacion::class, 'autorizacion_id');
	}

	public function articulo_tipopresentacion()
	{
		return $this->belongsTo(ArticuloTipopresentacion::class);
	}
}
