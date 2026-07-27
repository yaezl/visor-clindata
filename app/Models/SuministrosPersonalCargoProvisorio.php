<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SuministrosPersonalCargoProvisorio
 * 
 * @property int $id
 * @property int|null $personal_id
 * @property int|null $personalreemplazado_id
 * @property int|null $institucion_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $borradopor_id
 * @property Carbon|null $fecha_desde
 * @property Carbon|null $fecha_hasta
 * @property string|null $descripcion
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property bool $borrado_logico
 * 
 * @property Personal|null $personal
 * @property Institucion|null $institucion
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class SuministrosPersonalCargoProvisorio extends Model
{
	protected $table = 'suministros_personal_cargo_provisorio';
	public $timestamps = false;

	protected $casts = [
		'personal_id' => 'int',
		'personalreemplazado_id' => 'int',
		'institucion_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'borradopor_id' => 'int',
		'fecha_desde' => 'datetime',
		'fecha_hasta' => 'datetime',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'personal_id',
		'personalreemplazado_id',
		'institucion_id',
		'creadopor_id',
		'modificadopor_id',
		'borradopor_id',
		'fecha_desde',
		'fecha_hasta',
		'descripcion',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'borrado_logico'
	];

	public function personal()
	{
		return $this->belongsTo(Personal::class, 'personalreemplazado_id');
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borradopor_id');
	}
}
