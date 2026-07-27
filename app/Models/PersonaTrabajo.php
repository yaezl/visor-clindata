<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PersonaTrabajo
 * 
 * @property int $id
 * @property int|null $persona_id
 * @property int|null $empleador_id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $eliminado_por_id
 * @property string|null $ocupacion
 * @property int|null $hsfueracasa
 * @property int|null $trabajoRemunerado
 * @property int|null $horarioTrabajo
 * @property int|null $tipoOcupacion
 * @property int|null $trabajoLegal
 * @property int|null $trabajoInsalubre
 * @property int|null $edadInicio
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * 
 * @property Persona|null $persona
 * @property Empleador|null $empleador
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class PersonaTrabajo extends Model
{
	protected $table = 'persona_trabajo';
	public $timestamps = false;

	protected $casts = [
		'persona_id' => 'int',
		'empleador_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'eliminado_por_id' => 'int',
		'hsfueracasa' => 'int',
		'trabajoRemunerado' => 'int',
		'horarioTrabajo' => 'int',
		'tipoOcupacion' => 'int',
		'trabajoLegal' => 'int',
		'trabajoInsalubre' => 'int',
		'edadInicio' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime'
	];

	protected $fillable = [
		'persona_id',
		'empleador_id',
		'creado_por_id',
		'modificado_por_id',
		'eliminado_por_id',
		'ocupacion',
		'hsfueracasa',
		'trabajoRemunerado',
		'horarioTrabajo',
		'tipoOcupacion',
		'trabajoLegal',
		'trabajoInsalubre',
		'edadInicio',
		'creado_en',
		'modificado_en',
		'borrado_en'
	];

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function empleador()
	{
		return $this->belongsTo(Empleador::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminado_por_id');
	}
}
