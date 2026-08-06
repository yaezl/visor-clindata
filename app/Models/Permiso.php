<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Permiso
 * 
 * @property int $id
 * @property int $feature_id
 * @property string $nombre
 * @property string $descripcion
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property bool|null $menu_lateral
 * @property bool|null $menu_superior
 * @property string $codigo
 * 
 * @property Feature $feature
 * @property Collection|Usuario[] $usuarios
 * @property Collection|AutorizacionesAprobacion[] $autorizaciones_aprobacions
 * @property Collection|AutorizacionesEstado[] $autorizaciones_estados
 * @property Collection|HcHerramienta[] $hc_herramientas
 * @property Collection|Perfil[] $perfils
 * @property Collection|Almacen[] $almacens
 * @property Collection|Estudio[] $estudios
 * @property Collection|Especialidad[] $especialidads
 *
 * @package App\Models
 */
class Permiso extends Model
{
	use SoftDeletes;
	protected $table = 'permiso';

	protected $casts = [
		'feature_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'menu_lateral' => 'bool',
		'menu_superior' => 'bool'
	];

	protected $fillable = [
		'feature_id',
		'nombre',
		'descripcion',
		'created_by',
		'modified_by',
		'deleted_by',
		'menu_lateral',
		'menu_superior',
		'codigo'
	];

	public function feature()
	{
		return $this->belongsTo(Feature::class);
	}

	public function usuarios()
	{
		return $this->belongsToMany(Usuario::class, 'admin_permiso_usuario', 'permiso_id', 'modificado_por_id')
					->withPivot('id', 'usuario_id', 'creado_por_id');
	}

	public function autorizaciones_aprobacions()
	{
		return $this->hasMany(AutorizacionesAprobacion::class);
	}

	public function autorizaciones_estados()
	{
		return $this->hasMany(AutorizacionesEstado::class);
	}

	public function hc_herramientas()
	{
		return $this->hasMany(HcHerramienta::class, 'permiso_boton');
	}

	public function perfils()
	{
		return $this->belongsToMany(Perfil::class);
	}

	public function almacens()
	{
		return $this->belongsToMany(Almacen::class, 'permiso_almacen_distribuye')
					->withPivot('id', 'usuario_id', 'creadopor_id', 'modificadopor_id', 'creado_en', 'modificado_en', 'borrado_logico');
	}

	public function estudios()
	{
		return $this->belongsToMany(Estudio::class, 'permiso_bloqueo_estudio')
					->withPivot('id', 'creadopor_id', 'modificadopor_id', 'creado_en', 'modificado_en');
	}

	public function especialidads()
	{
		return $this->belongsToMany(Especialidad::class, 'permisoturno_especialidad')
					->withPivot('id', 'creadopor_id', 'modificadopor_id', 'borradopor_id', 'creado_en', 'modificado_en', 'borrado_en');
	}
}
