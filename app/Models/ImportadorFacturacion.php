<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ImportadorFacturacion
 * 
 * @property int $id
 * @property string|null $capitulo
 * @property string|null $nombre_capitulo
 * @property string|null $subcapitulo
 * @property string|null $nombre_subcapitulo
 * @property string|null $codigo
 * @property string|null $descripcion
 * @property string|null $PrecioPactado
 * @property string|null $cantidad_PrecioPactado
 * @property string|null $ArancelSinCargo
 * @property string|null $cantidad_ArancelSinCargo
 * @property string|null $PrecioOdontologia
 * @property string|null $cantidad_PrecioOdontologia
 * @property string|null $PrecioEnfermeria_1
 * @property string|null $cantidad_PrecioEnfermeria_1
 * @property string|null $PrecioQuirurgico
 * @property string|null $cantidad_PrecioQuirurgico
 * @property string|null $HonorariosAMOT
 * @property string|null $cantidad_HonorariosAMOT
 * @property string|null $HonorariosAMA_1
 * @property string|null $cantidad_HonorariosAMA_1
 * @property string|null $PrecioDermatologia
 * @property string|null $cantidad_PrecioDermatologia
 * @property string|null $PrecioHematologia
 * @property string|null $consulta_PrecioHematologia
 * @property string|null $PrecioGinecologia
 * @property string|null $cantidad_PrecioGinecologia
 * @property string|null $PrecioYeso
 * @property string|null $cantidad_PrecioYeso
 * @property string|null $PrecioRadiologia
 * @property string|null $cantidad_PrecioRadiologia
 * @property string|null $PrecioUrologia
 * @property string|null $cantidad_PrecioUrologia
 * @property string|null $PrecioCardiologia
 * @property string|null $cantidad_PrecioCardiologia
 * @property string|null $PrecioAnatomia
 * @property string|null $cantidad_PrecioAnatomia
 * @property string|null $PrecioOtorrino
 * @property string|null $cantidad_PrecioOtorrino
 * @property string|null $PrecioOftalmologia
 * @property string|null $cantidad_PrecioOftalmologia
 * @property string|null $PrecioConsulta
 * @property string|null $cantidad_PrecioConsulta
 * @property string|null $PrecioRehabilitacion
 * @property string|null $cantidad_PrecioRehabilitacion
 * @property string|null $Preciofarmacia
 * @property string|null $cantidad_Preciofarmacia
 * @property string|null $NBU
 * @property string|null $cantidad_NBU
 * @property string|null $copago
 * @property string|null $tipocopago
 * @property string|null $noConvenida
 * @property string|null $requiereAutorizacion
 * @property string|null $requiereOrden
 * @property string|null $requiereInforme
 * @property int $crear
 * @property int|null $prestacion_id
 * @property int $procesado
 * @property int $hay_arancel
 * @property int $procesado_crea_prest
 *
 * @package App\Models
 */
class ImportadorFacturacion extends Model
{
	protected $table = 'importador_facturacion';
	public $timestamps = false;

	protected $casts = [
		'crear' => 'int',
		'prestacion_id' => 'int',
		'procesado' => 'int',
		'hay_arancel' => 'int',
		'procesado_crea_prest' => 'int'
	];

	protected $fillable = [
		'capitulo',
		'nombre_capitulo',
		'subcapitulo',
		'nombre_subcapitulo',
		'codigo',
		'descripcion',
		'PrecioPactado',
		'cantidad_PrecioPactado',
		'ArancelSinCargo',
		'cantidad_ArancelSinCargo',
		'PrecioOdontologia',
		'cantidad_PrecioOdontologia',
		'PrecioEnfermeria_1',
		'cantidad_PrecioEnfermeria_1',
		'PrecioQuirurgico',
		'cantidad_PrecioQuirurgico',
		'HonorariosAMOT',
		'cantidad_HonorariosAMOT',
		'HonorariosAMA_1',
		'cantidad_HonorariosAMA_1',
		'PrecioDermatologia',
		'cantidad_PrecioDermatologia',
		'PrecioHematologia',
		'consulta_PrecioHematologia',
		'PrecioGinecologia',
		'cantidad_PrecioGinecologia',
		'PrecioYeso',
		'cantidad_PrecioYeso',
		'PrecioRadiologia',
		'cantidad_PrecioRadiologia',
		'PrecioUrologia',
		'cantidad_PrecioUrologia',
		'PrecioCardiologia',
		'cantidad_PrecioCardiologia',
		'PrecioAnatomia',
		'cantidad_PrecioAnatomia',
		'PrecioOtorrino',
		'cantidad_PrecioOtorrino',
		'PrecioOftalmologia',
		'cantidad_PrecioOftalmologia',
		'PrecioConsulta',
		'cantidad_PrecioConsulta',
		'PrecioRehabilitacion',
		'cantidad_PrecioRehabilitacion',
		'Preciofarmacia',
		'cantidad_Preciofarmacia',
		'NBU',
		'cantidad_NBU',
		'copago',
		'tipocopago',
		'noConvenida',
		'requiereAutorizacion',
		'requiereOrden',
		'requiereInforme',
		'crear',
		'prestacion_id',
		'procesado',
		'hay_arancel',
		'procesado_crea_prest'
	];
}
