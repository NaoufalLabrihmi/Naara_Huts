<?php

namespace App\Http\Controllers\Backend;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Intervention\Image\Laravel\Facades\Image;

class TeamController extends Controller
{
    public function AllTeam()
    {
        $team = Team::latest()->get();
        return view('backend.team.all_team', compact('team'));
    }

    public function AddTeam()
    {
        return view('backend.team.add_team');
    }

    public function StoreTeam(Request $request)
    {
        $save_url = $this->handleImage($request->file('image'));

        Team::create([
            'name' => $request->name,
            'position' => $request->position,
            'facebook' => $request->facebook,
            'image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Team Data Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.team')->with($notification);
    }

    public function EditTeam($id)
    {
        $team = Team::findOrFail($id);
        return view('backend.team.edit_team', compact('team'));
    }

    public function UpdateTeam(Request $request)
    {
        $team_id = $request->id;
        $team = Team::findOrFail($team_id);

        if ($request->hasFile('image')) {
            // Handle new image upload
            $save_url = $this->handleImage($request->file('image'));

            // Delete the old image file if it exists
            if ($team->image && file_exists(public_path($team->image))) {
                unlink(public_path($team->image));
            }

            $team->update([
                'name' => $request->name,
                'position' => $request->position,
                'facebook' => $request->facebook,
                'image' => $save_url,
                'created_at' => Carbon::now(),
            ]);
        } else {
            $team->update([
                'name' => $request->name,
                'position' => $request->position,
                'facebook' => $request->facebook,
                'created_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => 'Team Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.team')->with($notification);
    }


    private function handleImage($image)
    {
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $save_url = 'upload/team/' . $name_gen;
        Image::read($image)->resize(550, 670)->save($save_url);
        return $save_url;
    }

    public function DeleteTeam($id)
    {
        $item = Team::findOrFail($id);
        $img = $item->image;
        unlink($img);
        $item->delete();

        $notification = array(
            'message' => 'Team Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.team')->with($notification);
    }
}
