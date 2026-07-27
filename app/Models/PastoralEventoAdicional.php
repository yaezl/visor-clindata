<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PastoralEventoAdicional
 * 
 * @property int $id
 * @property int|null $tipo_evento_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property Carbon|null $fecha
 * @property Carbon $horaInicio
 * @property Carbon $horaFin
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 * @property PastoralTipoevento|null $pastoral_tipoevento
 * @property Collection|PastoralEventoParticipante[] $pastoral_evento_participantes
 *
 * @package App\Models
 */
class PastoralEventoAdicional extends Model
{
	protected $table = 'pastoral_evento_adicional';
	public $timestamps = false;

	protected $casts = [
		'tipo_evento_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'fecha' => 'datetime',
		'horaInicio' => 'datetime',
		'horaFin' => 'datetime',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'tipo_evento_id',
		'creadopor_id',
		'modificadopor_id',
		'fecha',
		'horaInicio',
		'horaFin',
		'creado_en',
		'modificado_en',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'creadopor_id');
	}

	public function pastoral_tipoevento()
	{
		return $this->belongsTo(PastoralTipoevento::class, 'tipo_evento_id');
	}

	public function pastoral_evento_participantes()
	{
		return $this->hasMany(PastoralEventoParticipante::class, 'evento_adicional_id');
	}
}
