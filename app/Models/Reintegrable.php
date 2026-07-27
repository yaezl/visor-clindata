<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Reintegrable
 * 
 * @property int $id
 * @property bool $reintegrable
 * 
 * @property Atributo $atributo
 *
 * @package App\Models
 */
class Reintegrable extends Model
{
	protected $table = 'reintegrable';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'reintegrable' => 'bool'
	];

	protected $fillable = [
		'reintegrable'
	];

	public function atributo()
	{
		return $this->belongsTo(Atributo::class, 'id');
	}
}
