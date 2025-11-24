<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
class AuthController extends Controller
{
    public function sendSMS($verifyData) {
        $phone       = $verifyData["phone"];
        $message = $verifyData["message"];

        $url  = "https://a2p.solutionsclan.com/api/sms/send";
        $data = [
            "apiKey"         => "A000092b606144c-5cc3-4399-b167-2395f919e004",
            "type"           => "Text",
            "contactNumbers" => $phone,
            "senderId"       => "BulkSms",
            "textBody"       => $message,
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $response = curl_exec($ch);

        curl_close($ch);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|min:10|max:15|unique:students,phone',
            'password' => 'required|string|min:6',
            // |confirmed
            // 'email' => 'nullable|string|email|max:255|unique:students',
            // 'institution' => 'nullable|string|max:255',
            // 'batch' => 'nullable|string|max:255',
            // 'course' => 'nullable|string|max:255',
        ]);

        // If validation fails, return the validation errors as a response
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'error' => $validator->errors()->first()
            ], 422); // Unprocessable Entity (422) status code
        }

        $verifyToken = rand(111111, 999999);
        $student = Student::create([
            'name' => $request->name,
            'phone' => $request->phone,
            // 'email' => $request->email,
            'password' => Hash::make($request->password),
            'verifyToken' => $verifyToken,
            // 'institution' => $request->institution,
            // 'batch' => $request->batch,
            // 'course' => $request->course,
        ]);

        $verifyData["message"] = "Dear {$student->name}\r\nSuccessfully boarded your account. Your verified token is {$student->verifyToken}.\r\n Regards,\r\n Rivaliz Academy";
        $verifyData["phone"]       = $student->phone;
        // $this->sendSMS($verifyData);

        // $token = auth('api')->login($student);
        // Use 'api' guard

        return response()->json([
            'message' => 'Registration successful. Verify your account',
            'student' => $student,
            'verifyToken' => $verifyToken,
        ], 201);
    }

    public function verify(Request $request) {
        $phone = $request->phone;

        $student = Student::where('phone', $phone)->first();

        if ($student->verifyToken != $request->otp) {
            return response()->json(['error' => 'Invalid otp'], 401);
        }

        $student->verifyToken = 1;
        $student->save();

        return response()->json(['success' => "Accound verified. Please login"], 200);
    }

    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     if (!$token = auth('api')->attempt($credentials)) {  // Use 'api' guard
    //         return response()->json(['error' => 'Invalid credentials'], 401);
    //     }

    //     return response()->json(compact('token'));
    // }

    public function resendLoginOtp(Request $request) {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|exists:students,phone'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first()
            ], 422);
        }
        $student = Student::where('phone', $request->phone)->first();
        if ($student->verifyToken != 1) {

            $verifyToken          = rand(111111, 999999);
            $student->verifyToken = $verifyToken;
            $student->save();

            $verifyData["message"] = "Dear {$student->name}\r\nSuccessfully boarded your account. Your verified token is {$student->verifyToken}.\r\n Regards,\r\n Rivaliz Academy";
            $verifyData["phone"]       = $student->phone;
            // $this->sendSMS($verifyData);

            return response()->json([
                'success' => 'Please Verify your account with new token',
                'verifyToken' => $verifyToken,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Your account is already verified. Please login.'
            ], 200);
        }
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|exists:students,phone',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first()
            ], 422); // Unprocessable Entity (422) status code
        }
        $student = Student::where('phone', $request->phone)->first();
        if ($student->verifyToken != 1) {

            $verifyToken          = rand(111111, 999999);
            $student->verifyToken = $verifyToken;
            $student->save();

            $verifyData["message"] = "Dear {$student->name}\r\nSuccessfully boarded your account. Your verified token is {$student->verifyToken}.\r\n Regards,\r\n Rivaliz Academy";
            $verifyData["phone"]       = $student->phone;
            // $this->sendSMS($verifyData);

            return response()->json([
                'error' => 'Please Verify your account with new token',
                'verifyToken' => $verifyToken,
            ], 401);
        }
        $credentials = $request->only('phone', 'password');

        if (!$token = auth('api')->attempt($credentials)) {  // Use 'api' guard
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
        ], 200);
    }


    public function googlelogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);

        // Check if the email exists in the 'students' table
        $student = \App\Models\Student::where('email', $request->email)->first();

        if (!$student) {
            return response()->json(['error' => 'Email not found'], 404);
        }

        // Issue a token (You may create a token based on the email)
        $token = auth('api')->login($student); // Assuming you're using JWT or similar

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
        ], 200);
    }


    public function logout()
    {
        auth('api')->logout();  // Use 'api' guard
        return response()->json(['message' => 'Successfully logged out']);
    }


    public function profile()
    {
        // 1. Authenticate
        $student = auth('api')->user();
        if (! $student) {
            return response()->json([
                'message' => 'Unauthorized. Invalid or missing token.',
            ], 401);
        }

        // $enrolledCourses = $student->enrolledCourses()
        // ->with('modules') // make sure modules are eager loaded
        // ->get()
        // ->map(function ($course) {
        //     $totalModules = $course->modules->count();
        //     $completedModules = $course->pivot ? $course->pivot->module_completed : 0;


        //     $adjustedCompletedModules = $completedModules <= 1 ? 0 : $completedModules;

        //     $completionPercentage = 0;
        //     if ($totalModules > 0) {
        //         $completionPercentage = round(min(($adjustedCompletedModules / $totalModules) * 100, 100));
        //     }

        //     $course->module_completed_percentage = $completionPercentage;
        //     $course->module_completed = $completedModules;

        //     unset($course->pivot);
        //     unset($course->modules);
        //     return $course;
        // });
        // 6. Return JSON
        return response()->json([
            'student'             => $student
            // 'enrolled_courses' => $enrolledCourses,
        ], 200);
    }


    public function updateProfile(Request $request) {
        $user = auth('api')->user(); // Get the authenticated student

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|min:10|max:15|unique:students,phone,' . $user->id,
            'institution' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
     // Handle image upload if present
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $uniqueName = str_replace('.', '', microtime(true)) . '.' . $image->getClientOriginalExtension(); // Like 1828999340892478.png
            $path = 'images/student';
            $image->move(public_path($path), $uniqueName);

            $user->image = $path . '/' . $uniqueName;
        }

        // Only update non-null fields from request
        $fields = ['name', 'phone', 'institution'];
        foreach ($fields as $field) {
            if ($request->filled($field)) {
                $user->$field = $request->$field;
            }
        }

        $user->save();
        return response()->json([
            'message' => 'Profile updated successfully',
            'student' => $user
        ]);
    }

    public function resendPasswordOtp(Request $request) {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|min:10|max:15|exists:students,phone',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first()
            ], 422);
        }
        $student = Student::where('phone', $request->phone)->first();

        $passresetToken          = rand(111111, 999999);
        $student->passresetToken = $passresetToken;
        $student->save();

        $verifyData["message"] = "Password Reset token is {$student->passresetToken}.\r\n Regards,\r\n Rivaliz Academy";
        $verifyData["phone"]       = $student->phone;
        // $this->sendSMS($verifyData);

        return response()->json([
            'success' => 'Use New token to reset your password',
            'passresetToken' => $passresetToken
        ]);
    }

    public function forgotPassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|min:10|max:15|exists:students,phone',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first()
            ], 422);
        }
        $student = Student::where('phone', $request->phone)->first();

        $passresetToken          = rand(111111, 999999);
        $student->passresetToken = $passresetToken;
        $student->save();

        $verifyData["message"] = "Password Reset token is {$student->passresetToken}.\r\n Regards,\r\n Rivaliz Academy";
        $verifyData["phone"]       = $student->phone;
        // $this->sendSMS($verifyData);

        return response()->json([
            'success' => 'Use token to reset your password',
            'passresetToken' => $passresetToken
        ]);
    }

    public function resetpassword(Request $request){
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|min:10|max:15|exists:students,phone',
            'password' => 'required|string|min:6',
            'passresetToken' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first()
            ], 422);
        }
        $student = Student::where('phone', $request->phone)->first();

        if ($student->passresetToken != $request->passresetToken) {
            return response()->json(['error' => 'Invalid token'], 401);
        }

        $student->password    = Hash::make($request->password);
        $student->passresetToken = 1;
        $student->save();

        return response()->json(['success' => "Password reset successfull. Please login"], 200);
    }
}
