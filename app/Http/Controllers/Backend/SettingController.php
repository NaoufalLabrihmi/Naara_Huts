<?php

namespace App\Http\Controllers\Backend;

use App\Models\SiteSetting;
use App\Models\SmtpSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Laravel\Facades\Image;


class SettingController extends Controller
{
    public function SmtpSetting()
    {
        $smtp = SmtpSetting::find(1);
        return view('backend.setting.smpt_update', compact('smtp'));
    }

    public function SmtpUpdate(Request $request)
    {

        $smtp_id = $request->id;

        SmtpSetting::find($smtp_id)->update([
            'mailer' => $request->mailer,
            'host' => $request->host,
            'port' => $request->port,
            'username' => $request->username,
            'password' => $request->password,
            'encryption' => $request->encryption,
            'from_address' => $request->from_address,
        ]);

        $notification = array(
            'message' => 'Smtp Setting Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function SiteSetting()
    {
        $site = SiteSetting::find(1);
        return view('backend.site.site_update', compact('site'));
    }

    public function SiteUpdate(Request $request)
    {

        $site_id = $request->id;
        $testi = SiteSetting::find($site_id);

        if ($request->file('logo')) {

            $image = $request->file('logo');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::read($image)->resize(110, 44)->save('upload/site/' . $name_gen);
            $save_url = 'upload/site/' . $name_gen;
            if ($testi->logo && file_exists(public_path($testi->logo))) {
                unlink(public_path($testi->logo));
            }
            SiteSetting::findOrFail($site_id)->update([

                'phone' => $request->phone,
                'address' => $request->address,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'copyright' => $request->copyright,
                'logo' => $save_url,
            ]);

            $notification = array(
                'message' => 'Site Setting Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } else {

            SiteSetting::findOrFail($site_id)->update([

                'phone' => $request->phone,
                'address' => $request->address,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'copyright' => $request->copyright,
            ]);

            $notification = array(
                'message' => 'Site Setting Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }
    }
}
