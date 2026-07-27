<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PastoralEvento
 * 
 * @property int $id
 * @property int|null $persona_internacion_id
 * @property int|null $responsable_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property Carbon|null $fechaProximaVisita
 * @property string|null $observaciones
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 * @property Personal|null $personal
 * @property InternacionPersona|null $internacion_persona
 * @property Collection|PastoralEventoAccion[] $pastoral_evento_accions
 * @property Collection|PastoralEventoNecesidad[] $pastoral_evento_necesidads
 * @property Collection|PastoralEventoSacramento[] $pastoral_evento_sacramentos
 *
 * @package App\Models
 */
class PastoralEvento extends Model
{
	protected $table = 'pastoral_evento';
	public $timestamps = false;

	protected $casts = [
		'persona_internacion_id' => 'int',
		'responsable_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'fechaProximaVisita' => 'datetime',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'persona_internacion_id',
		'responsable_id',
		'creadopor_id',
		'modificadopor_id',
		'fechaProximaVisita',
		'observaciones',
		'creado_en',
		'modificado_en',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'creadopor_id');
	}

	public function personal()
	{
		return $this->belongsTo(Personal::class, 'responsable_id');
	}

	public function internacion_persona()
	{
		return $this->belongsTo(InternacionPersona::class, 'persona_internacion_id');
	}

	public function pastoral_evento_accions()
	{
		return $this->hasMany(PastoralEventoAccion::class, 'evento_id');
	}

	public function pastoral_evento_necesidads()
	{
		return $this->hasMany(PastoralEventoNecesidad::class, 'evento_id');
	}

	public function pastoral_evento_sacramentos()
	{
		return $this->hasMany(PastoralEventoSacramento::class, 'evento_id');
	}
}
