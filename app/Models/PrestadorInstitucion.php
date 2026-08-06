<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PrestadorInstitucion
 * 
 * @property int $id
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property int|null $prestador_id
 * @property int|null $institucion_id
 * @property string $nombre
 * @property Carbon $created_at
 * @property Carbon $modified_at
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 * @property Institucion|null $institucion
 * @property Prestador|null $prestador
 * @property Collection|ConvenioPrestador[] $convenio_prestadors
 * @property Collection|PrestadorinstitucionPractica[] $prestadorinstitucion_practicas
 *
 * @package App\Models
 */
class PrestadorInstitucion extends Model
{
	protected $table = 'prestador_institucion';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'prestador_id' => 'int',
		'institucion_id' => 'int',
		'modified_at' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'prestador_id',
		'institucion_id',
		'nombre',
		'modified_at',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function prestador()
	{
		return $this->belongsTo(Prestador::class);
	}

	public function convenio_prestadors()
	{
		return $this->hasMany(ConvenioPrestador::class, 'prestadorInstitucion_id');
	}

	public function prestadorinstitucion_practicas()
	{
		return $this->hasMany(PrestadorinstitucionPractica::class, 'prestadorinstitucion_id');
	}
}
