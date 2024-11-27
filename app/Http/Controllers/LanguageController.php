<?php

namespace App\Http\Controllers;

class LanguageController extends Controller
{
    /**
     * Set the application's locale.
     *
     * @param  string  $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setLanguage($locale)
    {
        $availableLocales = ['en', 'ar']; // Add other locales if needed
        if (!in_array($locale, $availableLocales)) {
            abort(400, 'Locale not supported');
        }

        // Store the locale in the session
        session(['locale' => $locale]);

        // Optionally set the locale for the current request
        app()->setLocale($locale);
        // Redirect back to the previous page
        return redirect()->back();
    }
}
