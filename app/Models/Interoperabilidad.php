<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Interoperabilidad
 * 
 * @property int $id
 * @property string $entityClass
 * @property string $entityId
 * @property string $externalSystem
 * @property string $data
 *
 * @package App\Models
 */
class Interoperabilidad extends Model
{
	protected $table = 'Interoperabilidad';
	public $timestamps = false;

	protected $fillable = [
		'entityClass',
		'entityId',
		'externalSystem',
		'data'
	];
}
