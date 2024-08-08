<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Admin;
use App\Models\Office;
use App\Models\AdminType;
use App\Models\AttendanceRecords;
use App\Models\Student;
use App\Models\StudentEvent;
use App\Models\Scholarship;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Event;
use Intervention\Image\Facades\Image; // see notes below
use Illuminate\Support\Facades\Log;
use Illuminate\Session\TokenMismatchException;

class AdminController extends Controller
{

    public function showTest() // for testing purposes only
    {
        return view('test');
    }

    //-------------------------------------functions for views-------------------------------------

    //---------------outside views---------------
    public function showSignup1()
    {
        return view('admin.signup-step1');
    }
    public function showSignup2()
    {
        return view('admin.signup-step2');
    }
    public function showLogin()
    {
        return view('admin.login');
    }

    //---------------dashboard views---------------
    public function showIndex()
    {
        return view('admin.index');
    }
    public function showAdminManage()
    {
        $admins = Admin::all();
        $offices = Office::all();
        $admin_types = AdminType::all();
        return view('admin.manage', compact('admins', 'offices', 'admin_types'));
    }
    public function showProfile($admin_id)
    {
        // Fetch the admin's data from the database based on the $adminId
        $admin = Admin::find($admin_id);

        // Check if the admin exists
        if (!$admin) { // You can handle what to do if the admin is not found, such as displaying an error message or redirecting to a 404 page.
            return view('errors.admin_not_found');  // For example, you can return a view with an error message:
        }

        // Pass the admin data to the view and display it
        return view('admin.profile', ['admin' => $admin]);
    }
    public function showCreateAdmin()
    {
        $offices = Office::all();
        $admin_types = AdminType::all();
        return view('admin.create', compact('offices', 'admin_types'));
    }

    //---------------office views---------------
    public function showOfficeIndex()
    {
        $offices = Office::where('archived', false)->get();
        return view('admin.office.index', compact('offices'));
    }

    //---------------clearance views---------------
    public function showClearanceIndex()
    {
        return view('admin.clearance.index');
    }

    //---------------events views---------------
    public function showEventsIndex()
    {
        $student_events = StudentEvent::all();
        return view('admin.student_event.index', compact('student_events'));
    }
    public function showCreateEvents()
    {
        return view('admin.student_event.create');
    }
    public function showEventScanner($event_id)
    {
        $current_time = Carbon::now();
        $timeInOrOut = '';

        $event = StudentEvent::where('event_id', $event_id)->first();
        if ($event) {

            $InTime = Carbon::parse($event->event_date . ' ' . $event->event_time_in);
            $InCutOff = Carbon::parse($event->event_time_in)->addHours(1);

            $OutTime =  Carbon::parse($event->event_date . ' ' . $event->event_time_out);
            $OutCutOff = Carbon::parse($event->event_time_out)->addHours(1);

            if ($current_time >= $InTime && $current_time <= $InCutOff) {
                $timeInOrOut = 'in';
            } else if ($current_time >= $OutTime && $current_time <= $OutCutOff) {
                // dd([$current_time, $OutTime, $OutCutOff]);
                $timeInOrOut = 'out';
            } else {
                return redirect(route('admin_stud_events'))
                    ->with('custom-error', 'Attendance for this event is closed');
            }
            return view('admin.student_event.qr-scanner', ['event' => $event], ['in_out' => $timeInOrOut]);
        } else {
            return redirect(route('admin_stud_events'))
                ->with('custom-error', 'Select event to use scanner');
        }
    }
    public function showEventDetails($event_id)
    {
        $records = AttendanceRecords::where('event_id', $event_id)->get();
        $event = StudentEvent::where('event_id', $event_id)->first();
        return view('admin.student_event.event_details', ['records' => $records], ['event' => $event]);
    }

    //---------------events attendance views---------------
    public function showAttendanceIndex()
    {
        return view('admin.events_attendance.index');
    }

    //---------------scholarship views---------------
    public function showScholarshipIndex()
    {
        $scholarships = Scholarship::where('archived', false)->get();
        return view('admin.scholarship.index', compact('scholarships'));
    }
    public function showCreateScholarship()
    {
        return view('admin.scholarship.create');
    }
    public function showScholarshipDetails($id)
    {
        $scholarship = Scholarship::find($id);
        return view('admin.scholarship.details', compact('scholarship'));
    }
    public function showScholarshipEdit($id)
    {
        $scholarship = Scholarship::find($id);
        return view('admin.scholarship.edit', compact('scholarship'));
    }
    public function showArchivedScholarship()
    {
        $scholarships = Scholarship::where('archived', true)->get();
        return view('admin.scholarship.archive', compact('scholarships'));
    }
    public function showScholarshipGrantees($id)
    {
        $scholarship = Scholarship::find($id);
        
        if (!$scholarship) {
            return response()->json(['message' => 'Scholarship not found'], 404);
        }

        $student_grantees = $scholarship->students;

        return view('admin.scholarship.grantees', compact('student_grantees','scholarship'));
    }

    //-------------------------functions for functionality-------------------------

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
            ->with('message', 'Successfully saved your info');
    }

    // for signup step 2
    public function storeSignup2(Request $request)
    {

        $adminId = session('admin_id'); // Retrieve 'admin_id' from the session

        $validated = $request->validate([
            "employee_id" => ['required', 'max:6'],
        ]);

        $validated['admintype_id'] = 1; // assigning Super Admin type

        $validated['office_id'] = 1; // assigning office to OSAS

        $admin = Admin::find($adminId); // Find the admin by ID and update the attributes

        if (!$admin) { // if admin is not found
            return redirect()->back()->with('error', 'Admin not found');
        }

        // code for image upload
        // checking if there is a file
        if ($request->hasFile('admin_image')) {

            $request->validate([ // validation for right format and size
                "admin_image" => 'mimes:jpeg,png,bmp,tiff | max:4096'
            ]);

            // to avoid duplication of image
            $filenameWithExtension = $request->file("admin_image"); // gets the filename+extension
            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME); // extracts filename only without extension

            $extension = $request->file("admin_image") // gets the extension of the file 
                ->getClientOriginalExtension();

            $filenameToStore = $filename . '_' . time() . '.' . $extension; // filename_timestamp.extention

            $smallThumbnail = 'small_' . $filename . '_' . time() . '.' . $extension; // small_filename_timestamp.extention

            $request->file('admin_image')->storeAs( // stores the image to ...
                'public/admin',
                $filenameToStore
            );

            $request->file('admin_image')->storeAs( // stores the small image to ...
                'public/admin/thumbnail',
                $smallThumbnail
            );

            $thumbnail = 'storage/admin/thumbnail/' . $smallThumbnail; // assigns the path to the thumbnail image to this variable
            // example content of $thumbnail is /storage/admin/thumbnail/small_my-image_1670915990.png

            // dd($thumbnail); // <- for debugging only
            $this->createThumbnail($thumbnail, 150, 150);

            $validated['admin_image'] = $filenameToStore; // stores the new filename to db
        }

        $admin->update($validated); // updating the data of that admin

        return redirect(route('admin_login'))->with('message', 'Successfully created Super Admin account');
    }

    // for creating new admin
    public function storeCreate(Request $request)
    {
        $validated = $request->validate([
            "admin_lname" => ['required', 'min:2', 'alpha_spaces'],
            "admin_fname" => ['required', 'min:2', 'alpha_spaces'],
            "admin_mi" => ['required', 'regex:/^(N\/A|[A-Za-z])$/'],
            "employee_id" => ['required', 'max:6'],
            "office_id" => ['required'],
            "admintype_id" => ['required'],
            "admin_contact" => ['nullable', 'numeric', 'digits_between:10,15'],
            "email" => ['required', 'email', Rule::unique('admins', 'email')],
        ]);

        // checking if there is a file
        if ($request->hasFile('admin_image')) {
            $request->validate([
                "admin_image" => 'mimes:jpeg,png,bmp,tiff|max:4096'
            ]);

            $filenameWithExtension = $request->file("admin_image");
            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
            $extension = $request->file("admin_image")->getClientOriginalExtension();
            $filenameToStore = $filename . '_' . time() . '.' . $extension;
            $smallThumbnail = 'small_' . $filename . '_' . time() . '.' . $extension;

            $request->file('admin_image')->storeAs(
                'public/admin',
                $filenameToStore
            );

            $request->file('admin_image')->storeAs(
                'public/admin/thumbnail',
                $smallThumbnail
            );

            $thumbnail = 'storage/admin/thumbnail/' . $smallThumbnail;
            $this->createThumbnail($thumbnail, 150, 150);

            $validated['admin_image'] = $filenameToStore;
        }

        // Generate password based on employee ID and last name
        $password = $validated['employee_id'] . '_' . strtolower($validated['admin_lname']);

        // Hash the password before storing it
        $validated['password'] = bcrypt($password);

        try {
            Admin::create($validated);
            return redirect(route('admin_manage'))->with('message', 'Successfully create new Admin account!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back();
        }
    }


    // creating a small thumbnail
    public function createThumbnail($path, $width, $height) // $path is the path of the thumbnail
    { //  creates a thumbnail image 

        $img = Image::make($path)->resize( // loads into an Intervention Image object, see notes below
            $width,
            $height,
            function ($constraint) {
                $constraint->aspectRatio();
            }
        );
        $img->save($path); // save the resized image back to the original path
    }

    // login
    public function processLogin(Request $request)
    {
        // crsf error handler
        try {

            $validated = $request->validate([
                "email" => ['required', 'email'],
                'password' => 'required'
            ]);

            if (auth()->guard('admin')->attempt($validated)) { // guarded athentication
                session()->regenerate();
                return redirect(route('admin_dashboard'))->with('message', 'Successfully Logged In!');
            }

            return back()->with(['custom-error' => 'Login failed! Incorrect Email or Password']);
        } catch (TokenMismatchException $e) {
            return redirect()->route('student_login')->withErrors(['csrf' => 'CSRF token expired. Please try again.']);
        }
    }

    // logout
    public function processLogout(Request $request)
    {
        // crsf error handler
        try {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect(route('admin_login'))->with('message', 'Logout successful');
        } catch (TokenMismatchException $e) {
            return redirect()->route('student_login')->withErrors(['csrf' => 'CSRF token expired. Please try again.']);
        }
    }

    // processing of qr code
    public function processQR(Request $request)
    {
        $student = Student::where('student_osasid', $request['scanner'])->first();
        if (!$student) {
            return redirect()->back()->with('custom-error', 'Student not found');
        }
        $event_id = $request['event_id'];
        $in_out = $request['in_out'];

        // get event for scanner view
        $event = StudentEvent::where('event_id', $event_id)->first();

        // checks if there is a record already present
        $att_record = AttendanceRecords::where([
            'student_osasid' => $student->student_osasid,
            'event_id' => $event_id,
        ])->first();

        if ($att_record) {
            if ($in_out === 'in') {
                return redirect(route('admin_event_scanner', ['event_id' => $event_id]))->with('event', $event)
                    ->with('custom-error', 'Duplicate time-in attendance!');
            } else if ($in_out === 'out') {
                return redirect(route('admin_event_scanner', ['event_id' => $event_id]))->with('event', $event)
                    ->with('custom-error', 'Duplicate attendance record!');
            }
        }
        return view('admin.student_event.qr-result', compact('student', 'event_id', 'in_out'));
    }

    // storing new event
    public function storeEvent(Request $request)
    {
        try {
            $validated = $request->validate([
                "event_name" => [''],
                "event_date" => [''],
                "event_time_in" => [''],
                "event_time_out" => [''],
                "event_desc" => [''],
            ]);

            StudentEvent::create($validated);

            return redirect(route('admin_stud_events'))->with('message', 'New Event Created!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            back();
        }
    }

    // storing attendance
    public function storeAttendance(Request $request)
    {
        $ows_id = request('ows_id');
        $event_id = request('event_id');
        $in_out = request('in_out');
        $currentTime = Carbon::now();

        $data = [
            'student_osasid' => $ows_id,
            'event_id' => $event_id,
        ];

        // if time in
        if ($in_out === 'in') {
            $data['time_in'] = $currentTime;
            $data['time_out'] = NULL;
        }
        // if time out
        else if ($in_out === 'out') {
            $att_record = AttendanceRecords::where([
                'student_osasid' => $ows_id,
                'event_id' => $event_id,
            ])->first();
            // if existing att record
            if ($att_record) {
                $att_record->time_out = $currentTime; // change status to 'Attended'
                $att_record->save();
            } else {
                $data['time_in'] = NULL;
                $data['time_out'] = $currentTime;
            }
        }

        AttendanceRecords::create($data);

        $event = StudentEvent::where('event_id', $event_id)->first();
        return redirect(route('admin_event_scanner', ['event_id' => $event_id]))->with('event', $event)
            ->with('message', 'Attendance confirmed!');
    } // end of method

    public function storeScholarship(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'provider' => 'required|string|max:255',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'qualifications' => 'nullable|string',
            'benefits' => 'nullable|string',
        ]);

        // Save the scholarship to the database
        Scholarship::create($validated);

        // You can also redirect the user to a success page or perform other actions
        return redirect()->route('admin_scholarship')->with('message', 'Scholarship added successfully');
    }

    public function updateScholarship(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'provider' => 'required|string|max:255',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'qualifications' => 'nullable|string',
            'benefits' => 'nullable|string',
        ]);

        // Find the scholarship by ID
        $scholarship = Scholarship::findOrFail($id);

        // Update the scholarship with the new data
        $scholarship->update($request->all());

        return redirect()->route('admin_scholarship_details', $scholarship->id)
            ->with('message', 'Scholarship updated successfully');
    }

    public function archiveScholarship($id)
    {
        // Retrieve the scholarship by ID
        $scholarship = Scholarship::find($id);
        // Check if the scholarship exists
        if (!$scholarship) {
            abort(404, 'Scholarship not found');
        }
        // Archive the scholarship
        $scholarship->archived = true; // Assuming you have an 'archived' column in your scholarships table
        $scholarship->save();

        return redirect()->route('admin_scholarship')->with('message', 'Scholarship archived successfully');
    }

    public function restoreScholarship($id)
    {
        // Retrieve the scholarship by ID
        $scholarship = Scholarship::find($id);
        // Check if the scholarship exists
        if (!$scholarship) {
            abort(404, 'Scholarship not found');
        }
        // Archive the scholarship
        $scholarship->archived = false; // Assuming you have an 'archived' column in your scholarships table
        $scholarship->save();

        return redirect()->route('admin_scholarship')->with('message', 'Scholarship restored successfully');
    }
}





// dev notes:

// to install Image Intervention, [composer require intervention/image] 
// -> [composer update]
// -> register in app(config) this in providers array [Intervention\Image\ImageServiceProvider::class,]
// -> publish using [php artisan vendor:publish --provider="Intervention\Image\ImageServiceProvider"]
// -> register alias in app(config) in alias array ['Image' => Intervention\Image\Facades\Image::class,]
// so that I can use this Image in Facades

// [php artisan storage:link] -> to connect the public storage to storage>app