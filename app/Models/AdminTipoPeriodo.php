<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminTipoPeriodo
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property string $codigo
 * @property string $descripcion
 * @property string $plural
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * 
 * @property Usuario|null $usuario
 * @property Collection|AdminConfiguracionTemporal[] $admin_configuracion_temporals
 *
 * @package App\Models
 */
class AdminTipoPeriodo extends Model
{
	protected $table = 'admin_tipo_periodo';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'codigo',
		'descripcion',
		'plural',
		'creado_en',
		'modificado_en'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function admin_configuracion_temporals()
	{
		return $this->hasMany(AdminConfiguracionTemporal::class, 'tipo_periodo_id');
	}
}
