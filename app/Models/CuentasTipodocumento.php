<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CuentasTipodocumento
 * 
 * @property int $id
 * @property string $nombre
 * @property string|null $codigo
 * 
 * @property Collection|Documento[] $documentos
 *
 * @package App\Models
 */
class CuentasTipodocumento extends Model
{
	protected $table = 'cuentas_tipodocumento';
	public $timestamps = false;

	protected $fillable = [
		'nombre',
		'codigo'
	];

	public function documentos()
	{
		return $this->hasMany(Documento::class, 'tipodocumento_id');
	}
}
