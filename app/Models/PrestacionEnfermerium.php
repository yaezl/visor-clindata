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
 * Class PrestacionEnfermerium
 * 
 * @property int $id
 * @property int|null $prestacion_id
 * @property int|null $tipopractica_id
 * @property string $nombre
 * @property string|null $sinonimo
 * @property string|null $preparacion
 * @property string|null $codigo
 * @property string|null $tipo
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property bool $borrado_logico
 * 
 * @property Prestacion|null $prestacion
 * @property Tipopractica|null $tipopractica
 * @property Collection|EnfermeriaPrestacionEnfermerium[] $enfermeria_prestacion_enfermeria
 * @property Collection|PrestacionEnfermeriaPrestacion[] $prestacion_enfermeria_prestacions
 *
 * @package App\Models
 */
class PrestacionEnfermerium extends Model
{
	use SoftDeletes;
	protected $table = 'prestacion_enfermeria';

	protected $casts = [
		'prestacion_id' => 'int',
		'tipopractica_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'prestacion_id',
		'tipopractica_id',
		'nombre',
		'sinonimo',
		'preparacion',
		'codigo',
		'tipo',
		'created_by',
		'modified_by',
		'deleted_by',
		'borrado_logico'
	];

	public function prestacion()
	{
		return $this->belongsTo(Prestacion::class);
	}

	public function tipopractica()
	{
		return $this->belongsTo(Tipopractica::class);
	}

	public function enfermeria_prestacion_enfermeria()
	{
		return $this->hasMany(EnfermeriaPrestacionEnfermerium::class, 'prestacion_enfermeria_id');
	}

	public function prestacion_enfermeria_prestacions()
	{
		return $this->hasMany(PrestacionEnfermeriaPrestacion::class, 'prestacion_enfermeria_id');
	}
}
