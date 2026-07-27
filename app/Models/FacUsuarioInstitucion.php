<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FacUsuarioInstitucion
 * 
 * @property int $id
 * @property int|null $institucion_id
 * @property int|null $usuario_id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $eliminado_por_id
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * @property bool $borrado_logico
 * 
 * @property Institucion|null $institucion
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class FacUsuarioInstitucion extends Model
{
	protected $table = 'fac_usuario_institucion';
	public $timestamps = false;

	protected $casts = [
		'institucion_id' => 'int',
		'usuario_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'eliminado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'institucion_id',
		'usuario_id',
		'creado_por_id',
		'modificado_por_id',
		'eliminado_por_id',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'borrado_logico'
	];

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminado_por_id');
	}
}
