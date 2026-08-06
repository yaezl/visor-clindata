<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExtensionVigenciaSited
 * 
 * @property int $id
 * @property int $creadopor_id
 * @property Carbon $fechaFinVigenciaOriginal
 * @property Carbon $fechaFinVigenciaExtendida
 * @property bool $borrado_logico
 * @property Carbon $createdAt
 * @property int $sitedsId
 * 
 * @property Sited $sited
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class ExtensionVigenciaSited extends Model
{
	protected $table = 'ExtensionVigenciaSiteds';
	public $timestamps = false;

	protected $casts = [
		'creadopor_id' => 'int',
		'fechaFinVigenciaOriginal' => 'datetime',
		'fechaFinVigenciaExtendida' => 'datetime',
		'borrado_logico' => 'bool',
		'createdAt' => 'datetime',
		'sitedsId' => 'int'
	];

	protected $fillable = [
		'creadopor_id',
		'fechaFinVigenciaOriginal',
		'fechaFinVigenciaExtendida',
		'borrado_logico',
		'createdAt',
		'sitedsId'
	];

	public function sited()
	{
		return $this->belongsTo(Sited::class, 'sitedsId');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'creadopor_id');
	}
}
