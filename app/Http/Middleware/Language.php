<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use function Pest\Laravel\get;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */


    public function handle(Request $request,Closure $next)
    {

        $data = \App\Models\Language::all()->toArray();
        $languages = array_column($data, 'language');
        $default = array_column($data, 'default');
        $localeSegment = $request->segment(1);

        if (empty($localeSegment)) {
            $locale = Config::get('app.locale');
            if ($default[0] == 1) {
                return Redirect::to($request->getRequestUri());
            } else {
                // Redirect to the default language without the language segment
                $uri = str_replace('/'.$locale, '', $request->getRequestUri());
                return Redirect::to($uri);
            }
        }

        if (!in_array($request->locale, $languages)) {
            $base = url()->to('');
            $path = str_replace($base, '', $request->fullUrl());
            return redirect()->to($base . '/' . config('app.locale') . $path);
        }

        app()->setLocale($request->locale);
        URL::defaults(['locale' => $request->locale]);
        return $next($request);
    }

}
