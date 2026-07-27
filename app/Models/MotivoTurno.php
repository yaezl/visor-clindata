<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MotivoTurno
 * 
 * @property int $id
 * @property int $created_by
 * @property int $modified_by
 * @property string $nombre
 * @property string $codigo
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $borrado_logico
 * 
 * @property Usuario $usuario
 * @property Collection|TurnoProgramado[] $turno_programados
 *
 * @package App\Models
 */
class MotivoTurno extends Model
{
	protected $table = 'motivo_turno';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'nombre',
		'codigo',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function turno_programados()
	{
		return $this->hasMany(TurnoProgramado::class);
	}
}
