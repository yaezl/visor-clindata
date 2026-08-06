<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionRol
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $borrado_por_id
 * @property string $nombre
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property string|null $codigo
 * 
 * @property Usuario|null $usuario
 * @property Collection|InternacionProfesionalPq[] $internacion_profesional_pqs
 * @property Collection|ReservaQuirofanoProfesional[] $reserva_quirofano_profesionals
 *
 * @package App\Models
 */
class InternacionRol extends Model
{
	protected $table = 'internacion_rol';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'borrado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'borrado_por_id',
		'nombre',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'codigo'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borrado_por_id');
	}

	public function internacion_profesional_pqs()
	{
		return $this->hasMany(InternacionProfesionalPq::class, 'rol_id');
	}

	public function reserva_quirofano_profesionals()
	{
		return $this->hasMany(ReservaQuirofanoProfesional::class, 'rol_id');
	}
}
