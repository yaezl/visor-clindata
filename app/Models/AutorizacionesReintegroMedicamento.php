<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AutorizacionesReintegroMedicamento
 * 
 * @property int $id
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property int|null $articulotipopresentacion_id
 * @property int|null $reintegro_id
 * @property float $precio
 * @property int $cantidad
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 * @property AutorizacionesReintegro|null $autorizaciones_reintegro
 * @property ArticuloTipopresentacion|null $articulo_tipopresentacion
 *
 * @package App\Models
 */
class AutorizacionesReintegroMedicamento extends Model
{
	protected $table = 'autorizaciones_reintegro_medicamentos';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'articulotipopresentacion_id' => 'int',
		'reintegro_id' => 'int',
		'precio' => 'float',
		'cantidad' => 'int',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'articulotipopresentacion_id',
		'reintegro_id',
		'precio',
		'cantidad',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function autorizaciones_reintegro()
	{
		return $this->belongsTo(AutorizacionesReintegro::class, 'reintegro_id');
	}

	public function articulo_tipopresentacion()
	{
		return $this->belongsTo(ArticuloTipopresentacion::class, 'articulotipopresentacion_id');
	}
}
