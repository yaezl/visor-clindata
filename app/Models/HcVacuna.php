<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HcVacuna
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property string $nombre
 * @property string|null $observacion
 * @property bool $es_standard
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property bool $borrado_logico
 * @property int $orden
 * 
 * @property Usuario|null $usuario
 * @property Collection|HcAplicacionVacuna[] $hc_aplicacion_vacunas
 *
 * @package App\Models
 */
class HcVacuna extends Model
{
	protected $table = 'hc_vacuna';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'es_standard' => 'bool',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_logico' => 'bool',
		'orden' => 'int'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'nombre',
		'observacion',
		'es_standard',
		'creado_en',
		'modificado_en',
		'borrado_logico',
		'orden'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function hc_aplicacion_vacunas()
	{
		return $this->hasMany(HcAplicacionVacuna::class, 'vacuna_id');
	}
}
