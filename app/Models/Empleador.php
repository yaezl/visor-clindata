<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Empleador
 * 
 * @property int $id
 * @property int|null $direccion_id
 * @property string $nombre
 * @property string|null $codigo
 * @property string $cuit
 * @property string|null $telefono
 * @property string|null $email
 * @property string|null $observaciones
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property int|null $condicion_iva
 * @property bool $borrado_logico
 * 
 * @property Usuario $usuario
 * @property Direccion|null $direccion
 * @property Collection|Empleadorcuentum[] $empleadorcuenta
 * @property Collection|ModalidadCoberturaSited[] $modalidad_cobertura_siteds
 * @property Collection|Persona[] $personas
 * @property Collection|PersonaTipoContribuyente[] $persona_tipo_contribuyentes
 * @property Collection|PersonaTrabajo[] $persona_trabajos
 * @property Collection|RudSeguimientoObraPublica[] $rud_seguimiento_obra_publicas
 *
 * @package App\Models
 */
class Empleador extends Model
{
	protected $table = 'empleador';

	protected $casts = [
		'direccion_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'condicion_iva' => 'int',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'direccion_id',
		'nombre',
		'codigo',
		'cuit',
		'telefono',
		'email',
		'observaciones',
		'created_by',
		'modified_by',
		'condicion_iva',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function condicion_iva()
	{
		return $this->belongsTo(CondicionIva::class, 'condicion_iva');
	}

	public function direccion()
	{
		return $this->belongsTo(Direccion::class);
	}

	public function empleadorcuenta()
	{
		return $this->hasMany(Empleadorcuentum::class);
	}

	public function modalidad_cobertura_siteds()
	{
		return $this->hasMany(ModalidadCoberturaSited::class, 'empleador');
	}

	public function personas()
	{
		return $this->hasMany(Persona::class);
	}

	public function persona_tipo_contribuyentes()
	{
		return $this->hasMany(PersonaTipoContribuyente::class);
	}

	public function persona_trabajos()
	{
		return $this->hasMany(PersonaTrabajo::class);
	}

	public function rud_seguimiento_obra_publicas()
	{
		return $this->hasMany(RudSeguimientoObraPublica::class, 'empresa_id');
	}
}
