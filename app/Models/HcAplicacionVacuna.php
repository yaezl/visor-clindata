<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HcAplicacionVacuna
 * 
 * @property int $id
 * @property int|null $tipo_aplicacion_vacuna_id
 * @property int|null $vacuna_id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $configuracion_temporal_id
 * @property string|null $observacion
 * @property bool $es_obligatoria
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property bool $borrado_logico
 * @property int $desde
 * @property int $hasta
 * 
 * @property HcTipoAplicacionVacuna|null $hc_tipo_aplicacion_vacuna
 * @property HcVacuna|null $hc_vacuna
 * @property Usuario|null $usuario
 * @property AdminConfiguracionTemporal|null $admin_configuracion_temporal
 * @property Collection|CrmVacunaNotificacion[] $crm_vacuna_notificacions
 * @property Collection|HcAplicacionVacunaHc[] $hc_aplicacion_vacuna_hcs
 *
 * @package App\Models
 */
class HcAplicacionVacuna extends Model
{
	protected $table = 'hc_aplicacion_vacuna';
	public $timestamps = false;

	protected $casts = [
		'tipo_aplicacion_vacuna_id' => 'int',
		'vacuna_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'configuracion_temporal_id' => 'int',
		'es_obligatoria' => 'bool',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_logico' => 'bool',
		'desde' => 'int',
		'hasta' => 'int'
	];

	protected $fillable = [
		'tipo_aplicacion_vacuna_id',
		'vacuna_id',
		'creado_por_id',
		'modificado_por_id',
		'configuracion_temporal_id',
		'observacion',
		'es_obligatoria',
		'creado_en',
		'modificado_en',
		'borrado_logico',
		'desde',
		'hasta'
	];

	public function hc_tipo_aplicacion_vacuna()
	{
		return $this->belongsTo(HcTipoAplicacionVacuna::class, 'tipo_aplicacion_vacuna_id');
	}

	public function hc_vacuna()
	{
		return $this->belongsTo(HcVacuna::class, 'vacuna_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function admin_configuracion_temporal()
	{
		return $this->belongsTo(AdminConfiguracionTemporal::class, 'configuracion_temporal_id');
	}

	public function crm_vacuna_notificacions()
	{
		return $this->hasMany(CrmVacunaNotificacion::class, 'aplicacion_vacuna_id');
	}

	public function hc_aplicacion_vacuna_hcs()
	{
		return $this->hasMany(HcAplicacionVacunaHc::class, 'aplicacion_vacuna_id');
	}
}
