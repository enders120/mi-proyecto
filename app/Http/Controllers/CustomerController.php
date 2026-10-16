<?php
namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class CustomerController extends Controller {
 private function mid():int {return (int) auth()->user()->mype_id ?: abort(403);}
 public function index(Request $request){$id=$this->mid();$q=Customer::where('mype_id',$id)->withCount('orders');if($request->filled('search')){$term=$request->search;$q->where(fn($b)=>$b->where('name','like',"%{$term}%")->orWhere('phone','like',"%{$term}%"));}return view('customers.index',['customers'=>$q->latest()->paginate(12)->withQueryString(),'totalCustomers'=>Customer::where('mype_id',$id)->count()]);}
 public function store(Request $request){$data=$request->validate(['name'=>'required|string|max:150','phone'=>'nullable|string|max:20','email'=>'nullable|email|max:255','address'=>'nullable|string|max:255']);$data['mype_id']=$this->mid();Customer::create($data);return back()->with('success','Cliente registrado.');}
 public function update(Request $request,Customer $customer){abort_unless((int)$customer->mype_id===$this->mid(),404);$data=$request->validate(['name'=>'required|string|max:150','phone'=>'nullable|string|max:20','email'=>'nullable|email|max:255','address'=>'nullable|string|max:255']);$customer->update($data);return back()->with('success','Cliente actualizado.');}
 public function destroy(Customer $customer){abort_unless((int)$customer->mype_id===$this->mid(),404);if($customer->orders()->exists())return back()->withErrors(['customer'=>'No se puede eliminar un cliente con pedidos.']);$customer->delete();return back()->with('success','Cliente eliminado.');}
}
