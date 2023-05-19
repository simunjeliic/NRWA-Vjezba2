<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CountryLanguage;

class CountryLanguageController extends Controller
{
    public function index()
    {
        $Countrylanguage = CountryLanguage::orderBy('CountryCode','desc')->paginate(10);
        return view('countrylanguage.index', compact('Countrylanguage'));
    }

    public function lsearch(Request $request)
    {
        $query = $request->get('query');
        $results = CountryLanguage::where('CountryCode', 'LIKE', '%' . $query . '%')->get();

        return response()->json($results);
    }
}