<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PastoralEventoParticipante
 * 
 * @property int $id
 * @property int $evento_adicional_id
 * @property int|null $participante_id
 * @property int|null $tipo_participante_id
 * @property int|null $area_participante_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property bool $asistio
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property bool $borrado_logico
 * 
 * @property PastoralTipoparticipante|null $pastoral_tipoparticipante
 * @property Usuario|null $usuario
 * @property PastoralEventoAdicional $pastoral_evento_adicional
 * @property PastoralAreaParticipante|null $pastoral_area_participante
 * @property Persona|null $persona
 *
 * @package App\Models
 */
class PastoralEventoParticipante extends Model
{
	protected $table = 'pastoral_evento_participante';
	public $timestamps = false;

	protected $casts = [
		'evento_adicional_id' => 'int',
		'participante_id' => 'int',
		'tipo_participante_id' => 'int',
		'area_participante_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'asistio' => 'bool',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'evento_adicional_id',
		'participante_id',
		'tipo_participante_id',
		'area_participante_id',
		'creadopor_id',
		'modificadopor_id',
		'asistio',
		'creado_en',
		'modificado_en',
		'borrado_logico'
	];

	public function pastoral_tipoparticipante()
	{
		return $this->belongsTo(PastoralTipoparticipante::class, 'tipo_participante_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'creadopor_id');
	}

	public function pastoral_evento_adicional()
	{
		return $this->belongsTo(PastoralEventoAdicional::class, 'evento_adicional_id');
	}

	public function pastoral_area_participante()
	{
		return $this->belongsTo(PastoralAreaParticipante::class, 'area_participante_id');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class, 'participante_id');
	}
}
