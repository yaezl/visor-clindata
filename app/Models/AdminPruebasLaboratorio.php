<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminPruebasLaboratorio
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $borrado_por_id
 * @property string $codigo
 * @property string $nombre
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property bool $borrado_logico
 * @property int|null $estudiosLaboratorio_id
 * 
 * @property Usuario|null $usuario
 * @property AdminEstudiosLaboratorio|null $admin_estudios_laboratorio
 * @property Collection|InternacionDetalleEstudiosInternacion[] $internacion_detalle_estudios_internacions
 *
 * @package App\Models
 */
class AdminPruebasLaboratorio extends Model
{
	protected $table = 'admin_pruebas_laboratorio';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'borrado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'borrado_logico' => 'bool',
		'estudiosLaboratorio_id' => 'int'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'borrado_por_id',
		'codigo',
		'nombre',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'borrado_logico',
		'estudiosLaboratorio_id'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borrado_por_id');
	}

	public function admin_estudios_laboratorio()
	{
		return $this->belongsTo(AdminEstudiosLaboratorio::class, 'estudiosLaboratorio_id');
	}

	public function internacion_detalle_estudios_internacions()
	{
		return $this->hasMany(InternacionDetalleEstudiosInternacion::class, 'pruebaLaboratorio_id');
	}
}
