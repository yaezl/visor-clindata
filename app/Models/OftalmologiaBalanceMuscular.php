<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OftalmologiaBalanceMuscular
 * 
 * @property int $id
 * @property int|null $oftalmologia_id
 * @property string $ojo
 * @property int|null $balance1
 * @property int|null $balance2
 * @property int|null $balance3
 * @property int|null $balance4
 * @property int|null $balance5
 * @property int|null $balance6
 * @property int|null $balance7
 * @property int|null $balance8
 * @property int|null $balance9
 * 
 * @property Oftalmologium|null $oftalmologium
 *
 * @package App\Models
 */
class OftalmologiaBalanceMuscular extends Model
{
	protected $table = 'oftalmologia_balance_muscular';
	public $timestamps = false;

	protected $casts = [
		'oftalmologia_id' => 'int',
		'balance1' => 'int',
		'balance2' => 'int',
		'balance3' => 'int',
		'balance4' => 'int',
		'balance5' => 'int',
		'balance6' => 'int',
		'balance7' => 'int',
		'balance8' => 'int',
		'balance9' => 'int'
	];

	protected $fillable = [
		'oftalmologia_id',
		'ojo',
		'balance1',
		'balance2',
		'balance3',
		'balance4',
		'balance5',
		'balance6',
		'balance7',
		'balance8',
		'balance9'
	];

	public function oftalmologium()
	{
		return $this->belongsTo(Oftalmologium::class, 'oftalmologia_id');
	}
}
