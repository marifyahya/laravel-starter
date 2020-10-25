<?php
// Site Option
if (! function_exists('siteOption')) {
    function siteOption($site_name = null)
    {
		if ($site_name != null)  {
	        return \App\Models\SiteOption::where('option_name', $site_name)->first()->option_value ?? null;
		}

        return \App\Models\SiteOption::where('autoload', 'yes')->get();
    }
}
if (! function_exists('siteOptionLogo')) {
    function siteOptionLogo($folder = null)
    {
        if (is_null(siteOption('sitelogo'))) {
            return asset('img/logo/logo-default.png');
        } else {
            if (!is_null($folder)) $folder .= '/';
            return asset(Storage::url('/images/logo/' . $folder . siteOption('sitelogo')));
        }
    }
}
//fotoProfile
if (! function_exists('fotoProfile')) {
    function fotoProfile(){
        $user = Auth::user();
        if (is_null($user->photo)) {
            $foto = 'https://ui-avatars.com/api/?name='.$user->first_name .' '. $user->last_name .'&background=0D8ABC&color=fff&size=32';
        } else {
            $foto =  asset(Storage::url('/images/employee/160/' . $user->photo));
        }

        return $foto;
    }
}
// End Site Option

// Role
if (! function_exists('roleCan')) {
    function roleCan($permission_name){
        $role_id = Auth::user()->role_id;
        $permission = \App\Models\Permission::whereHas('role', function($q) use ($role_id){
                $q->where('role_id', $role_id);
            })
            ->where('permission_name', $permission_name)
            ->count();

        return $permission > 0 ? true : false;
    }
}
if (! function_exists('roleAllow')) {
    function roleAllow($permission_name){
        if (!roleCan($permission_name)) {
            abort(403);
        }
        return;
    }
}
// End Role

// Common helper
//json pretty
if (! function_exists('jp')) {
    function jp($data){
        die("<pre>".json_encode($data, JSON_PRETTY_PRINT)."</pre>");
    }
}
// change format date to d-m-Y
if (! function_exists('dateId')) {
    function dateId($date){
        return date('d-m-Y', strtotime($date));
    }
}
// change format date to Y-m-d
if (! function_exists('dateDb')) {
    function dateDb($date){
        return date('Y-m-d', strtotime($date));
    }
}