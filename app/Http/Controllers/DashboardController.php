<?php
namespace App\Http\Controllers;
use App\Models\{Product,Customer,Order,Category};
use Illuminate\Http\Request;
class DashboardController extends Controller {
 public function index(Request $request){$user=$request->user();abort_unless($user->mype_id && $user->mype?->active,403);$id=$user->mype_id;$base=Order::where('mype_id',$id);return view('dashboard',['business'=>$user->mype->name,'products'=>Product::where('mype_id',$id)->where('active',1)->count(),'customers'=>Customer::where('mype_id',$id)->count(),'categories'=>Category::where('mype_id',$id)->count(),'pendingOrders'=>(clone $base)->where('status','pending')->count(),'completedOrders'=>(clone $base)->where('status','completed')->count(),'sales'=>(clone $base)->where('status','completed')->sum('total'),'inventoryValue'=>Product::where('mype_id',$id)->get()->sum(fn($p)=>(float)$p->purchase_price*$p->stock),'lowStock'=>Product::where('mype_id',$id)->where('stock','<=',5)->orderBy('stock')->limit(8)->get(),'recentOrders'=>(clone $base)->with('customer')->latest()->limit(8)->get()]);}
}
