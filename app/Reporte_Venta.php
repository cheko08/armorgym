<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Reporte_Venta extends Model
{
  protected $table = 'reportes_ventas';
  protected $fillable = [
  'user_id','producto_id',
  'total','caja', 'cantidad'];

  public function user()
  {
    return $this->belongsTo('App\User')->withTrashed();
  }

    public function producto()
  {
    return $this->belongsTo('App\Producto');
  }

  public function sucursal()
  {
    return $this->belongsTo('App\Sucursal');
  }

}