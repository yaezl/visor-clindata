<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PersonaArchivo
 * 
 * @property int $id
 * @property int|null $persona_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $eliminado_por_id
 * @property int|null $archivo_id
 * @property string|null $comentario
 * @property bool $activo
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property int|null $tipo_archivo
 * 
 * @property Persona|null $persona
 * @property Usuario|null $usuario
 * @property Archivo|null $archivo
 *
 * @package App\Models
 */
class PersonaArchivo extends Model
{
	protected $table = 'persona_archivo';
	public $timestamps = false;

	protected $casts = [
		'persona_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'eliminado_por_id' => 'int',
		'archivo_id' => 'int',
		'activo' => 'bool',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'tipo_archivo' => 'int'
	];

	protected $fillable = [
		'persona_id',
		'creadopor_id',
		'modificadopor_id',
		'eliminado_por_id',
		'archivo_id',
		'comentario',
		'activo',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'tipo_archivo'
	];

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminado_por_id');
	}

	public function archivo()
	{
		return $this->belongsTo(Archivo::class);
	}
}
