<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionPerfilEstudiosLabo
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $borrado_por_id
 * @property string $nombre
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property bool $borrado_logico
 * @property bool $top_ordenes
 * 
 * @property Usuario|null $usuario
 * @property Collection|InternacionPerfilEstudiosLaboratorio[] $internacion_perfil_estudios_laboratorios
 *
 * @package App\Models
 */
class InternacionPerfilEstudiosLabo extends Model
{
	protected $table = 'internacion_perfil_estudios_labo';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'borrado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'borrado_logico' => 'bool',
		'top_ordenes' => 'bool'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'borrado_por_id',
		'nombre',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'borrado_logico',
		'top_ordenes'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borrado_por_id');
	}

	public function internacion_perfil_estudios_laboratorios()
	{
		return $this->hasMany(InternacionPerfilEstudiosLaboratorio::class);
	}
}
