<?php

namespace App\Http\Controllers;
class accountSetController extends Controller
{
    public function accountSettings()
    {
        return view('admin.settings.accountSetting');
    }
}
