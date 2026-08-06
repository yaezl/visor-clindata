<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PersonaEducacion
 * 
 * @property int $id
 * @property int|null $persona_id
 * @property int|null $nivelinstruccion_id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $eliminado_por_id
 * @property int|null $aniosAprobados
 * @property bool|null $problemasInstitucion
 * @property string|null $observaciones
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * @property string|null $escuelas
 * 
 * @property Persona|null $persona
 * @property Nivelinstruccion|null $nivelinstruccion
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class PersonaEducacion extends Model
{
	protected $table = 'persona_educacion';
	public $timestamps = false;

	protected $casts = [
		'persona_id' => 'int',
		'nivelinstruccion_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'eliminado_por_id' => 'int',
		'aniosAprobados' => 'int',
		'problemasInstitucion' => 'bool',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime'
	];

	protected $fillable = [
		'persona_id',
		'nivelinstruccion_id',
		'creado_por_id',
		'modificado_por_id',
		'eliminado_por_id',
		'aniosAprobados',
		'problemasInstitucion',
		'observaciones',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'escuelas'
	];

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function nivelinstruccion()
	{
		return $this->belongsTo(Nivelinstruccion::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminado_por_id');
	}
}
