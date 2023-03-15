<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }
    
    public function index()
    {
        $data = Setting::all();

        return view('setting.data', [
            'data' => $data
        ]);
    }

    public function update(Request $request)
    {   
        // dd($request);
        Setting::where('setting_key', 'shop_name')->update(['setting_value' => $request->shop_name]);
        Setting::where('setting_key', 'shop_address')->update(['setting_value' => $request->shop_address]);
        Setting::where('setting_key', 'shop_country')->update(['setting_value' => $request->shop_country]);
        Setting::where('setting_key', 'shop_city')->update(['setting_value' => $request->shop_city]);
        Setting::where('setting_key', 'shop_zip')->update(['setting_value' => $request->shop_zip]);
        Setting::where('setting_key', 'shop_email')->update(['setting_value' => $request->shop_email]);
        Setting::where('setting_key', 'shop_website')->update(['setting_value' => $request->shop_website]);
        Setting::where('setting_key', 'shop_pin')->update(['setting_value' => $request->shop_pin]);
        Setting::where('setting_key', 'shop_currency')->update(['setting_value' => $request->shop_currency]);
        Setting::where('setting_key', 'currency_symbol')->update(['setting_value' => $request->currency_symbol]);
        Setting::where('setting_key', 'currency_position')->update(['setting_value' => $request->currency_position]);

        if ($request->hasFile('shop_logo')) {
            $destination_path = 'public/images/general';
            $photo = $request->file('shop_logo');
            $photo_name = $photo->getClientOriginalName();
            $request->file('shop_logo')->storeAs($destination_path, $photo_name);

            Setting::where('setting_key', 'shop_logo')->update(['setting_value' => $photo_name]);
        }

        return redirect()->back()->with('success', 'Settings Updated Successfully!');
    }
}
