<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tiporeporte
 * 
 * @property int $id
 * @property string $nombre
 * @property string|null $codigo
 * 
 * @property Collection|Reporte[] $reportes
 *
 * @package App\Models
 */
class Tiporeporte extends Model
{
	protected $table = 'tiporeporte';
	public $timestamps = false;

	protected $fillable = [
		'nombre',
		'codigo'
	];

	public function reportes()
	{
		return $this->hasMany(Reporte::class, 'tipo_id');
	}
}
