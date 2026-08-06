<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SuministrosProyecto
 * 
 * @property int $id
 * @property int|null $centro_de_costo_id
 * @property int|null $grupo_id
 * @property int|null $institucion_id
 * @property int|null $programa_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $borradopor_id
 * @property string $nombre
 * @property string|null $nombre_completo
 * @property string $numero
 * @property string|null $cdu
 * @property string|null $descripcion
 * @property Carbon|null $fecha_inicio
 * @property Carbon|null $fecha_finalizacion
 * @property Carbon|null $fecha_revision
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property bool $borrado_logico
 * @property bool $activa
 * 
 * @property Institucion|null $institucion
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class SuministrosProyecto extends Model
{
	protected $table = 'suministros_proyecto';
	public $timestamps = false;

	protected $casts = [
		'centro_de_costo_id' => 'int',
		'grupo_id' => 'int',
		'institucion_id' => 'int',
		'programa_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'borradopor_id' => 'int',
		'fecha_inicio' => 'datetime',
		'fecha_finalizacion' => 'datetime',
		'fecha_revision' => 'datetime',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'borrado_logico' => 'bool',
		'activa' => 'bool'
	];

	protected $fillable = [
		'centro_de_costo_id',
		'grupo_id',
		'institucion_id',
		'programa_id',
		'creadopor_id',
		'modificadopor_id',
		'borradopor_id',
		'nombre',
		'nombre_completo',
		'numero',
		'cdu',
		'descripcion',
		'fecha_inicio',
		'fecha_finalizacion',
		'fecha_revision',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'borrado_logico',
		'activa'
	];

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borradopor_id');
	}
}
