<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionMotivocancelacionquirofano
 * 
 * @property int $id
 * @property int $created_by
 * @property int $modified_by
 * @property Carbon $created_at
 * @property Carbon $modified_at
 * @property string $nombre
 * @property string $descripcion
 * @property bool $borrado_logico
 * 
 * @property Usuario $usuario
 * @property Collection|AuditoriaReservaQuirofano[] $auditoria_reserva_quirofanos
 *
 * @package App\Models
 */
class InternacionMotivocancelacionquirofano extends Model
{
	protected $table = 'internacion_motivocancelacionquirofano';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'modified_at' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'modified_at',
		'nombre',
		'descripcion',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function auditoria_reserva_quirofanos()
	{
		return $this->hasMany(AuditoriaReservaQuirofano::class, 'motivo_cancelacion_quirofano_id');
	}
}
