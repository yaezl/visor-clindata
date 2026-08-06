<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HistoricoLogin
 * 
 * @property int $id
 * @property int|null $usuario_id
 * @property Carbon $login_at
 * @property Carbon|null $logout_at
 * @property string|null $ciSession
 * 
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class HistoricoLogin extends Model
{
	protected $table = 'historico_login';
	public $timestamps = false;

	protected $casts = [
		'usuario_id' => 'int',
		'login_at' => 'datetime',
		'logout_at' => 'datetime'
	];

	protected $fillable = [
		'usuario_id',
		'login_at',
		'logout_at',
		'ciSession'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}
}
