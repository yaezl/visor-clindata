<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HcAplicacionVacunaHc
 * 
 * @property int $id
 * @property int|null $aplicacion_vacuna_id
 * @property int $consulta_id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property string|null $observacion
 * @property Carbon|null $fecha_aplicacion
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property bool $borrado_logico
 * @property int|null $gruporiesgo_id
 * @property Carbon|null $fecha_proxima_dosis
 * 
 * @property HcAplicacionVacuna|null $hc_aplicacion_vacuna
 * @property Consultum $consultum
 * @property Usuario|null $usuario
 * @property AdminGrupoDeRiesgo|null $admin_grupo_de_riesgo
 *
 * @package App\Models
 */
class HcAplicacionVacunaHc extends Model
{
	protected $table = 'hc_aplicacion_vacuna_hc';
	public $timestamps = false;

	protected $casts = [
		'aplicacion_vacuna_id' => 'int',
		'consulta_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'fecha_aplicacion' => 'datetime',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_logico' => 'bool',
		'gruporiesgo_id' => 'int',
		'fecha_proxima_dosis' => 'datetime'
	];

	protected $fillable = [
		'aplicacion_vacuna_id',
		'consulta_id',
		'creado_por_id',
		'modificado_por_id',
		'observacion',
		'fecha_aplicacion',
		'creado_en',
		'modificado_en',
		'borrado_logico',
		'gruporiesgo_id',
		'fecha_proxima_dosis'
	];

	public function hc_aplicacion_vacuna()
	{
		return $this->belongsTo(HcAplicacionVacuna::class, 'aplicacion_vacuna_id');
	}

	public function consultum()
	{
		return $this->belongsTo(Consultum::class, 'consulta_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function admin_grupo_de_riesgo()
	{
		return $this->belongsTo(AdminGrupoDeRiesgo::class, 'gruporiesgo_id');
	}
}
