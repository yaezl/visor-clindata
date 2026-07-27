<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SuministrosProveedor
 * 
 * @property int $id
 * @property int|null $direccion_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $eliminadopor_id
 * @property string $nombre
 * @property string|null $cuit
 * @property string|null $iva
 * @property string|null $email
 * @property string|null $descripcion
 * @property string|null $telefono
 * @property string|null $celular
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * 
 * @property Direccion|null $direccion
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class SuministrosProveedor extends Model
{
	protected $table = 'suministros_proveedor';
	public $timestamps = false;

	protected $casts = [
		'direccion_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'eliminadopor_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime'
	];

	protected $fillable = [
		'direccion_id',
		'creadopor_id',
		'modificadopor_id',
		'eliminadopor_id',
		'nombre',
		'cuit',
		'iva',
		'email',
		'descripcion',
		'telefono',
		'celular',
		'creado_en',
		'modificado_en',
		'borrado_en'
	];

	public function direccion()
	{
		return $this->belongsTo(Direccion::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminadopor_id');
	}
}
