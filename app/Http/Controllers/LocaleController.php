<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocaleController extends Controller
{
    public function setLocale(Request $request)
    {
        // Validate and set the locale
        $locale = $request->input('locale');
        
        // Ensure the selected locale is valid
        if (in_array($locale, ['en', 'fr', 'es'])) {
            session(['locale' => $locale]);
            App::setLocale($locale);
        }
        
        // Redirect back to the previous page
        return redirect()->back();
    }
}
