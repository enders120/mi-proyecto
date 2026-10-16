<?php
namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class CategoryController extends Controller {
 private function businessId():int{$id=auth()->user()->mype_id;abort_unless($id,403,'No tienes una empresa asignada.');return (int)$id;}
 public function index(){ $id=$this->businessId();$categories=Category::where('mype_id',$id)->withCount('products')->orderBy('name')->get();$totalCategories=$categories->count();$activeCategories=$categories->where('active',true)->count();$inactiveCategories=$totalCategories-$activeCategories;return view('categories.index',compact('categories','totalCategories','activeCategories','inactiveCategories'));}
 private function rules(int $id,?Category $category=null):array{return ['name'=>['required','string','max:150',Rule::unique('categories','name')->where('mype_id',$id)->ignore($category?->id)],'description'=>['nullable','string'],'icon'=>['nullable','string','max:255'],'color'=>['nullable','regex:/^#[0-9a-fA-F]{6}$/'],'active'=>['nullable','boolean']];}
 public function store(Request $request){$id=$this->businessId();$data=$request->validate($this->rules($id));$data['mype_id']=$id;$data['active']=$request->boolean('active');Category::create($data);return redirect()->route('categories.index')->with('success','Categoría registrada correctamente.');}
 public function update(Request $request,Category $category){$id=$this->businessId();abort_unless((int)$category->mype_id===$id,404);$data=$request->validate($this->rules($id,$category));$data['active']=$request->boolean('active');$category->update($data);return redirect()->route('categories.index')->with('success','Categoría actualizada correctamente.');}
 public function destroy(Category $category){abort_unless((int)$category->mype_id===$this->businessId(),404);if($category->products()->exists())return back()->with('error','No puedes eliminar una categoría que tiene productos.');$category->delete();return back()->with('success','Categoría eliminada.');}
}
