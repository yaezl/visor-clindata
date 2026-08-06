<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DiasNoHabile
 * 
 * @property int $id
 * @property Carbon $fecha_inicio
 * @property Carbon $fecha_fin
 * @property Carbon|null $borrado_en
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $eliminado_por_id
 * @property bool $repetir
 * @property string $descripcion
 * @property bool $a_todos
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property int|null $causa_bloqueo_id
 * @property bool $bloqueante
 * @property int|null $criterios_de_reprogramacion_id
 * @property int $fecha_inicio_mes
 * @property int $fecha_inicio_dia
 * @property int $fecha_fin_mes
 * @property int $fecha_fin_dia
 * @property Carbon|null $hora_inicio
 * @property Carbon|null $hora_fin
 * 
 * @property CriteriosDeReprogramacion|null $criterios_de_reprogramacion
 * @property Usuario|null $usuario
 * @property CausaBloqueo|null $causa_bloqueo
 * @property Collection|DiasNoHabilesDow[] $dias_no_habiles_dows
 * @property Collection|DiasnohabilesAsignacion[] $diasnohabiles_asignacions
 *
 * @package App\Models
 */
class DiasNoHabile extends Model
{
	protected $table = 'dias_no_habiles';
	public $timestamps = false;

	protected $casts = [
		'fecha_inicio' => 'datetime',
		'fecha_fin' => 'datetime',
		'borrado_en' => 'datetime',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'eliminado_por_id' => 'int',
		'repetir' => 'bool',
		'a_todos' => 'bool',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'causa_bloqueo_id' => 'int',
		'bloqueante' => 'bool',
		'criterios_de_reprogramacion_id' => 'int',
		'fecha_inicio_mes' => 'int',
		'fecha_inicio_dia' => 'int',
		'fecha_fin_mes' => 'int',
		'fecha_fin_dia' => 'int',
		'hora_inicio' => 'datetime',
		'hora_fin' => 'datetime'
	];

	protected $fillable = [
		'fecha_inicio',
		'fecha_fin',
		'borrado_en',
		'creado_por_id',
		'modificado_por_id',
		'eliminado_por_id',
		'repetir',
		'descripcion',
		'a_todos',
		'creado_en',
		'modificado_en',
		'causa_bloqueo_id',
		'bloqueante',
		'criterios_de_reprogramacion_id',
		'fecha_inicio_mes',
		'fecha_inicio_dia',
		'fecha_fin_mes',
		'fecha_fin_dia',
		'hora_inicio',
		'hora_fin'
	];

	public function criterios_de_reprogramacion()
	{
		return $this->belongsTo(CriteriosDeReprogramacion::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminado_por_id');
	}

	public function causa_bloqueo()
	{
		return $this->belongsTo(CausaBloqueo::class);
	}

	public function dias_no_habiles_dows()
	{
		return $this->hasMany(DiasNoHabilesDow::class, 'dianohabil_id');
	}

	public function diasnohabiles_asignacions()
	{
		return $this->hasMany(DiasnohabilesAsignacion::class, 'diasnohabiles_id');
	}
}
