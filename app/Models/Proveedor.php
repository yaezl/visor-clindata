<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Proveedor
 * 
 * @property int $id
 * @property string $nombre
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $eliminado_por_id
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * @property bool $borrado_logico
 * @property int|null $direccion_id
 * @property string $nombre_contacto
 * @property string $email_contacto
 * @property string $telefono_contacto
 * @property string $fax_contacto
 * @property string $cuit_contacto
 * @property string $oficina_contacto
 * @property string|null $observaciones
 * @property string|null $codigoIntegracion
 * 
 * @property Usuario|null $usuario
 * @property Direccion|null $direccion
 * @property Proveedorcuentum|null $proveedorcuentum
 *
 * @package App\Models
 */
class Proveedor extends Model
{
	protected $table = 'proveedor';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'eliminado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'borrado_logico' => 'bool',
		'direccion_id' => 'int'
	];

	protected $fillable = [
		'nombre',
		'creado_por_id',
		'modificado_por_id',
		'eliminado_por_id',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'borrado_logico',
		'direccion_id',
		'nombre_contacto',
		'email_contacto',
		'telefono_contacto',
		'fax_contacto',
		'cuit_contacto',
		'oficina_contacto',
		'observaciones',
		'codigoIntegracion'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminado_por_id');
	}

	public function direccion()
	{
		return $this->belongsTo(Direccion::class);
	}

	public function proveedorcuentum()
	{
		return $this->hasOne(Proveedorcuentum::class);
	}
}
