<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MorfologiaDetalle
 * 
 * @property int $id
 * @property int|null $morfologia_id
 * @property int|null $dermatologia_id
 * @property string $observacion
 * 
 * @property Morfologium|null $morfologium
 * @property Dermatologium|null $dermatologium
 *
 * @package App\Models
 */
class MorfologiaDetalle extends Model
{
	protected $table = 'MorfologiaDetalle';
	public $timestamps = false;

	protected $casts = [
		'morfologia_id' => 'int',
		'dermatologia_id' => 'int'
	];

	protected $fillable = [
		'morfologia_id',
		'dermatologia_id',
		'observacion'
	];

	public function morfologium()
	{
		return $this->belongsTo(Morfologium::class, 'morfologia_id');
	}

	public function dermatologium()
	{
		return $this->belongsTo(Dermatologium::class, 'dermatologia_id');
	}
}
