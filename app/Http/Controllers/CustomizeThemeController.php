<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteOption;

class CustomizeThemeController extends Controller
{
    protected $defaultThemes = [
        'body' => 'sidebar-mini layout-fixed layout-navbar-fixed',
        'brand_link' => 'brand-link',
        'main_footer' => 'main-footer',
        'main_header' => 'main-header navbar navbar-expand navbar-white navbar-light',
        'main_sidebar' => 'main-sidebar sidebar-dark-primary elevation-4',
        'nav_sidebar' => 'nav nav-pills nav-sidebar flex-column'
    ];

    public function index() {
        return view('theme.index');
    }

    public function setThemes(Request $request) {
        SiteOption::saveOption('customize_themes', json_encode($request->themes));
        return response()->json('Tema berhasil diperbaharui.', 200);
    }

    public function resetThemes() {
        SiteOption::saveOption('customize_themes', json_encode($this->defaultThemes));
        return response()->json('Tema berhasil direset.', 200);
    }
}
