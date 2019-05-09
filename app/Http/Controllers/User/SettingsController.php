<?php

namespace App\Http\Controllers\User;

use Exception;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use Intervention\Image\Facades\Image;

class SettingsController extends Controller
{
    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }

    /**
     * View current user's settings
     *
     * @return \Illuminate\Http\Response
     */
    public function settings(Request $request)
    {
        $user = $request->user();

        if ($user) {
            return view('user.settings')
            ->with('user', $user);
        }

        return back()->withErrors(['Could not find user']);
    }

    /**
     * Update the user
     *
     * @param  UpdateAccountRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request)
    {
      $imagedir = '';
      if(request()->hasfile('pix'))
      {
        //cover image
        //$file = Image::make($file)->resize(255, 170);
        $filedir = request()->file('pix')->store('public/profile');
        /*$image = Image::make(Storage::get($imagePath))->resize(160,80)->encode();
        Storage::put($imagePath,$image);

        $imagePath = explode('/',$imagePath);*/

        $image = explode('/', $filedir);
        $imagedir = 'storage/profile/'.$image[2];
        //$request->pix = $imagedir;
      }

        $setting = request(['email','name','bio','meta','roles','_token'])+(['pix' => $imagedir]);
        //dd($request->all(['pix' => $imagedir]) );
        try {
            if ($this->service->update(auth()->id(), $setting )) {

                return back()->with('message', 'Settings updated successfully');
            }

            return back()->withErrors(['Could not update user']);
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
