<?php

namespace App\Http\Controllers;

use App\Models\QrCode;
use App\Models\User;
use BaconQrCode\Writer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use BaconQrCode\Renderer\ImageRenderer;
use Illuminate\Support\Facades\Session;
use BaconQrCode\Common\ErrorCorrectionLevel;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;

class publicController extends Controller
{
    public function index(){


        return view('public.index');
    }

    public function publicUserLogin(){

        if(Auth::check()){
            return redirect()->route('setDashboard');
        }else{
            return view('public.userLogin');
        }
    }

    public function requestOtp(Request $request){

        $request->validate([
            'phone_number' => 'required|numeric',
        ]);
    
        $phone = $this->formatPhoneNumber($request->input('phone_number'));
    
        $otp = $this->generateOtp();
    
        $this->sendOtpSms($otp, $phone);
    
        $request->session()->put('otp', $otp);
        Session::put('phone_number', $phone);

        return redirect()->route('confirmOtp');

    }

    private function generateOtp()
    {
        return rand(100000, 999999);
    }

    private function formatPhoneNumber($rawPhoneNumber)
    {
        $numericPhoneNumber = preg_replace('/[^0-9]/', '', $rawPhoneNumber);

        if (strlen($numericPhoneNumber) == 10 && substr($numericPhoneNumber, 0, 1) == '0') {
            return '94' . substr($numericPhoneNumber, 1);
        } elseif (strlen($numericPhoneNumber) == 12 && substr($numericPhoneNumber, 0, 3) == '940') {
            return '94' . substr($numericPhoneNumber, 3);
        } elseif (strlen($numericPhoneNumber) == 11 && substr($numericPhoneNumber, 0, 1) == '0') {
            return '94' . substr($numericPhoneNumber, 1);
        } elseif (strlen($numericPhoneNumber) == 9) {
            return '94' . $numericPhoneNumber;
        } elseif (strlen($numericPhoneNumber) == 11) {
            return $numericPhoneNumber;
        }

        return $rawPhoneNumber;
    }

    private function sendOtpSms($otp, $phone){

        $user_id = "26373";
        $api_key = "SjAR7q9dPPuR8Ecb2uzm";
        $message = "-Parking HUB- Dear User, Your Login Verfication Code Is,  $otp. Thank You!";
        $to = $phone;
        $sender_id = "SkyGate";

        $api_url = "https://app.notify.lk/api/v1/send";

        try {
            $response = Http::get($api_url, [
                'user_id' => $user_id,
                'api_key' => $api_key,
                'message' => $message,
                'to' => $to,
                'sender_id' => $sender_id,
            ]);

            // Log the response
            $logMessage = "Notify.lk SMS Response for student {$phone}: " . json_encode($response->json());
            \Illuminate\Support\Facades\Log::info($logMessage);

            if ($response->successful()) {
                // SMS sent successfully
                // You may log this or perform additional actions
            } else {
                // SMS sending failed
                // You may log this or handle errors
                // $response->status(), $response->body(), etc.
            }
        } catch (\Exception $e) {
            // Log any exceptions that might occur during the HTTP request
            \Illuminate\Support\Facades\Log::error('Exception during Notify.lk SMS request: ' . $e->getMessage());
        }

    }

    public function confirmOtp(){



        return view('public.confirmOtp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'num-1' => 'required|numeric',
            'num-2' => 'required|numeric',
            'num-3' => 'required|numeric',
            'num-4' => 'required|numeric',
            'num-5' => 'required|numeric',
            'num-6' => 'required|numeric',
        ]);

        $otp = $request->input('num-1') . $request->input('num-2') . $request->input('num-3') .
            $request->input('num-4') . $request->input('num-5') . $request->input('num-6');

        $sessionPhoneNumber = Session::get('phone_number');
        $sessionOtp = Session::get('otp');

        $customer = User::where('phone', $sessionPhoneNumber)->first();

        if ($customer && $sessionOtp == $otp) {

            if(Auth::check()){
                return redirect()->route('setDashboard');
            }else{

            auth()->login($customer);

            Session::forget('otp'); 
            return redirect()->route('setDashboard');

            }

        } elseif (!$customer && $sessionOtp == $otp) {

            Session::forget('otp'); 
            return redirect()->route('customerRegister');
        } else {
            return redirect()->back()->withErrors(['error' => 'Invalid OTP']);
        };
    }

    public function customerRegister(){

        $phoneNumber = Session::get('phone_number');

        return view('public.register', compact('phoneNumber') );
    }

    public function registeAuthCustomer(Request $request)
    {
        // Assuming you have the necessary validation for registration fields
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'email|unique:users',
        ]);

        $phoneNumber = Session::get('phone_number');

        // Generate a random password
        $randomPassword = Str::random(10); 

        // Create a new user
        $customer = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($randomPassword), // Hash the password
            'phone' => $phoneNumber,
        ]);

        $customer->assignRole('User');


        $qrCodeContent = $customer->id; // You can use any unique identifier here
        $qrCodePath = $this->generateQRCode($qrCodeContent);
        

        $qrCode = QrCode::create([
            'customer_id' => $customer->id,
            'qr_code_path' => $qrCodePath,
        ]);

        if (Auth::check()) {

            $notification = [
                'message' => 'Customer Created Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('setDashboard')->with($notification);

        } else {
            Auth::login($customer);
            return redirect()->route('userDashboard');
        }
    }

    private function generateQRCode($content)
    {
        $storagePath = storage_path('app/public/qr_codes');

        if (!file_exists($storagePath)) {
            mkdir($storagePath, 0777, true);
        }

        $qrCodeFileName = uniqid() . '.png';

        $qrCodeFilePath = $storagePath . '/' . $qrCodeFileName;

        $imageBackEnd = new ImagickImageBackEnd();
        
        $renderer = new ImageRenderer(
            new RendererStyle(400),
            $imageBackEnd
        );

        $errorCorrectionLevel = ErrorCorrectionLevel::H()->getBits();

        // Use the integer value for the error correction level
        $writer = new Writer($renderer, $errorCorrectionLevel);

        $writer->writeFile($content, $qrCodeFilePath);

        // Remove the system path from the file path
        $relativePath = str_replace(storage_path('app/public'), '', $qrCodeFilePath);

        return $relativePath;
    }

}
