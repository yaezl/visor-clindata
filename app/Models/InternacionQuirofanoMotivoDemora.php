<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionQuirofanoMotivoDemora
 * 
 * @property int $id
 * @property int $created_by
 * @property int $modified_by
 * @property string $nombre
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @property bool $borradoLogico
 * 
 * @property Usuario $usuario
 * @property Collection|InternacionQuirofanoAuditoriaEnfermerium[] $internacion_quirofano_auditoria_enfermeria
 *
 * @package App\Models
 */
class InternacionQuirofanoMotivoDemora extends Model
{
	protected $table = 'internacion_quirofano_motivo_demora';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'borradoLogico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'nombre',
		'borradoLogico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function internacion_quirofano_auditoria_enfermeria()
	{
		return $this->hasMany(InternacionQuirofanoAuditoriaEnfermerium::class, 'motivo_demora_id');
	}
}
