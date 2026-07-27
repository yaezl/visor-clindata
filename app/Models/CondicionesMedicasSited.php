<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CondicionesMedicasSited
 * 
 * @property int $id
 * @property string $codigo
 * @property string $codigoCIE10
 * @property string $nombre
 * @property Carbon $createdAt
 * @property int $sitedsId
 * 
 * @property Sited $sited
 *
 * @package App\Models
 */
class CondicionesMedicasSited extends Model
{
	protected $table = 'CondicionesMedicasSiteds';
	public $timestamps = false;

	protected $casts = [
		'createdAt' => 'datetime',
		'sitedsId' => 'int'
	];

	protected $fillable = [
		'codigo',
		'codigoCIE10',
		'nombre',
		'createdAt',
		'sitedsId'
	];

	public function sited()
	{
		return $this->belongsTo(Sited::class, 'sitedsId');
	}
}
