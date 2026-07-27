<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AutorizacionesNotasAuditorFacturacion
 * 
 * @property int $id
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property int|null $autorizacion_id
 * @property string $nota
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string|null $deleted_at
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 * @property AutorizacionesAutorizacion|null $autorizaciones_autorizacion
 *
 * @package App\Models
 */
class AutorizacionesNotasAuditorFacturacion extends Model
{
	use SoftDeletes;
	protected $table = 'autorizaciones_notas_auditor_facturacion';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'autorizacion_id' => 'int',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'autorizacion_id',
		'nota',
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
}
