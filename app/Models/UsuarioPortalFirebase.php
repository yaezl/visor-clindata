<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UsuarioPortalFirebase
 * 
 * @property int $id
 * @property string $email_fbase
 * @property string|null $uid
 * 
 * @property UsuarioPortal $usuario_portal
 *
 * @package App\Models
 */
class UsuarioPortalFirebase extends Model
{
	protected $table = 'usuario_portal_firebase';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'email_fbase',
		'uid'
	];

	public function usuario_portal()
	{
		return $this->belongsTo(UsuarioPortal::class, 'id');
	}
}
