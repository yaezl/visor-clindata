<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AdmisionAsignacionauditorium
 * 
 * @property int $id
 * @property int $created_by
 * @property int $asignacion_id
 * @property Carbon $created_at
 * @property string|null $comentario
 * @property bool $disponible_portal
 * @property int|null $sobreturnos
 * @property string|null $aviso_portal
 * @property bool $practicas_bloqueantes
 * 
 * @property Asignacion $asignacion
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class AdmisionAsignacionauditorium extends Model
{
	protected $table = 'admision_asignacionauditoria';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'asignacion_id' => 'int',
		'disponible_portal' => 'bool',
		'sobreturnos' => 'int',
		'practicas_bloqueantes' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'asignacion_id',
		'comentario',
		'disponible_portal',
		'sobreturnos',
		'aviso_portal',
		'practicas_bloqueantes'
	];

	public function asignacion()
	{
		return $this->belongsTo(Asignacion::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}
}
