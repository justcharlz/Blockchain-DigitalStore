<?php

namespace App\Http\Controllers\User;

use Exception;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;

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
      if(request()->hasfile('pix'))
      {
        //cover image
        $file = Image::make($file)->resize(255, 170)->encode();
        $filedir = request()->file($file)->store('public/profile');
        /*$image = Image::make(Storage::get($imagePath))->resize(160,80)->encode();
        Storage::put($imagePath,$image);

        $imagePath = explode('/',$imagePath);*/

        $imagedir = explode('/', $filedir);
        $imagedir = 'storage/profile/'.$imagedir[2];
        $request->pix = $imagedir;
      }

        try {
            if ($this->service->update(auth()->id(), $request->all())) {
                return back()->with('message', 'Settings updated successfully');
            }

            return back()->withErrors(['Could not update user']);
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
