<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SiteIdentityRequest;
use App\Models\SiteOption;
use App\Helpers\ImageHelper;

class SiteIdentityController extends Controller
{
    public function index() {
        return view('site-identity.index');
    }

    public function update(SiteIdentityRequest $request) {
        if ($request->hasFile('sitelogo')) {
            $this->saveLogo($request->file('sitelogo'));
        }
        SiteOption::saveOption('sitename', $request->sitename);

        return redirect()->back()->withErrors('success', 'Identitas Situs berhasil diperbaharui.');
    }

    public function saveLogo($logo) {
        $image = new ImageHelper();
        $photo = $image->upload($logo, 'logo', ['16', '250']);

        $sitelogo = siteOption('sitelogo');
        if ($sitelogo != null) {
            $image = new ImageHelper();
            $image->remove($sitelogo, 'logo', ['16', '250']);
        }

        SiteOption::saveOption('sitelogo', $photo['name']);
    }
}
