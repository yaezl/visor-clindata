<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CausaBloqueo
 * 
 * @property int $id
 * @property string $codigo
 * @property string $descripcion
 * @property string|null $detalle
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 * @property Collection|DiasNoHabile[] $dias_no_habiles
 *
 * @package App\Models
 */
class CausaBloqueo extends Model
{
	protected $table = 'causa_bloqueo';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'codigo',
		'descripcion',
		'detalle',
		'creado_por_id',
		'modificado_por_id',
		'creado_en',
		'modificado_en',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function dias_no_habiles()
	{
		return $this->hasMany(DiasNoHabile::class);
	}
}
