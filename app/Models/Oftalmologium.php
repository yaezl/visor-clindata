<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Oftalmologium
 * 
 * @property int $id
 * @property int|null $medicion_id
 * @property string $motivo_consulta
 * @property string|null $examen_fisico
 * @property string|null $bmcd
 * @property string|null $bmci
 * @property string|null $evolucion
 * @property string|null $od_avsc
 * @property string|null $oi_avsc
 * @property string|null $od_avcsc
 * @property string|null $oi_avcsc
 * @property string|null $od_avcc
 * @property string|null $oi_avcc
 * @property string|null $od_tension_ocular
 * @property string|null $oi_tension_ocular
 * @property string|null $l_od_esf
 * @property string|null $l_od_cil
 * @property string|null $l_od_x
 * @property bool|null $l_od_rec
 * @property string|null $l_oi_esf
 * @property string|null $l_oi_cil
 * @property string|null $l_oi_x
 * @property bool|null $l_oi_rec
 * @property string|null $c_od_esf
 * @property string|null $c_od_cil
 * @property string|null $c_od_x
 * @property bool|null $c_od_rec
 * @property string|null $c_oi_esf
 * @property string|null $c_oi_cil
 * @property string|null $c_oi_x
 * @property bool|null $c_oi_rec
 * @property string|null $md_od_esf
 * @property string|null $md_od_cil
 * @property string|null $md_od_x
 * @property bool|null $md_od_rec
 * @property string|null $md_oi_esf
 * @property string|null $md_oi_cil
 * @property string|null $md_oi_x
 * @property bool|null $md_oi_rec
 * @property string|null $od_val_pupila
 * @property string|null $oi_val_pupila
 * @property string|null $od_avph
 * @property string|null $oi_avph
 * @property string|null $od_vision_color
 * @property string|null $oi_vision_color
 * @property string|null $add_od_esf
 * @property string|null $add_od_cil
 * @property string|null $add_od_x
 * @property bool|null $add_od_rec
 * @property string|null $add_oi_esf
 * @property string|null $add_oi_cil
 * @property string|null $add_oi_x
 * @property bool|null $add_oi_rec
 * @property string|null $gafas_od_esf
 * @property string|null $gafas_od_cil
 * @property string|null $gafas_od_x
 * @property bool|null $gafas_od_rec
 * @property string|null $gafas_oi_esf
 * @property string|null $gafas_oi_cil
 * @property string|null $gafas_oi_x
 * @property bool|null $gafas_oi_rec
 * @property string|null $obs_gonioscopia
 * @property string|null $campo_visual_od
 * @property string|null $campo_visual_oi
 * @property string|null $ref_ciclo_od_esf
 * @property string|null $ref_ciclo_od_cil
 * @property string|null $ref_ciclo_od_x
 * @property bool|null $ref_ciclo_od_rec
 * @property string|null $ref_ciclo_oi_esf
 * @property string|null $ref_ciclo_oi_cil
 * @property string|null $ref_ciclo_oi_x
 * @property bool|null $ref_ciclo_oi_rec
 * @property string|null $auto_ref_od_esf
 * @property string|null $auto_ref_od_cil
 * @property string|null $auto_ref_od_x
 * @property bool|null $auto_ref_od_rec
 * @property string|null $auto_ref_oi_esf
 * @property string|null $auto_ref_oi_cil
 * @property string|null $auto_ref_oi_x
 * @property bool|null $auto_ref_oi_rec
 * @property string|null $lentes_contacto_od_esf
 * @property string|null $lentes_contacto_od_cil
 * @property string|null $lentes_contacto_od_x
 * @property bool|null $lentes_contacto_od_rec
 * @property string|null $lentes_contacto_oi_esf
 * @property string|null $lentes_contacto_oi_cil
 * @property string|null $lentes_contacto_oi_x
 * @property bool|null $lentes_contacto_oi_rec
 * @property string|null $fondoscopia_od
 * @property string|null $fondoscopia_oi
 * 
 * @property Consultadetalle $consultadetalle
 * @property Medicion|null $medicion
 * @property Collection|OftalmologiaBalanceMuscular[] $oftalmologia_balance_musculars
 * @property Collection|OftalmologiaGonioscopium[] $oftalmologia_gonioscopia
 * @property Collection|OftalmologiaInformedeestudio[] $oftalmologia_informedeestudios
 * @property Collection|OftalmologiaQueratrometium[] $oftalmologia_queratrometia
 * @property Collection|Ordendeoftalmologium[] $ordendeoftalmologia
 *
 * @package App\Models
 */
class Oftalmologium extends Model
{
	protected $table = 'oftalmologia';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'medicion_id' => 'int',
		'l_od_rec' => 'bool',
		'l_oi_rec' => 'bool',
		'c_od_rec' => 'bool',
		'c_oi_rec' => 'bool',
		'md_od_rec' => 'bool',
		'md_oi_rec' => 'bool',
		'add_od_rec' => 'bool',
		'add_oi_rec' => 'bool',
		'gafas_od_rec' => 'bool',
		'gafas_oi_rec' => 'bool',
		'ref_ciclo_od_rec' => 'bool',
		'ref_ciclo_oi_rec' => 'bool',
		'auto_ref_od_rec' => 'bool',
		'auto_ref_oi_rec' => 'bool',
		'lentes_contacto_od_rec' => 'bool',
		'lentes_contacto_oi_rec' => 'bool'
	];

	protected $fillable = [
		'medicion_id',
		'motivo_consulta',
		'examen_fisico',
		'bmcd',
		'bmci',
		'evolucion',
		'od_avsc',
		'oi_avsc',
		'od_avcsc',
		'oi_avcsc',
		'od_avcc',
		'oi_avcc',
		'od_tension_ocular',
		'oi_tension_ocular',
		'l_od_esf',
		'l_od_cil',
		'l_od_x',
		'l_od_rec',
		'l_oi_esf',
		'l_oi_cil',
		'l_oi_x',
		'l_oi_rec',
		'c_od_esf',
		'c_od_cil',
		'c_od_x',
		'c_od_rec',
		'c_oi_esf',
		'c_oi_cil',
		'c_oi_x',
		'c_oi_rec',
		'md_od_esf',
		'md_od_cil',
		'md_od_x',
		'md_od_rec',
		'md_oi_esf',
		'md_oi_cil',
		'md_oi_x',
		'md_oi_rec',
		'od_val_pupila',
		'oi_val_pupila',
		'od_avph',
		'oi_avph',
		'od_vision_color',
		'oi_vision_color',
		'add_od_esf',
		'add_od_cil',
		'add_od_x',
		'add_od_rec',
		'add_oi_esf',
		'add_oi_cil',
		'add_oi_x',
		'add_oi_rec',
		'gafas_od_esf',
		'gafas_od_cil',
		'gafas_od_x',
		'gafas_od_rec',
		'gafas_oi_esf',
		'gafas_oi_cil',
		'gafas_oi_x',
		'gafas_oi_rec',
		'obs_gonioscopia',
		'campo_visual_od',
		'campo_visual_oi',
		'ref_ciclo_od_esf',
		'ref_ciclo_od_cil',
		'ref_ciclo_od_x',
		'ref_ciclo_od_rec',
		'ref_ciclo_oi_esf',
		'ref_ciclo_oi_cil',
		'ref_ciclo_oi_x',
		'ref_ciclo_oi_rec',
		'auto_ref_od_esf',
		'auto_ref_od_cil',
		'auto_ref_od_x',
		'auto_ref_od_rec',
		'auto_ref_oi_esf',
		'auto_ref_oi_cil',
		'auto_ref_oi_x',
		'auto_ref_oi_rec',
		'lentes_contacto_od_esf',
		'lentes_contacto_od_cil',
		'lentes_contacto_od_x',
		'lentes_contacto_od_rec',
		'lentes_contacto_oi_esf',
		'lentes_contacto_oi_cil',
		'lentes_contacto_oi_x',
		'lentes_contacto_oi_rec',
		'fondoscopia_od',
		'fondoscopia_oi'
	];

	public function consultadetalle()
	{
		return $this->belongsTo(Consultadetalle::class, 'id');
	}

	public function medicion()
	{
		return $this->belongsTo(Medicion::class);
	}

	public function oftalmologia_balance_musculars()
	{
		return $this->hasMany(OftalmologiaBalanceMuscular::class, 'oftalmologia_id');
	}

	public function oftalmologia_gonioscopia()
	{
		return $this->hasMany(OftalmologiaGonioscopium::class, 'oftalmologia_id');
	}

	public function oftalmologia_informedeestudios()
	{
		return $this->hasMany(OftalmologiaInformedeestudio::class, 'oftalmologia_id');
	}

	public function oftalmologia_queratrometia()
	{
		return $this->hasMany(OftalmologiaQueratrometium::class, 'oftalmologia_id');
	}

	public function ordendeoftalmologia()
	{
		return $this->hasMany(Ordendeoftalmologium::class, 'oftalmologia_id');
	}
}
