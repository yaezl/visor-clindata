<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Impresorafiscal
 * 
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property string $modelo
 * @property string $puerto
 * @property string $host
 * @property Carbon $fecha_cierre_z
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property Carbon $createdAt
 * @property Carbon $modifiedAt
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 * @property Centrodecosto|null $centrodecosto
 *
 * @package App\Models
 */
class Impresorafiscal extends Model
{
	protected $table = 'impresorafiscal';
	public $timestamps = false;

	protected $casts = [
		'fecha_cierre_z' => 'datetime',
		'created_by' => 'int',
		'modified_by' => 'int',
		'createdAt' => 'datetime',
		'modifiedAt' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'descripcion',
		'modelo',
		'puerto',
		'host',
		'fecha_cierre_z',
		'created_by',
		'modified_by',
		'createdAt',
		'modifiedAt',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function centrodecosto()
	{
		return $this->hasOne(Centrodecosto::class, 'impresoraFiscal_id');
	}
}
