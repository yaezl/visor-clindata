<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Prestador
 * 
 * @property int $id
 * @property int|null $direccion_id
 * @property int|null $direccion_cobranza_id
 * @property int|null $direccion_facturacion_id
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property string $nombre
 * @property string|null $denominacion
 * @property string $telefono
 * @property string $cuit
 * @property string $iva
 * @property string $email
 * @property string $nombre_contacto
 * @property string $email_contacto
 * @property string $telefono_contacto
 * @property string $fax_contacto
 * @property string $oficina_contacto
 * @property string $nombre_en_factura
 * @property Carbon $created_at
 * @property Carbon $modified_at
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 * @property Direccion|null $direccion
 * @property Collection|AutorizacionesAuditoriaEstado[] $autorizaciones_auditoria_estados
 * @property Collection|Institucion[] $institucions
 * @property Collection|Prestadorcuentum[] $prestadorcuenta
 *
 * @package App\Models
 */
class Prestador extends Model
{
	protected $table = 'prestador';
	public $timestamps = false;

	protected $casts = [
		'direccion_id' => 'int',
		'direccion_cobranza_id' => 'int',
		'direccion_facturacion_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'modified_at' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'direccion_id',
		'direccion_cobranza_id',
		'direccion_facturacion_id',
		'created_by',
		'modified_by',
		'nombre',
		'denominacion',
		'telefono',
		'cuit',
		'iva',
		'email',
		'nombre_contacto',
		'email_contacto',
		'telefono_contacto',
		'fax_contacto',
		'oficina_contacto',
		'nombre_en_factura',
		'modified_at',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function direccion()
	{
		return $this->belongsTo(Direccion::class);
	}

	public function autorizaciones_auditoria_estados()
	{
		return $this->hasMany(AutorizacionesAuditoriaEstado::class);
	}

	public function institucions()
	{
		return $this->belongsToMany(Institucion::class, 'prestador_institucion')
					->withPivot('id', 'created_by', 'modified_by', 'nombre', 'modified_at', 'borrado_logico');
	}

	public function prestadorcuenta()
	{
		return $this->hasMany(Prestadorcuentum::class);
	}
}
