<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminDeployScript
 * 
 * @property int $id
 * @property string $version
 * @property string $nombre
 * @property bool $corrido
 * @property string $codigo_salida
 * @property Carbon $creado_en
 *
 * @package App\Models
 */
class AdminDeployScript extends Model
{
	protected $table = 'admin_deploy_script';
	public $timestamps = false;

	protected $casts = [
		'corrido' => 'bool',
		'creado_en' => 'datetime'
	];

	protected $fillable = [
		'version',
		'nombre',
		'corrido',
		'codigo_salida',
		'creado_en'
	];
}
