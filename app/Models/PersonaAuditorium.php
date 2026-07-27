<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PersonaAuditorium
 * 
 * @property int $id
 * @property int|null $eventoauditable_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $borradopor_id
 * @property string|null $justificacion
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * @property int|null $sobrePersona_id
 * @property int|null $unificadoConPersona_id
 * @property string|null $plan_sql
 * 
 * @property Persona|null $persona
 * @property Eventoauditable|null $eventoauditable
 * @property Usuario|null $usuario
 * @property PersonaCambioDato|null $persona_cambio_dato
 *
 * @package App\Models
 */
class PersonaAuditorium extends Model
{
	protected $table = 'persona_auditoria';
	public $timestamps = false;

	protected $casts = [
		'eventoauditable_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'borradopor_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'sobrePersona_id' => 'int',
		'unificadoConPersona_id' => 'int'
	];

	protected $fillable = [
		'eventoauditable_id',
		'creadopor_id',
		'modificadopor_id',
		'borradopor_id',
		'justificacion',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'sobrePersona_id',
		'unificadoConPersona_id',
		'plan_sql'
	];

	public function persona()
	{
		return $this->belongsTo(Persona::class, 'unificadoConPersona_id');
	}

	public function eventoauditable()
	{
		return $this->belongsTo(Eventoauditable::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borradopor_id');
	}

	public function persona_cambio_dato()
	{
		return $this->hasOne(PersonaCambioDato::class, 'persona_auditoria_id');
	}
}
