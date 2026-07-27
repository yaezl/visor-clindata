<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OftalmologiaQueratrometium
 * 
 * @property int $id
 * @property int|null $oftalmologia_id
 * @property string $ojo
 * @property int|null $cornea1
 * @property int|null $cornea2
 * @property int|null $eje1
 * @property int|null $eje2
 * 
 * @property Oftalmologium|null $oftalmologium
 *
 * @package App\Models
 */
class OftalmologiaQueratrometium extends Model
{
	protected $table = 'oftalmologia_queratrometia';
	public $timestamps = false;

	protected $casts = [
		'oftalmologia_id' => 'int',
		'cornea1' => 'int',
		'cornea2' => 'int',
		'eje1' => 'int',
		'eje2' => 'int'
	];

	protected $fillable = [
		'oftalmologia_id',
		'ojo',
		'cornea1',
		'cornea2',
		'eje1',
		'eje2'
	];

	public function oftalmologium()
	{
		return $this->belongsTo(Oftalmologium::class, 'oftalmologia_id');
	}
}
