<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Product extends Model {
 protected $fillable=['mype_id','category_id','name','sku','description','purchase_price','sale_price','stock','active','image'];
 protected function casts():array{return ['purchase_price'=>'decimal:2','sale_price'=>'decimal:2','stock'=>'integer','active'=>'boolean'];}
 public function mype():BelongsTo{return $this->belongsTo(Mype::class);}
 public function category():BelongsTo{return $this->belongsTo(Category::class);}
 public function getProfitMarginAttribute():float{$cost=(float)$this->purchase_price;return $cost>0?round((((float)$this->sale_price-$cost)/$cost)*100,2):0;}
}
