<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminAmbitoHecho
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property string $nombre
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property bool $borrado_logico
 * @property bool $es_publico
 * 
 * @property Usuario|null $usuario
 * @property Collection|RudRud[] $rud_ruds
 *
 * @package App\Models
 */
class AdminAmbitoHecho extends Model
{
	protected $table = 'admin_ambito_hecho';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'borrado_logico' => 'bool',
		'es_publico' => 'bool'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'nombre',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'borrado_logico',
		'es_publico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function rud_ruds()
	{
		return $this->hasMany(RudRud::class, 'ambitodelhecho_id');
	}
}
