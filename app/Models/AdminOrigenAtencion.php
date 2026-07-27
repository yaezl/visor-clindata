<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminOrigenAtencion
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property string $nombre
 * @property string $codigo
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property bool $activo
 * 
 * @property Usuario|null $usuario
 * @property Collection|Articuloprescripto[] $articuloprescriptos
 *
 * @package App\Models
 */
class AdminOrigenAtencion extends Model
{
	protected $table = 'admin_origen_atencion';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'activo' => 'bool'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'nombre',
		'codigo',
		'creado_en',
		'modificado_en',
		'activo'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function articuloprescriptos()
	{
		return $this->hasMany(Articuloprescripto::class, 'origen_atencion_id');
	}
}
