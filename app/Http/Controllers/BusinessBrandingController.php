<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BusinessBrandingController extends Controller
{
    public function update(Request $request)
    {
        $request->validate(['logo' => ['required','image','mimes:jpeg,png,webp','max:2048']]);
        $business = $request->user()->mype;
        abort_unless($business, 403, 'No hay empresa asociada.');
        $path = $request->file('logo')->store('logos', 'public');
        $old = $business->logo;
        $business->update(['logo' => $path]);
        if ($old && $old !== $path && Storage::disk('public')->exists($old)) {
            Storage::disk('public')->delete($old);
        }
        return back()->with('success', 'Logotipo actualizado correctamente.');
    }
}
