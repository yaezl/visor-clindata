<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AutorizacionesDiagnostico
 * 
 * @property int $id
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property int|null $deleted_by
 * @property int $autorizacion_id
 * @property int|null $diagnostico_id
 * @property string $tipo
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string|null $deleted_at
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 * @property AutorizacionesAutorizacion $autorizaciones_autorizacion
 * @property Diagnostico|null $diagnostico
 *
 * @package App\Models
 */
class AutorizacionesDiagnostico extends Model
{
	use SoftDeletes;
	protected $table = 'autorizaciones_diagnosticos';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'autorizacion_id' => 'int',
		'diagnostico_id' => 'int',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'deleted_by',
		'autorizacion_id',
		'diagnostico_id',
		'tipo',
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

	public function diagnostico()
	{
		return $this->belongsTo(Diagnostico::class);
	}
}
