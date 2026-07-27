<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrigenDemanda
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property string $descripcion
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 * @property Collection|RudRud[] $rud_ruds
 *
 * @package App\Models
 */
class OrigenDemanda extends Model
{
	protected $table = 'origen_demanda';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'descripcion',
		'creado_en',
		'modificado_en',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function rud_ruds()
	{
		return $this->hasMany(RudRud::class);
	}
}
