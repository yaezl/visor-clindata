<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Familiarelacion
 * 
 * @property int $id
 * @property int|null $familia_id
 * @property int|null $individuo1_id
 * @property int|null $individuo2_id
 * @property int|null $rol_individuo1_id
 * @property int|null $rol_individuo2_id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $eliminado_por_id
 * @property string $nombre
 * @property bool $conviviente
 * @property Carbon $fecha_inicio_relacion
 * @property Carbon|null $fecha_fin_relacion
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * @property string|null $observaciones
 * @property bool|null $riesgopsicosocial
 * @property bool|null $apoderado
 * 
 * @property Familium|null $familium
 * @property Persona|null $persona
 * @property Familiarol|null $familiarol
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class Familiarelacion extends Model
{
	protected $table = 'familiarelacion';
	public $timestamps = false;

	protected $casts = [
		'familia_id' => 'int',
		'individuo1_id' => 'int',
		'individuo2_id' => 'int',
		'rol_individuo1_id' => 'int',
		'rol_individuo2_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'eliminado_por_id' => 'int',
		'conviviente' => 'bool',
		'fecha_inicio_relacion' => 'datetime',
		'fecha_fin_relacion' => 'datetime',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'riesgopsicosocial' => 'bool',
		'apoderado' => 'bool'
	];

	protected $fillable = [
		'familia_id',
		'individuo1_id',
		'individuo2_id',
		'rol_individuo1_id',
		'rol_individuo2_id',
		'creado_por_id',
		'modificado_por_id',
		'eliminado_por_id',
		'nombre',
		'conviviente',
		'fecha_inicio_relacion',
		'fecha_fin_relacion',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'observaciones',
		'riesgopsicosocial',
		'apoderado'
	];

	public function familium()
	{
		return $this->belongsTo(Familium::class, 'familia_id');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class, 'individuo2_id');
	}

	public function familiarol()
	{
		return $this->belongsTo(Familiarol::class, 'rol_individuo2_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminado_por_id');
	}
}
