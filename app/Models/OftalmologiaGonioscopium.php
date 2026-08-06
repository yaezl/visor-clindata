<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OftalmologiaGonioscopium
 * 
 * @property int $id
 * @property int|null $oftalmologia_id
 * @property string $ojo
 * @property int|null $grado_angulo1
 * @property int|null $grado_angulo2
 * @property int|null $grado_angulo3
 * @property int|null $grado_angulo4
 * 
 * @property Oftalmologium|null $oftalmologium
 *
 * @package App\Models
 */
class OftalmologiaGonioscopium extends Model
{
	protected $table = 'oftalmologia_gonioscopia';
	public $timestamps = false;

	protected $casts = [
		'oftalmologia_id' => 'int',
		'grado_angulo1' => 'int',
		'grado_angulo2' => 'int',
		'grado_angulo3' => 'int',
		'grado_angulo4' => 'int'
	];

	protected $fillable = [
		'oftalmologia_id',
		'ojo',
		'grado_angulo1',
		'grado_angulo2',
		'grado_angulo3',
		'grado_angulo4'
	];

	public function oftalmologium()
	{
		return $this->belongsTo(Oftalmologium::class, 'oftalmologia_id');
	}
}
