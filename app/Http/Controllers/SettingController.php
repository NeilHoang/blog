<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    function setting()
    {
        $setting = Setting::first();
        return view('admin.setting.index',compact('setting'));
    }

    function save_settings(Request $request)
    {
        $countDataSetting = Setting::count();
        if ($countDataSetting == 0) {
            $settings = new Setting;
            $settings->comment_auto = $request->comment_auto;
            $settings->user_auto = $request->user_auto;
            $settings->recent_limit = $request->recent_limit;
            $settings->popular_limit = $request->popular_limit;
            $settings->recent_comment_limit = $request->recent_comment_limit;
            $settings->save();
        } else {
            $firstDataSetting = Setting::first();
            $settings = Setting::find($firstDataSetting->id);
            $settings->comment_auto = $request->comment_auto;
            $settings->user_auto = $request->user_auto;
            $settings->recent_limit = $request->recent_limit;
            $settings->popular_limit = $request->popular_limit;
            $settings->recent_comment_limit = $request->recent_comment_limit;
            $settings->save();
        }

        return redirect(route('setting'))->with('msg', 'Data has been saved');
    }
}
