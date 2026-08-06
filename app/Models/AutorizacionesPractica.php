<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AutorizacionesPractica
 * 
 * @property int $id
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property int|null $deleted_by
 * @property int|null $autorizacion_id
 * @property int|null $practica_id
 * @property int|null $prestacion_id
 * @property int $cantidad
 * @property bool $debitado
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string|null $deleted_at
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 * @property Prestacion|null $prestacion
 * @property AutorizacionesAutorizacion|null $autorizaciones_autorizacion
 * @property Estudio|null $estudio
 *
 * @package App\Models
 */
class AutorizacionesPractica extends Model
{
	use SoftDeletes;
	protected $table = 'autorizaciones_practicas';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'autorizacion_id' => 'int',
		'practica_id' => 'int',
		'prestacion_id' => 'int',
		'cantidad' => 'int',
		'debitado' => 'bool',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'deleted_by',
		'autorizacion_id',
		'practica_id',
		'prestacion_id',
		'cantidad',
		'debitado',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function prestacion()
	{
		return $this->belongsTo(Prestacion::class);
	}

	public function autorizaciones_autorizacion()
	{
		return $this->belongsTo(AutorizacionesAutorizacion::class, 'autorizacion_id');
	}

	public function estudio()
	{
		return $this->belongsTo(Estudio::class, 'practica_id');
	}
}
