<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Admin;

class AdminController extends Controller
{


    public function showTest() // for testing purposes only
    {
        return view('test');
    }

    // returns view
    public function showSignup1()
    {
        return view('admin.signup-step1');
    }
    public function showSignup2()
    {
        return view('admin.signup-step2');
    }

    // storing signup step 1
    public function storeSignup1(Request $request)
    {

        $validated = $request->validate([
            "admin_lname" => ['required', 'min:2', 'alpha_spaces'],
            "admin_fname" => ['required', 'min:2', 'alpha_spaces'],
            "admin_mi" => ['required', 'regex:/^(N\/A|[A-Za-z])$/'], //require to be clearer, user must put N/A if they have no mi
            "admin_contact" => ['nullable', 'numeric', 'digits_between:10,15'],
            "email" => ['required', 'email', Rule::unique('admins', 'email')],
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[^A-Za-z0-9])/',
            ],
        ]);
        $validated['password'] = bcrypt($validated['password']); // incrypting the inputted password
        $newAdmin = Admin::create($validated);

        // Store 'admin_id' in the session
        session()->put('admin_id', $newAdmin->admin_id);

        return redirect(route('admin_signup2'))
            ->with('message', 'Successfully Created an Admin Account');
    }

    // for signup step 2
    public function storeSignup2(Request $request)
    {
        
        $adminId = session('admin_id'); // Retrieve 'admin_id' from the session

        $validated = $request->validate([
            "employee_id" => ['required', 'max:6'],
        ]);

        $validated['admintype_id'] = 1; // assigning Super Admin type

        $admin = Admin::find($adminId); // Find the admin by ID and update the attributes

        if (!$admin) { // if admin is not found
            return redirect()->back()->with('error', 'Admin not found');
        }

          // checking if there is a file
          if ($request->hasFile('admin_image')) {
            $request->validate([
                "admin_image" => 'mimes:jpeg,png,bmp,tiff | max:4096'
            ]);

            // to avoid duplication of image
            $filenameWithExtension = $request->file("admin_image");
            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);

            $extension = $request->file("admin_image")
                ->getClientOriginalExtension();

            $filenameToStore = $filename . '_' . time() . '.' . $extension;

            $smallThumbnail = $filename . '_' . time() . '.' . $extension;

            $request->file('admin_image')->storeAs(
                'public/admin',
                $filenameToStore
            );

            $request->file('admin_image')->storeAs(
                'public/admin/thumbnail',
                $smallThumbnail
            );

            $thumbnail = 'storage/admin/thumbnail/' . $smallThumbnail;

            // dd($thumbnail);
            $this->createThumbnail($thumbnail, 150, 150);

            $validated['admin_image'] = $filenameToStore;
        }

        $admin->update($validated); // updating the data of that admin

        return redirect(route('admin_signup2'))->with('message', 'Admin data updated successfully');
    }
}
