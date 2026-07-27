<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionDetalleEstudiosInternacion
 * 
 * @property int $id
 * @property int|null $estudio_id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $borrado_por_id
 * @property string $tipoEstudio
 * @property string|null $observaciones
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property bool $borrado_logico
 * @property int|null $estudioLaboratorio_id
 * @property int|null $pruebaLaboratorio_id
 * @property int|null $estudiosInternacion_id
 * @property string|null $urgencia
 * @property string|null $tipoPedido
 * @property Carbon|null $fecha
 * @property string|null $numero_autorizacion
 * 
 * @property Estudio|null $estudio
 * @property AdminEstudiosLaboratorio|null $admin_estudios_laboratorio
 * @property AdminPruebasLaboratorio|null $admin_pruebas_laboratorio
 * @property Usuario|null $usuario
 * @property InternacionEstudiosInternacion|null $internacion_estudios_internacion
 *
 * @package App\Models
 */
class InternacionDetalleEstudiosInternacion extends Model
{
	protected $table = 'internacion_detalle_estudios_internacion';
	public $timestamps = false;

	protected $casts = [
		'estudio_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'borrado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'borrado_logico' => 'bool',
		'estudioLaboratorio_id' => 'int',
		'pruebaLaboratorio_id' => 'int',
		'estudiosInternacion_id' => 'int',
		'fecha' => 'datetime'
	];

	protected $fillable = [
		'estudio_id',
		'creado_por_id',
		'modificado_por_id',
		'borrado_por_id',
		'tipoEstudio',
		'observaciones',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'borrado_logico',
		'estudioLaboratorio_id',
		'pruebaLaboratorio_id',
		'estudiosInternacion_id',
		'urgencia',
		'tipoPedido',
		'fecha',
		'numero_autorizacion'
	];

	public function estudio()
	{
		return $this->belongsTo(Estudio::class);
	}

	public function admin_estudios_laboratorio()
	{
		return $this->belongsTo(AdminEstudiosLaboratorio::class, 'estudioLaboratorio_id');
	}

	public function admin_pruebas_laboratorio()
	{
		return $this->belongsTo(AdminPruebasLaboratorio::class, 'pruebaLaboratorio_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borrado_por_id');
	}

	public function internacion_estudios_internacion()
	{
		return $this->belongsTo(InternacionEstudiosInternacion::class, 'estudiosInternacion_id');
	}
}
