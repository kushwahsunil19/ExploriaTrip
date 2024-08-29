<?php

namespace App\Http\Controllers;

use Stevebauman\Location\Facades\Location;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserOtp;
use App\Models\Subscriber;
use App\Models\AdminUsers;
use App\Models\Countries;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Mail;
use App\Mail\ExploriatripMail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Carbon\Carbon;
// use Jorenvh\Share\Share;

class ExploriaController extends Controller
{

  ////////////////////////////////////// User-End Functions//////////////////////////

  public function index(Request $request)
  {
    $country = Countries::get();
    $locationIP = $request->ip();
   // dd($locationIP);
    $currentUserInfo = Location::get($locationIP);
    $cookie = Cookie::get();

    $currentCountryCode = $currentUserInfo->countryCode;
    $CurrentCurrency = $currentUserInfo->countryCode;
    $CurrentCountry = $currentUserInfo->countryName;
    if (array_key_exists("CurrentCountry",$cookie)) {
      return view('web.dashboard.exploriatrip', [
          'country' => $country,
          'CurrentCountry' => $CurrentCountry,
          'currentCountryCode' => $currentCountryCode,
          'CurrentCurrency' => $CurrentCurrency
      ]);
    } else {

      setcookie("CurrentCurrency", $currentUserInfo->countryCode, time() + 3600);
      setcookie("CurrentCountry", $currentUserInfo->countryName, time() + 3600);
      return view('web.dashboard.exploriatrip', [
          'country' => $country,
          'CurrentCountry' => $CurrentCountry,
          'currentCountryCode' => $currentCountryCode,
          'CurrentCurrency' => $CurrentCurrency
      ]);
    }
  }
  public function autoComplete(Request $request){
    $query = $request->get('query');
    
    $url = 'https://api.tequila.kiwi.com/locations/query';
    $queryParams = [
      "term" => $query,
      "locale" => "en-US",
      "location_types" => "airport",
      "limit" => 10,
      "active_only" => true,
    ];
    $headers = [ "accept" => "application/json" ,'apikey' => 'rxBlI0XMHzgplh6d9D7bPpGEeykS_LCj' ];
    $response = Http::withHeaders($headers)->get($url, $queryParams);
    $responseData = $response->json();
    return $responseData;
    // $output = '';
    // if(count($responseData) > 0){
    //   $output = "<ul class='list-group' style='display:relative; z-index:1;'>";
    //   foreach($responseData as $key => $value){
    //     $a = 0;
    //    print_r($value);
    //    $output = "<li class='list-group-item' ></li>";
    //    $a++;
    //   }
    //   $output .= "</ul>";
    // }else{
    //  $output = "<li class='list-group-item' >Not Found</li>";
    // }
    //  dd($responseData);
    // return $output;
  }
  public function hotel(Request $request)
  {
    $country = Countries::get();
    $locationIP = $request->ip();
    $currentUserInfo = Location::get($locationIP);
    $CurrentCountry = $currentUserInfo->countryName;
    $CurrentCurrency = $currentUserInfo->countryCode;
    return view('web.hotel.hotel', [
      'country' => $country,
      'CurrentCountry' => $CurrentCountry,
      'CurrentCurrency' => $CurrentCurrency
    ]);
  }

  public function searchHotel(Request $request)
  {
    $country = Countries::get();
    $HotelCityDestination = $request->get('HotelCityDestination');
    $HotelDateCheckIn = $request->get('HotelDateCheckIn');
    $HotelDateCheckOut = $request->get('HotelDateCheckOut');
    $HotelAdultSlct = $request->get('HotelAdultSlct');
    $HotelChildSlct = $request->get('HotelChildSlct');
    $locationIP = $request->ip();
    $currentUserInfo = Location::get($locationIP);
    $CurrentCountry = $currentUserInfo->countryName;
    $CurrentCurrency = $currentUserInfo->countryCode;

    return view('web.hotel.HotelSearchResult', [
      'country' => $country,
      'HotelCityDestination' => $HotelCityDestination,
      'HotelDateCheckIn' => $HotelDateCheckIn,
      'HotelDateCheckOut' => $HotelDateCheckOut,
      'HotelAdultSlct' => $HotelAdultSlct,
      'HotelChildSlct' => $HotelChildSlct,
      'CurrentCountry' => $CurrentCountry,
      'CurrentCurrency' => $CurrentCurrency
    ]);
  }

  ///////////////////////////////////////Contact & Support Page function///////////////////////////////////////////////


  public function contact(Request $request)
  {
    $country = Countries::get();
    $locationIP = $request->ip();
    $currentUserInfo = Location::get($locationIP);
    $CurrentCountry = $currentUserInfo->countryName;
    $CurrentCurrency = $currentUserInfo->countryCode;
    return view('web.content.contact', [
      'country' => $country,
      'CurrentCountry' => $CurrentCountry,
      'CurrentCurrency' => $CurrentCurrency
    ]);
  }

  public function contact_details(Request $request)
  {
    $details = [
      'username' => $request->fullname,
      'title' => "Testing Purpose",
      'body' => $request->message
    ];
    Mail::to($request->email)->send(new ExploriatripMail($details));
    return array('success' => 'Mail Send SuccessFully');
  }

  public function car(Request $request)
  {
    $country = Countries::get();
    $locationIP = $request->ip();
    $currentUserInfo = Location::get($locationIP);
    $CurrentCountry = $currentUserInfo->countryName;
    $CurrentCurrency = $currentUserInfo->countryCode;
    return view('web.car.car', [
      'country' => $country,
      'CurrentCountry' => $CurrentCountry,
      'CurrentCurrency' => $CurrentCurrency
    ]);
  }

  public function searchCar(Request $request)
  {
    $CarSectPickUp = $request->get('CarSectPickUp');
    $CarSectPickUpDate = $request->get('CarSectPickUpDate');
    $CarSectPickUpTime = $request->get('CarSectPickUpTime');
    $CarSectDropOff = $request->get('CarSectDropOff');
    $CarSectDropOffDate = $request->get('CarSectDropOffDate');
    $CarSectDropOffTime = $request->get('CarSectDropOffTime');
    $country = Countries::get();
    $locationIP = $request->ip();
    $currentUserInfo = Location::get($locationIP);
    $CurrentCountry = $currentUserInfo->countryName;
    $CurrentCurrency = $currentUserInfo->countryCode;
    return view(
      'web.car.CarSearchResult',
      [
        'country' => $country,
        'CurrentCountry' => $CurrentCountry,
        'CurrentCurrency' => $CurrentCurrency,
        'CarSectPickUp' => $CarSectPickUp,
        'CarSectPickUpDate' => $CarSectPickUpDate,
        'CarSectPickUpTime' => $CarSectPickUpTime,
        'CarSectDropOff' => $CarSectDropOff,
        'CarSectDropOffDate' => $CarSectDropOffDate,
        'CarSectDropOffTime' => $CarSectDropOffTime
      ]
    );
  }
  public function cruise(Request $request)
  {
    $country = Countries::get();
    $locationIP = $request->ip();
    $currentUserInfo = Location::get($locationIP);
    $CurrentCountry = $currentUserInfo->countryName;
    $CurrentCurrency = $currentUserInfo->countryCode;
    return view('web.cruise.cruise', [
      'country' => $country,
      'CurrentCountry' => $CurrentCountry,
      'CurrentCurrency' => $CurrentCurrency,

    ]);
  }

  public function searchCruise(Request $request)
  {
    $country = Countries::get();
    $CruiseSectGoingTo = $request->get('CruiseSectGoingTo');
    $CriuseDepartAsEarlyAs = $request->get('CriuseDepartAsEarlyAs');
    $CriuseDepartAsLateAs = $request->get('CriuseDepartAsLateAs');
    $CruiseCabinAdlut = $request->get('CruiseCabinAdlut');
    $CruiseCabinChild = $request->get('CruiseCabinChild');
    $locationIP = $request->ip();
    $currentUserInfo = Location::get($locationIP);
    $CurrentCountry = $currentUserInfo->countryName;
    $CurrentCurrency = $currentUserInfo->countryCode;
    return view('web.cruise.CruiseSearchResult', [
      'country' => $country,
      'CruiseSectGoingTo' => $CruiseSectGoingTo,
      'CriuseDepartAsEarlyAs' => $CriuseDepartAsEarlyAs,
      'CriuseDepartAsLateAs' => $CriuseDepartAsLateAs,
      'CruiseCabinAdlut' => $CruiseCabinAdlut,
      'CruiseCabinChild' => $CruiseCabinChild,
      'CurrentCountry' => $CurrentCountry,
      'CurrentCurrency' => $CurrentCurrency
    ]);
  }

  public function about(Request $request)
  {
    $country = Countries::get();
    $locationIP = $request->ip();
    $currentUserInfo = Location::get($locationIP);
    $CurrentCountry = $currentUserInfo->countryName;
    $CurrentCurrency = $currentUserInfo->countryCode;
    return view('web.content.about', [
      'country' => $country,
      'CurrentCountry' => $CurrentCountry,
      'CurrentCurrency' => $CurrentCurrency
    ]);
  }

  public function services(Request $request)
  {
    $country = Countries::get();
    $locationIP = $request->ip();
    $currentUserInfo = Location::get($locationIP);
    $CurrentCountry = $currentUserInfo->countryName;
    $CurrentCurrency = $currentUserInfo->countryCode;
    return view('web.content.services', [
      'country' => $country,
      'CurrentCountry' => $CurrentCountry,
      'CurrentCurrency' => $CurrentCurrency
    ]);
  }
  public function userdashboard(Request $request)
  {
    $country = Countries::get();
    $locationIP = $request->ip();
    $currentUserInfo = Location::get($locationIP);
    $CurrentCountry = $currentUserInfo->countryName;
    $CurrentCurrency = $currentUserInfo->countryCode;
    return view('web.user-profile.user-profile', [
      'country' => $country,
      'CurrentCountry' => $CurrentCountry,
      'CurrentCurrency' => $CurrentCurrency
    ]);
  }
  public function user_booking(Request $request)
  {
    $country = Countries::get();
    $locationIP = $request->ip();
    $currentUserInfo = Location::get($locationIP);
    $CurrentCountry = $currentUserInfo->countryName;
    $CurrentCurrency = $currentUserInfo->countryCode;
    return view('web.booking.user-dashboard-booking', [
      'country' => $country,
      'CurrentCountry' => $CurrentCountry,
      'CurrentCurrency' => $CurrentCurrency
    ]);
  }
  /////////////////////////User Signup & Login Functions /////////////////////////////////////////

  public function signup(Request $request)
  {
    $country = Countries::get();
    $locationIP = $request->ip();
    $currentUserInfo = Location::get($locationIP);
    $CurrentCountry = $currentUserInfo->countryName;
    $CurrentCurrency = $currentUserInfo->countryCode;
    return view('web.auth.signup', [
      'country' => $country,
      'CurrentCountry' => $CurrentCountry,
      'CurrentCurrency' => $CurrentCurrency
    ]);
  }

  public function generate(Request $request)
  {
    $request->validate([
      'mobile_no' => 'required',
    ]);
    $mobile_no = $request->mobile_no;
    $userOtp = $this->generateOtp($mobile_no);
    return $userOtp->sendSMS($mobile_no);;
  }




  public function generateOtp($mobile_no)
  {
    $user = User::where('mobileno', $mobile_no)->first();
    // $userOtp = UserOtp::where('user_id', $user->id)->latest()->first();

    $now = now();
    // if ($userOtp && $now->isBefore($userOtp->expired_at)) {
    //   return $userOtp;
    // }

    return UserOtp::create([
      // 'user_id' => $user->id,
      'otp' => rand(123456, 999999),
      'expired_at' => $now->addMinutes(10),
    ]);
  }


  public function verifyotp(Request $request)
  {
    $request->validate([
      'otp' => 'required'
    ]);

    //  print_r($request->all());
    $now = now();
    if ($request->otp) {
      $userCheck = UserOtp::where('otp', $request->otp)->first();
    } else {
      $userCheck = '';
    }
    if ($userCheck != '') {
      if ($userCheck->otp == $request->otp && !$now->isAfter($userCheck->expired_at)) {
        return array('success' => 'Successfully OTP Verified');
      } else {
        return array('error' => 'OTP is Expired ');
      }
    } else {
      return array('password_incorrect' => 'OTP is Incorrect');
    }
  }

  public function register(Request $request)
  {
    $request->validate([
      'firstname' => 'required',
      'lastname' => 'required',
      'email' => 'required',
      'password' => 'required',
      'address' => 'required',
    ]);

    $user = new User;
    $user->firstname = $request->firstname;
    $user->lastname = $request->lastname;
    $user->email = $request->email;
    $user->mobileno = $request->mobile_no;
    $user->password = password_hash($request->password, PASSWORD_DEFAULT);
    $user->address = $request->address;
    if (isset($request->subscribe)) {
      $user->subscribe = isset($request->subscribe);
    }
    $user->save();
    if (isset($request->subscribe)) {
      $create_subscribe =  new Subscriber;
      $create_subscribe->email = $request->email;
      $create_subscribe->save();
    }
    Session::put([
      'id' => $user->id,
      'firstname' => $user->firstname,
      'lastname' => $user->lastname,
      'email'    => $user->email,
      'mobileno' => $user->mobileno,
      'address' => $user->address
    ]);
    return array('success' => 'SuccessFully Registered');
  }

  public function user_login(Request $request)
  {
    if ($request->email) {
      $user = User::where('email', $request->email)->first();
    } else {
      $user = '';
    }
    if ($user) {

      $credentials = [
        'email' => $request->email,
        'password' => $request->password,
      ];

      if (Auth::attempt($credentials)) {
        Session::put([
          'id' => $user->id,
          'firstname' => $user->firstname,
          'lastname' => $user->lastname,
          'email'    => $user->email,
          'mobileno' => $user->mobileno,
          'address' => $user->address
        ]);
        return redirect('/user_dashboard')->with('success', 'Login Successfully');
      } else {

        return back()->with('wrong', 'Please Check Your Password Is Incorrect');
      }
    } else {
      return back()->with('error', 'Please Check Your Email Is Incorrect');
    }
  }

  public function user_dashboard(Request $request)
  {
    $country = Countries::get();
    $locationIP = $request->ip();
    $currentUserInfo = Location::get($locationIP);
    $CurrentCountry = $currentUserInfo->countryName;
    $CurrentCurrency = $currentUserInfo->countryCode;
    return view('web.user-profile.user-profile', [
      'country' => $country,
      'CurrentCountry' => $CurrentCountry,
      'CurrentCurrency' => $CurrentCurrency
    ]);
  }

  public function editProfile(Request $request, $id)
  {
    $id = base64_decode(Session::get($id));
    $country = Countries::get();
    $locationIP = $request->ip();
    $currentUserInfo = Location::get($locationIP);
    $CurrentCountry = $currentUserInfo->countryName;
    $CurrentCurrency = $currentUserInfo->countryCode;
    return view('web.user-profile.edit-profile', [
      'id' => $id,
      'country' => $country,
      'CurrentCountry' => $CurrentCountry,
      'CurrentCurrency' => $CurrentCurrency
    ]);
  }

  public function updateProfile(Request $request, $id)
  {
    $data = array(
      'firstname' => $request->firstname,
      'lastname' => $request->lastname,
      'mobileno' => $request->mobileno,
      'email' => $request->email,
      'address' => $request->address,
    );

    Session::put([
      'firstname' => $request->firstname,
      'lastname' => $request->lastname,
      'email'    => $request->email,
      'mobileno' => $request->mobileno,
      'address' => $request->address
    ]);
    $getId = User::where('id', $id)->update($data);
    return redirect('/')->withsuccess('Profile Updated Succcessfully');
  }

  public function subscriber(Request $request)
  {
    if ($request->email) {
      $Subscriber = Subscriber::where('email', $request->email)->first();
      if (!$Subscriber) {
        Subscriber::create(
          ['email' => $request->email]
        );
        return array('success' => 'Thank you for subscribing ');
      } else {
        return array('exist' => 'Email Subscribed Already');
      }
    } else {
      return array('error' => 'Please Enter Your Email ');
    }
  }

  /////////////////////////// Login & Signup From Google Auth////////////////////////////////////////////////////////////


  public function redirectToGoogle()
  {
    return Socialite::driver('google')->redirect();
  }
  public function handleGoogleCallback(Request $request)
  {

    try {

      $user = Socialite::driver('google')->user();
      $saveUser = User::where('email', $user->getEmail())->first();
      if (!$saveUser) {
        User::updateorCreate(
          [
            'google_id' => $user->getId(),
            'firstname' => $user->user['given_name'],
            'lastname' =>  $user->user['family_name'],
            'email'  => $user->getEmail(),
            'password' => Hash::make($user->getName() . '@' . $user->getId()),
            'subscribe' => 1,
          ]
        );
        $usersdata = User::where('google_id', $user->getId())->first();

        Session::put([
          'id' => $usersdata->id,
          'firstname' => $usersdata->firstname,
          'lastname' => $usersdata->lastname,
          'email'    => $usersdata->email,
          'mobileno' => $usersdata->mobileno,
          'address' => $usersdata->address
        ]);
        return redirect('/user_dashboard')->with('success', $usersdata);
      } else {
        User::where('email', $user->getEmail())->update([
          'google_id' => $user->getId()
        ]);
        $loginUser = User::where('email', $user->getEmail())->first();
        Auth::loginUsingId($loginUser->id);
        Session::put([
          'id' => $loginUser->id,
          'firstname' => $loginUser->firstname,
          'lastname' => $loginUser->lastname,
          'email'    => $loginUser->email,
          'mobileno' => $loginUser->mobileno,
          'address' => $loginUser->address
        ]);
        return redirect('/user_dashboard')->with('success', 'Login  Successfully');
      }
    } catch (Exception $e) {
      dd($e->getMessage());
    }
  }

  //////////////////////////////////////////////Admin Login & other Functions ///////////////////////////////////////////////


  public function admin_login()
  {
    return view("admin.auth.login");
  }

  public function login_verification(Request $request)
  {
    $user = AdminUsers::where('username', '=', $request->username)->first();
    if ($user) {
      if ($user->password == $request->password) {
        session()->put(
          'id',
          $user->id,
          'firstname',
          $user->firstname,
          'lastname',
          $user->lastname
        );
        if ($request->remember == '1') {
          setcookie("username", $request->username, time() + 3600);
          setcookie("password", $request->password, time() + 3600);
        } else {
          setcookie("username", "");
          setcookie("password", "");
        }
        return array('success' => 'Login Successfully');
      } else {
        return array('fail' => 'please check password');
      }
    } else {
      return array('error' => 'please check Username ');
    }
  }

  public function dashboard(Request $request)
  {
    $user = AdminUsers::where('id', $request->session()->get('id'))->first();
    // print_r($user);
    if ($user) {
      return view('admin.dashboard.admin-dashboard', ['user' => $user]);
    } else {
      return redirect('/magic')->with('error', 'Please Login First');
    }
  }

  public function user_management()
  {
    return view('admin-dashboard-user-management');
  }

  public function travellers(Request $request)
  {
    $user = AdminUsers::where('id', $request->session()->get('id'))->first();
    $users = User::get();
    if ($user) {
      return view('admin.traveller.admin-dashboard-travellers', ['user' => $user, 'users' => $users]);
    } else {
      return redirect('/magic')->with('error', 'Please Login First');
    }
  }
  public function travellers_view($id, Request $request)
  {
    $user = AdminUsers::where('id', $request->session()->get('id'))->first();
    $users = User::where('id', $id)->first();
    if ($user) {
      return view('admin.traveller.admin-dashboard-traveler-detail', ['user' => $user, 'users' => $users]);
    } else {
      return redirect('/magic')->with('error', 'Please Login First');
    }
  }
  public function travellers_edit($id, Request $request)
  {
    $user = AdminUsers::where('id', $request->session()->get('id'))->first();
    $users = User::where('id', $id)->first();
    if ($user) {
      return view('admin.traveller.admin-dashboard-travellers-edit', ['user' => $user, 'users' => $users]);
    } else {
      return redirect('/magic')->with('error', 'Please Login First');
    }
  }
  public function travellers_update(Request $request)
  {
    $user = User::where('id', $request->id)->first();
    // print_r($user);
    $user->firstname = $request->firstname;
    $user->lastname = $request->lastname;
    $user->email = $request->email;
    $user->mobileno = $request->mobileno;
    $user->address = $request->address;
    $user->save();
    return array('success' => 'Traveller Updated Successfully');
  }

  public function travellers_delete(Request $request)
  {
    $user = User::where('id', $request->id)->first();
    $user->delete();
    return back()->with('success', 'Traveller Deleted Successfully');
  }
  public function flushSession(Request $request)
  {
    $request->session()->flush();

    return redirect('/');
  }
}
