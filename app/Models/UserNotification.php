<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserNotification
 * 
 * @property int $id
 * @property int $usuario_id
 * @property string $message
 * @property bool $readed
 * @property Carbon $created_at
 * 
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class UserNotification extends Model
{
	protected $table = 'user_notification';
	public $timestamps = false;

	protected $casts = [
		'usuario_id' => 'int',
		'readed' => 'bool'
	];

	protected $fillable = [
		'usuario_id',
		'message',
		'readed'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}
}
