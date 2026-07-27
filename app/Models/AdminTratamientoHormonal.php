<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminTratamientoHormonal
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property string $codigo
 * @property string $nombre
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 * @property Collection|ConsultaMedicionGinecologium[] $consulta_medicion_ginecologia
 *
 * @package App\Models
 */
class AdminTratamientoHormonal extends Model
{
	protected $table = 'admin_tratamiento_hormonal';
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
		'codigo',
		'nombre',
		'creado_en',
		'modificado_en',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function consulta_medicion_ginecologia()
	{
		return $this->hasMany(ConsultaMedicionGinecologium::class, 'tratamiento_hormonal_id');
	}
}
