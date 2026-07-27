<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Convenio
 * 
 * @property int $id
 * @property string $nombre
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property Carbon $inicio_vigencia
 * @property Carbon $fin_vigencia
 * @property bool $borrado_logico
 * 
 * @property Collection|ConvenioPlan[] $convenio_plans
 * @property Collection|ConvenioPrestador[] $convenio_prestadors
 * @property Collection|ModulosFacturacion[] $modulos_facturacions
 * @property Nomenclador|null $nomenclador
 * @property Collection|Prestacion[] $prestacions
 *
 * @package App\Models
 */
class Convenio extends Model
{
	use SoftDeletes;
	protected $table = 'convenio';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'inicio_vigencia' => 'datetime',
		'fin_vigencia' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'created_by',
		'modified_by',
		'deleted_by',
		'inicio_vigencia',
		'fin_vigencia',
		'borrado_logico'
	];

	public function convenio_plans()
	{
		return $this->hasMany(ConvenioPlan::class);
	}

	public function convenio_prestadors()
	{
		return $this->hasMany(ConvenioPrestador::class);
	}

	public function modulos_facturacions()
	{
		return $this->hasMany(ModulosFacturacion::class, 'convenioId');
	}

	public function nomenclador()
	{
		return $this->hasOne(Nomenclador::class);
	}

	public function prestacions()
	{
		return $this->belongsToMany(Prestacion::class, 'registro_cambio_prestacion_convenio')
					->withPivot('id', 'createdBy');
	}
}
