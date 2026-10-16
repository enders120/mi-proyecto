<?php
namespace App\Http\Controllers;
use App\Models\Mype;
use App\Models\Product;
use Illuminate\Http\Request;
class ShopController extends Controller {
 public function show(Request $request, Mype $mype) {
  abort_unless($mype->active,404);
  $products=Product::where('mype_id',$mype->id)->where('active',true)->when($request->query('q'),fn($q,$term)=>$q->where('name','like','%'.str_replace(['%','_'],['\\%','\\_'],$term).'%'))->latest()->paginate(12)->withQueryString();
  return view('shop.show',compact('mype','products'));
 }
}
