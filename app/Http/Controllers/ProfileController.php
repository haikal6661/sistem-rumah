<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        
        // dd($users[0]->phone_no);
        return view('profile.edit');
    }

    public function show($id)
    {
        $users = User::find($id);

        // dd(auth()->user()->hasRole('Admin'));
        if (auth()->user()->hasRole('Admin'))
        {
            return view('profile.show', compact('users'));

        }elseif (auth()->user()->id == $users->id){
            
            return view('profile.show', compact('users'));
        }
        
        return redirect('user-management')->with('message', 'You don\'t have access!');
        
    }

    // public function modalView($id)
    // {
    //     $user = User::find($id);


    // }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        // dd($request->file('picture')->getClientOriginalName());

        $validateData = $request->validate([
            'picture' => 'image|mimes:jpg,png,jpeg,pdf|max:2048',
        ]);

        

        if ($request->file('picture')){

            $picture_name = $request->file('picture')->getClientOriginalName();
            $path = $request->file('picture')->storeAs('public/images/profile_img',$picture_name);
            
            $userDetails = UserDetail::where('user_id', auth()->user()->id)
                        ->updateOrCreate([
                            'user_id' => auth()->user()->id,], [
                            'phone_no' => $request->phone,
                            'age' => $request->age,
                            'birth_place' => $request->birth_place,
                            'education' => $request->education,
                            'profession' => $request->profession,
                            'workplace' => $request->workplace,
                            'about' => $request->about,
                            'picture' => $request->file('picture')->getClientOriginalName(),
                        ]);

                        auth()->user()->update($request->all());
        }else {
            $userDetails = UserDetail::where('user_id', auth()->user()->id)
                        ->updateOrCreate([
                            'user_id' => auth()->user()->id,], [
                            'phone_no' => $request->phone,
                            'age' => $request->age,
                            'birth_place' => $request->birth_place,
                            'education' => $request->education,
                            'profession' => $request->profession,
                            'workplace' => $request->workplace,
                            'about' => $request->about,
                        ]);
        // dd($request);

        auth()->user()->update($request->all());
        }
        // $picture_name = $request->file('picture')->getClientOriginalName();
        // $path = $request->file('picture')->storeAs('public/images/profile_img',$picture_name);

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password 
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        if (auth()->user()->id == 1) {
            return back()->withErrors(['not_allow_password' => __('You are not allowed to change the password for a default user.')]);
        }

        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
}
