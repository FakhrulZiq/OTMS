<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\User;
use App\Models\Staffs;
use App\Models\Classes;
use App\Models\Parents;
use App\Models\Payments;
use App\Models\Students;
use App\Models\Teachers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\learningProgress;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    //show all student
    public function index() {
        if (!in_array(Auth::user()->type, ['Headmaster', 'Staff', 'Teacher'])) {
            abort(403, 'Unauthorized');
        }

        // Get total counts of students with different statuses
        $totalPendingApprovals = Students::where('Status', 'Pending')->count();
        $totalApproved = Students::where('Status', 'Active')->count();
        $totalRejected = Students::where('Status', 'Rejected')->count();

        $students = Students::latest()->filter(request(['Status', 'search']))->paginate(10);

        return view('students.indexStudent', compact('students', 'totalPendingApprovals', 'totalApproved', 'totalRejected'));
    }

    //show student detail profile
    public function show(Students $student)
    {
        $parent = Parents::find($student->Parent_id);
        $learningProgress = $student->learningProgress()->orderBy('updated_at', 'desc')->first();
        $class = Classes::find($student->Class_id);
        $teacher = Teachers::where('id', $class->Teacher_ID)->first();

        return view('students.showStudent', [
            'student' => $student,
            'parent' => $parent,
            'class' => $class,
            'teacher' => $teacher, 
            'learningProgress' => $learningProgress
        ]);
    }

    //show student registration form
    public function create()
    {
        return view('students.studentRegistration');
    }

    // store student data
    public function store(Request $request)
    {
        $registerForm = $request->validate([
            'FullName' => 'required',
            'birthCertificateNO' => 'required',
            'MyKid' => 'required',
            'Address1' => 'required',
            'Address2' => 'required',
            'Poscode' => 'required',
            'City' => 'required',
            'State' => 'required',
            'DOB' => 'required',
            'Sex' => 'required',
            'PhoneNo' => 'required',
            'Nationality' => 'required',
            'Disability' => 'required',
            'BillSibling' => 'required',
            'AnakKe' => 'required',
            'SchoolName' => 'required',
            'Status' => 'required',
            'Class_id' => 'required',
            'ParentFullName' => 'required',
            'ParentICno' => 'required',
            'ParentAddress1' => 'required',
            'ParentAddress2' => 'required',
            'ParentPoscode' => 'required',
            'ParentCity' => 'required',
            'ParentState' => 'required',
            'ParentPhoneNo' => 'required',
            'ParentNationality' => 'required',
            'ParentJob' => 'required',
            'ParentIncome' => 'required',
            'OfficeAddress1' => 'required',
            'OfficeAddress2' => 'required',
            'OfficePoscode' => 'required',
            'OfficeCity' => 'required',
            'OfficeState' => 'required'
        ]);

        if ($request->hasFile('ProfileImage')) {
            $destinationPath = public_path('profileImages');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $image = $request->file('ProfileImage');
            $image_name = Str::uuid()->toString() . '.' . $image->getClientOriginalExtension();
            $path = $image->move($destinationPath, $image_name);
            $registerForm['ProfileImage'] = $image_name;
        }

        $student = Students::create($registerForm);
        $student->LastPaymentDate = Carbon::now()->toDateString();

        $learningProgressTable = [
            'students_id' => $student->id,
            'percentage' => $request->input('percentage'),
            'juzuk' => $request->input('juzuk'),
            'page' => $request->input('page'),
            'students_id' => $student->id
        ];

        LearningProgress::create($learningProgressTable);

        $userId = Auth::id();

        $parent = Parents::where('User_ID', $userId)->first();
        if ($parent) {
            $parentId = $parent->id;
        } else {
            $parentId = null;
        }

        $student->parent_id = $parentId;
        $student->save();

        return redirect('/students/approval/'.$student->id.'')->with('success', 'Registration Complete!');
    }

    //show edit registration form
    public function edit(Students $student) {
        $parent = Parents::find($student->Parent_id);
        $learningProgress = $student->learningProgress()->orderBy('updated_at', 'desc')->first();
        $class = Classes::find($student->Class_id);
        $teacher = Teachers::where('id', $class->Teacher_ID)->first();

        return view('students.editStudentRegistration', [
            'student' => $student,
            'parent' => $parent,
            'class' => $class,
            'teacher' => $teacher, 
            'learningProgress' => $learningProgress
        ]);
    }

    // update student data
    public function update(Request $request, $id) {
        // dd($request->all());
        $student = Students::find($id);
        $student->FullName = $request->input('FullName');
        $student->birthCertificateNO = $request->input('birthCertificateNO');
        $student->MyKid = $request->input('MyKid');
        $student->Address1 = $request->input('Address1');
        $student->Address2 = $request->input('Address2');
        $student->Poscode = $request->input('Poscode');
        $student->City = $request->input('City');
        $student->State = $request->input('State');
        $student->DOB = $request->input('DOB');
        $student->Sex = $request->input('Sex');
        $student->PhoneNo = $request->input('PhoneNo');
        $student->Nationality = $request->input('Nationality');
        $student->Disability = $request->input('Disability');
        $student->BillSibling = $request->input('BillSibling');
        $student->AnakKe = $request->input('AnakKe');
        $student->SchoolName = $request->input('SchoolName');
        $student->ParentFullName = $request->input('ParentFullName');
        $student->ParentICno = $request->input('ParentICno');
        $student->ParentAddress1 = $request->input('ParentAddress1');
        $student->ParentAddress2 = $request->input('ParentAddress2');
        $student->ParentPoscode = $request->input('ParentPoscode');
        $student->ParentCity = $request->input('ParentCity');
        $student->ParentState = $request->input('ParentState');
        $student->ParentPhoneNo = $request->input('ParentPhoneNo');
        $student->ParentNationality = $request->input('ParentNationality');
        $student->ParentJob = $request->input('ParentJob');
        $student->ParentIncome = $request->input('ParentIncome');
        $student->OfficeAddress1 = $request->input('OfficeAddress1');
        $student->OfficeAddress2 = $request->input('OfficeAddress2');
        $student->OfficePoscode = $request->input('OfficePoscode');
        $student->OfficeCity = $request->input('OfficeCity');
        $student->OfficeState = $request->input('OfficeState');

        if ($request->hasFile('ProfileImage')) {
            if ($student->ProfileImage != 'ProfileImage' && $student->ProfileImage != null) {
                $path = public_path('profileImages/');
                $file_old = $path . $student->ProfileImage;
                unlink($file_old);
            }
        
            $file = $request->file('ProfileImage');
            $filename = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('profileImages/'), $filename);
        
            $student->update(['ProfileImage' => $filename]);
        }
        
        $student->update();

        return back() ->with('success','Student details updated!');
    }

    //show all student status
    public function approval(Request $request) {
        if (!in_array(Auth::user()->type, ['Headmaster', 'Staff'])) {
            abort(403, 'Unauthorized');
        }         
        
        $searchQuery = $request->input('search');
    
        // Retrieve data for Pending Approval tab with pagination and search query
        $pendingApprovals = Students::where('Status', 'Pending')
            ->where('FullName', 'LIKE', '%' . $searchQuery . '%')
            ->paginate(100);
    
        // Retrieve data for Approved tab with pagination and search query
        $approved = Students::where('Status', 'Active')
            ->where('FullName', 'LIKE', '%' . $searchQuery . '%')
            ->paginate(100);
    
        // Retrieve data for Rejected tab with pagination and search query
        $rejected = Students::where('Status', 'Rejected')
            ->where('FullName', 'LIKE', '%' . $searchQuery . '%')
            ->paginate(100);

        // Check if paginated data is empty before calling count()
        $pendingApprovalsCount = $pendingApprovals->isEmpty() ? 0 : $pendingApprovals->count();
        $approvedCount = $approved->isEmpty() ? 0 : $approved->count();
        $rejectedCount = $rejected->isEmpty() ? 0 : $rejected->count();

        // Get total counts of students with different statuses
        $totalPendingApprovals = Students::where('Status', 'Pending')->count();
        $totalApproved = Students::where('Status', 'Active')->count();
        $totalRejected = Students::where('Status', 'Rejected')->count();

        return view('students.studentApprovalList', compact('pendingApprovals', 'approved', 'rejected', 'pendingApprovalsCount', 'approvedCount', 'rejectedCount', 'totalPendingApprovals', 'totalApproved', 'totalRejected'));
    }

    public function approve(Students $student) {
        $student->status = 'Active';
        $student->RegistrastionFee = 'Unpaid';
    
        // Get the logged-in user's ID
        $userId = Auth::id();
    
        // Find the staff record associated with the user ID
        $staff = Staffs::where('user_id', $userId)->first();
    
        if ($staff) {
            // Set the staff ID in the student record
            $student->staff_id = $staff->id;
            $student->save();
    
            // Create a new payment record
            $payment = new Payments();
            $payment->student_id = $student->id;
            $payment->invoice_id = 'INV-' . $student->id . '-000';
            $payment->invoice_date = now()->format('Y-m-d');
            $payment->amount = 100;
            $payment->month = 'Registration';
            $payment->year = 'Fee';
            $payment->status = 'unpaid';
            $payment->save();
    
            return redirect()->back()->with('success', 'Student status updated to approved!');
        } else {
            // Handle the case where no staff record is found for the logged-in user
            return redirect()->back()->with('error', 'No staff record found for the logged-in user.');
        }
    }
    

    public function reject(Students $student) {
        $student->status = 'Rejected';
        
        // Get the logged-in user's ID
        $userId = Auth::id();
    
        // Find the staff record associated with the user ID
        $staff = Staffs::where('user_id', $userId)->first();
    
        if ($staff) {
            // Set the staff ID in the student record
            $student->staff_id = $staff->id;
            $student->save();
    
            return redirect()->back()->with('success', 'Student status updated to rejected!');
        } else {
            // Handle the case where no staff record is found for the logged-in user
            return redirect()->back()->with('error', 'No staff record found for the logged-in user.');
        }
    }

    // Show student application status as parent
    public function approvalStatus($id) {
        $student = DB::table('students')->where('id', $id)->orderBy('updated_at', 'asc')->first();
        $class = DB::table('classes')->where('id', $student->Class_id)->first();
        return view('students.studentApprovalStatus', compact('student', 'class'));
    }


    //show student learning progess
    public function learning($id) {
        $student = Students::find($id);
        $learningProgress = $student->learningProgress()->orderBy('updated_at', 'desc')->first();
        $class = Classes::find($student->Class_id);
        $teacher = Teachers::where('id', $class->Teacher_ID)->first();
        return view('students.studentLearningProgress', compact('student', 'learningProgress', 'teacher'));
    }

    //show student learning progess as parent
    public function viewLearning($id) {
        $student = Students::find($id);
        $learningProgress = $student->learningProgress()->orderBy('updated_at', 'desc')->first();
        $class = Classes::find($student->Class_id);
        $teacher = Teachers::where('id', $class->Teacher_ID)->first();
    
        return view('students.viewStudentLearningProgress', compact('student', 'learningProgress', 'teacher'));
    }
    

    //show all student
    public function learningList(Request $request) {
        if (Auth::user()->type !== 'Teacher') {
            abort(403, 'Unauthorized');
        }
        
        $class_id = $request->input('option');
        $search = $request->input('search');
        
        $studentsQuery = Students::query()
            ->where('status', 'active')
            ->with('learningProgress', 'teacher', 'class');

        if ($class_id) {
            $studentsQuery->where('Class_id', $class_id);
        }
    
        if ($search) {
            $studentsQuery->where(function ($query) use ($search) {
                $query->where('FullName', 'like', '%' . $search . '%');
            });
        }

        $students = $studentsQuery->latest()->paginate(10);

        $countJuzukTotal = array_fill(1, 30, 0); // Initialize an array to store count for each juzuk

        foreach ($students as $student) {
            foreach ($student->learningProgress as $learningProgress) {
                $juzuk = $learningProgress->juzuk;
                if ($juzuk >= 1 && $juzuk <= 30) {
                    ++$countJuzukTotal[$juzuk]; // Increment count for the corresponding juzuk
                }
            }
        }

        // Ensure all juzuk values have counts, even if 0
        for ($juzuk = 1; $juzuk <= 30; $juzuk++) {
            if (!isset($countJuzukTotal[$juzuk])) {
                $countJuzukTotal[$juzuk] = 0;
            }
        }   

        return view('students.learningProgressList', compact('students', 'countJuzukTotal'));
    }


    public function addLearningProgress(Request $request, Students $student) {
        $juzuk = $request->input('juzuk');
        $page = $request->input('page');
        $percentage = $page / 600 * 100;
        $student_id = $request->input('students_id');
    
        // Find the student by ID
        $student = Students::findOrFail($student_id);
    
        // Create a new learning progress record for the student
        $learningProgress = LearningProgress::create([
            'juzuk' => $juzuk,
            'page' => $page,
            'percentage' => $percentage,
            'students_id' => $student_id,
        ]);
    
        // Associate the learning progress with the student
        $student->learningProgress()->save($learningProgress);
    
        // Retrieve all learning progress records for the student
        $progress = $student->learningProgress;
    
        // Redirect the user to a success page with the progress variable
        return redirect()->back()->with(['success' => 'Student learning progress updated successfully!', 'progress' => $progress]);
    }    

    public function payment(Students $student) {
        $this->middleware('parent.auth');

        $parent = Parents::find($student->Parent_id);
        $class = Classes::find($student->Class_id);
        $teacher = Teachers::where('id', $class->Teacher_ID)->first();
        
        $unpaidPayments = Payments::where('student_id', $student->id)
            ->where('status', 'unpaid')
            ->get();

        $paidPayments = Payments::where('student_id', $student->id)
            ->where('status', 'paid')
            ->get();

        $unpaidFees = [];
        foreach ($unpaidPayments as $payment) {
            $unpaidFees[] = (object) [
                'invoice_id' => $payment['invoice_id'],
                'month' => $payment['month']. ' '.$payment['year'],
                'year' => Carbon::parse($payment['invoice_date'])->format('Y'),
                'amount' => $payment['amount']
            ];
        }

        $paidFees = [];
        foreach ($paidPayments as $payment) {
            $paidFees[] = (object) [
                'invoice_id' => $payment['invoice_id'],
                'month' => $payment['month']. ' '.$payment['year'],
                'year' => Carbon::parse($payment['invoice_date'])->format('Y'),
                'amount' => $payment['amount']
            ];
        }

        return view('students.paymentStudent', [
            'student' => $student,
            'parent' => $parent,
            'teacher' => $teacher,
            'class' => $class,
            'unpaidFees' => $unpaidFees,
            'paidFees' => $paidFees,
        ]);
    }

    
    public function paymentCheckout(Students $student, $invoice_id) {
        $this->middleware('parent.auth');

        $parent = Parents::find($student->Parent_id);
        $class = Classes::find($student->Class_id);
        $teacher = Teachers::where('id', $class->Teacher_ID)->first();
        
        $payment = Payments::where('student_id', $student->id)
                        ->where('invoice_id', $invoice_id)
                        ->first();

        return view('students.paymentChecout', [
            'student' => $student,
            'parent' => $parent,
            'teacher' => $teacher,
            'class' => $class,
            'payment' =>$payment
        ]);
    }
    
    public function generateReceipt($studentId, $invoiceId) {
        $this->middleware('parent.auth');
    
        $student = Students::find($studentId);
        $parent = Parents::find($student->Parent_id);
        $class = Classes::find($student->Class_id);
        $teacher = Teachers::where('id', $class->Teacher_ID)->first();
        $user = User::find($parent->User_ID);
        $payment = Payments::where('invoice_id', $invoiceId)->first();
    
        return view('students.receipt', [
            'student' => $student,
            'parent' => $parent,
            'class' => $class,
            'teacher' => $teacher,
            'user' => $user,
            'payment' => $payment
        ]);
    }    
    

    //delete studenet details
    public function destroy($id) {
        Students::destroy($id);

        return redirect()->back() ->with('info','Students details deleted successfully!');
    }
}
