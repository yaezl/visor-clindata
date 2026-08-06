<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PersonaCambioDato
 * 
 * @property int $id
 * @property int|null $persona_auditoria_id
 * @property int|null $tipo_documento_id
 * @property string|null $documento
 * @property string $apellidos
 * @property string $nombres
 * @property int|null $nro_hc
 * @property bool $falta_auditar
 * 
 * @property PersonaAuditorium|null $persona_auditorium
 * @property TipoDocumento|null $tipo_documento
 *
 * @package App\Models
 */
class PersonaCambioDato extends Model
{
	protected $table = 'persona_cambio_dato';
	public $timestamps = false;

	protected $casts = [
		'persona_auditoria_id' => 'int',
		'tipo_documento_id' => 'int',
		'nro_hc' => 'int',
		'falta_auditar' => 'bool'
	];

	protected $fillable = [
		'persona_auditoria_id',
		'tipo_documento_id',
		'documento',
		'apellidos',
		'nombres',
		'nro_hc',
		'falta_auditar'
	];

	public function persona_auditorium()
	{
		return $this->belongsTo(PersonaAuditorium::class, 'persona_auditoria_id');
	}

	public function tipo_documento()
	{
		return $this->belongsTo(TipoDocumento::class);
	}
}
