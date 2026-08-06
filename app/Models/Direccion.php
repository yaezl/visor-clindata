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
 * Class Direccion
 * 
 * @property int $id
 * @property int|null $barrio_id
 * @property int|null $ciudad_id
 * @property int|null $provincia_id
 * @property int|null $pais_id
 * @property string $calle
 * @property string|null $nro
 * @property string|null $piso
 * @property string|null $depto
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property string|null $codigo_calle
 * @property string|null $nombre_calle_callejero
 * @property int|null $georeferencia_id
 * @property int|null $partido_id
 * 
 * @property Partido|null $partido
 * @property Usuario $usuario
 * @property Barrio|null $barrio
 * @property Ciudad|null $ciudad
 * @property Provincium|null $provincium
 * @property Pai|null $pai
 * @property Georeferencium|null $georeferencium
 * @property Consultum|null $consultum
 * @property Empleador|null $empleador
 * @property Institucion|null $institucion
 * @property ObraSocial|null $obra_social
 * @property Persona|null $persona
 * @property Prestador|null $prestador
 * @property Proveedor|null $proveedor
 * @property Collection|RudRud[] $rud_ruds
 * @property SuministrosProveedor|null $suministros_proveedor
 *
 * @package App\Models
 */
class Direccion extends Model
{
	use SoftDeletes;
	protected $table = 'direccion';

	protected $casts = [
		'barrio_id' => 'int',
		'ciudad_id' => 'int',
		'provincia_id' => 'int',
		'pais_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'georeferencia_id' => 'int',
		'partido_id' => 'int'
	];

	protected $fillable = [
		'barrio_id',
		'ciudad_id',
		'provincia_id',
		'pais_id',
		'calle',
		'nro',
		'piso',
		'depto',
		'created_by',
		'modified_by',
		'deleted_by',
		'codigo_calle',
		'nombre_calle_callejero',
		'georeferencia_id',
		'partido_id'
	];

	public function partido()
	{
		return $this->belongsTo(Partido::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modified_by');
	}

	public function barrio()
	{
		return $this->belongsTo(Barrio::class);
	}

	public function ciudad()
	{
		return $this->belongsTo(Ciudad::class);
	}

	public function provincium()
	{
		return $this->belongsTo(Provincium::class, 'provincia_id');
	}

	public function pai()
	{
		return $this->belongsTo(Pai::class, 'pais_id');
	}

	public function georeferencium()
	{
		return $this->belongsTo(Georeferencium::class, 'georeferencia_id');
	}

	public function consultum()
	{
		return $this->hasOne(Consultum::class);
	}

	public function empleador()
	{
		return $this->hasOne(Empleador::class);
	}

	public function institucion()
	{
		return $this->hasOne(Institucion::class);
	}

	public function obra_social()
	{
		return $this->hasOne(ObraSocial::class, 'direccion_facturacion_id');
	}

	public function persona()
	{
		return $this->hasOne(Persona::class);
	}

	public function prestador()
	{
		return $this->hasOne(Prestador::class);
	}

	public function proveedor()
	{
		return $this->hasOne(Proveedor::class);
	}

	public function rud_ruds()
	{
		return $this->hasMany(RudRud::class);
	}

	public function suministros_proveedor()
	{
		return $this->hasOne(SuministrosProveedor::class);
	}
}
