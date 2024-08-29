<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserOtp;
use App\Models\Subscriber;
use App\Models\AdminUsers;
use App\Models\Countries;
use Session;
use Illuminate\Support\Facades\Hash;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Mail;
use App\Mail\ExploriatripMail;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\Http\Controllers\ExploriaController;
use Illuminate\Support\Facades\Cookie;

class FlightController extends Controller
{
  public function locate(Request $request)
  {
    $locationIP = $request->ip();
    $currentUserInfo = Location::get($locationIP);
    $query = $currentUserInfo->cityName;
    $url = 'https://api.tequila.kiwi.com/locations/query';
    $queryParams = [
      "term" => $query,
      "locale" => "en-US",
      "location_types" => "airport",
      "limit" => 5,
      "active_only" => true,
    ];
    $headers = ["accept" => "application/json", 'apikey' => 'rxBlI0XMHzgplh6d9D7bPpGEeykS_LCj'];
    $response = Http::withHeaders($headers)->get($url, $queryParams);
    $responseData = $response->json();
    $currentUserInfo->airportCode = $responseData['locations'][0]['id'];
    // dd($currentUserInfo);
    return $currentUserInfo;
  }


  public function flight(Request $request)
  {
    $country = Countries::get();
    $locationIP = $request->ip();
    $currentUserInfo = Location::get($locationIP);
    $CurrentCountry = $currentUserInfo->countryName;
    $CurrentCurrency = $currentUserInfo->countryCode;
    return view('web.flight.flight', [
      'country' => $country,
      'CurrentCountry' => $CurrentCountry,
      'CurrentCurrency' => $CurrentCurrency
    ]);
  }

  public function searchFlight(Request $request)
  {
    /* Get One Way Trip Values Start */
    $OneWayFlightCityFrom = $request->get('OneWayFlightCityFrom');
    $OneWayFlightCityTo = $request->get('OneWayFlightCityTo');
    $OneWayFlightAirportCodeFrom = $request->get('OneWayFlightAirportCodeFrom');
    $OneWayFlightAirportCodeTo = $request->get('OneWayFlightAirportCodeTo');

    $fromDate = $request->get('OneWayFlightDate');
    $fromDateView = $request->get('OneWayFlightDate');
    //dd($fromDateView);
    $carbonDate = Carbon::parse($fromDate);
    $OneWayFlightDate = $carbonDate->format('Y-m-d');

    $OneWayFlightCoach = $request->get('OneWayFlightCoach');
    $OneWayFlightChildrenSlct = $request->get('OneWayFlightChildrenSlct');
    $OneWayFlightAdultSlct = $request->get('OneWayFlightAdultSlct');
    $OneWayFlightInfantSlct = $request->get('OneWayFlightInfantSlct');
    $locationIP = $request->ip();
    $currentUserInfo = Location::get($locationIP);
    $CurrentCountry = $currentUserInfo->countryName;
    $CurrentCurrency = $currentUserInfo->countryCode;
    $country = Countries::get();

 
    // For Set Cookies //
    $cookie = Cookie::get();
    if (!array_key_exists("CurrentCountry", $cookie)) {
      setcookie("CurrentCurrency", $currentUserInfo->countryCode, time() + 3600);
      setcookie("CurrentCountry", $currentUserInfo->countryName, time() + 3600);
    }
    /* Get One Way Trip Values End */
 
    $curls = curl_init();
    curl_setopt($curls, CURLOPT_URL, 'https://test.api.amadeus.com/v1/security/oauth2/token');
    curl_setopt($curls, CURLOPT_POST, true);
    curl_setopt($curls, CURLOPT_POSTFIELDS, "grant_type=client_credentials&client_id=aciBbCXKvhGqQSo6AI9wWEdoJDaPlZKQ&client_secret=GWVtHa1UFEJ1acyG");
    curl_setopt($curls, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
    curl_setopt($curls, CURLOPT_RETURNTRANSFER, true);
    $token = curl_exec($curls);
    $data = json_decode($token,true);
    $getAccessToken = $data["access_token"];

    $url = 'https://test.api.amadeus.com/v2/shopping/flight-offers';
    $queryParams = [
      'originLocationCode' => $OneWayFlightAirportCodeFrom,
      'destinationLocationCode' => $OneWayFlightAirportCodeTo,
      'departureDate' => $OneWayFlightDate,
      'adults' => $OneWayFlightAdultSlct,
      'children' => $OneWayFlightChildrenSlct,
      'infants' => $OneWayFlightInfantSlct,
      'travelClass' => $OneWayFlightCoach,
      'nonStop' => "false",
      'max' => "250",
    ];
    $headers = ['Authorization' => 'Bearer '.$getAccessToken,];
    $response = Http::withHeaders($headers)->get($url, $queryParams);
    $responseData = $response->json();
    // dd($responseData["data"]);
     
    // $arlinesCode = [];
    // foreach($responseData['data'] as $key => $value){
    //   $arlinesCode[$key] = $value['airlines'];

    // }
  //  dd($arlinesCode);

    return view('web.flight.flightonewaysearch', [
      /* One Way trip data filteration Start */
      'responseData' => $responseData,
      // 'airlineData' => $airlineData,
      'country' => $country,
      'OneWayFlightCityFrom' => $OneWayFlightCityFrom,
      'OneWayFlightCityTo' => $OneWayFlightCityTo,
      'OneWayFlightDate' => $OneWayFlightDate,
      'OneWayFlightChildrenSlct' => $OneWayFlightChildrenSlct,
      'OneWayFlightAdultSlct' => $OneWayFlightAdultSlct,
      'OneWayFlightInfantSlct' => $OneWayFlightInfantSlct,
      'OneWayFlightCoach' => $OneWayFlightCoach,
      'CurrentCountry' => $CurrentCountry,
      'CurrentCurrency' => $CurrentCurrency,
      'fromDateView' => $fromDateView,
      'OneWayFlightAirportCodeFrom' => $OneWayFlightAirportCodeFrom,
      'OneWayFlightAirportCodeTo'   => $OneWayFlightAirportCodeTo
      /* One Way trip data filteration End */
    ]);
  }

  public function onewayflightdetails(Request $request){
    $locationIP = $request->ip();
    $currentUserInfo = Location::get($locationIP);
    $CurrentCountry = $currentUserInfo->countryName;
    $CurrentCurrency = $currentUserInfo->countryCode;
    $country = Countries::get();
    $airlineDetails = $request->get('airlineDetails');

    $flightPrice = $request->get('flightPrice');
    $flightFromTo = $request->get('flightFromTo');
    $flightTakeoff =  $request->get('flightTakeoff');
    // dd($flightTakeoff);
    $flightLanding = $request->get('flightLanding');
    $searchFlyFromData = $request->get('searchFlyFromData');
    $searchFlyToData = $request->get('searchFlyToData');
    $searchDepartData = $request->get('searchDepartData');
    $searchAdultData = $request->get('searchAdultData');
    $searchChildData = $request->get('searchChildData');
    $searchInfantData = $request->get('searchInfantData');
    $searchCoach = $request->get('searchCoach');
    $airlineName = $request->get('airlineName');
    $totalTimeRemain = $request->get('totalTimeRemain');
    $data = array(
      "airlineDetails" => $airlineDetails,
      "flightPrice" => $flightPrice,
      'flightFromTo' => $flightFromTo,
      'flightTakeoff' => $flightTakeoff,
      'flightLanding' => $flightLanding,
      'searchFlyFromData' => $searchFlyFromData,
      'searchFlyToData' => $searchFlyToData,
      'searchDepartData' => $searchDepartData,
      'searchAdultData' => $searchAdultData,
      'searchChildData' => $searchChildData,
      'searchInfantData' => $searchInfantData,
      'searchCoach' => $searchCoach,
      'airlineName' => $airlineName,
      'totalTimeRemain' => $totalTimeRemain
    );
    // dd($data);

 
    // For Set Cookies //
    $cookie = Cookie::get();
    if (!array_key_exists("CurrentCountry", $cookie)) {
      setcookie("CurrentCurrency", $currentUserInfo->countryCode, time() + 3600);
      setcookie("CurrentCountry", $currentUserInfo->countryName, time() + 3600);
    }
    return view("web.flight.onewayflight-detail",['country' => $country,'data' => $data]);
  }

  public function roundtripsearch(Request $request)
  {

    /* Get Round Trip Values Start */
    $RoundtripFlightCityFrom = $request->get('RoundtripFlightCityFrom');
    $RoundtripFlightCityTo = $request->get('RoundtripFlightCityTo');
    $RoundtripFlightAirportCodeFrom = $request->get('RoundtripFlightAirportCodeFrom');
    $RoundtripFlightAirportCodeTo = $request->get('RoundtripFlightAirportCodeTo');

    $departingDate = $request->get('RoundFlightFromDate');
    $departingDateView = $request->get('RoundFlightFromDate');
    $carbonDate = Carbon::parse($departingDate);
    $RoundFlightFromDate = $carbonDate->format('d/m/Y');

    $returnDate = $request->get('RoundFlightReturnDate');
    $returnDateView = $request->get('RoundFlightReturnDate');
    $carbonDate = Carbon::parse($returnDate);
    $RoundFlightReturnDate = $carbonDate->format('d/m/Y');

    $RoundtripFlightCoach = $request->get('RoundtripFlightCoach');
    $RoundtripFlightAdultSlct = $request->get('RoundtripFlightAdultSlct');
    $RoundtripFlightChildrenSlct = $request->get('RoundtripFlightChildrenSlct');
    $RoundtripFlightInfantSlct = $request->get('RoundtripFlightInfantSlct');
    /* Get Round Trip Values End */
    $locationIP = $request->ip();
    $currentUserInfo = Location::get($locationIP);
    $CurrentCountry = $currentUserInfo->countryName;
    $CurrentCurrency = $currentUserInfo->countryCode;
    $country = Countries::get();
    
 
    // For Set Cookies //
    $cookie = Cookie::get();
    if (!array_key_exists("CurrentCountry", $cookie)) {
      setcookie("CurrentCurrency", $currentUserInfo->countryCode, time() + 3600);
      setcookie("CurrentCountry", $currentUserInfo->countryName, time() + 3600);
    }

    $url = 'https://api.tequila.kiwi.com/v2/search';
    $headers = ['apikey' => 'rxBlI0XMHzgplh6d9D7bPpGEeykS_LCj'];

    $roundtripParam = [
      'fly_from' => $RoundtripFlightAirportCodeFrom,
      'fly_to' => $RoundtripFlightAirportCodeTo,
      'date_from' => $RoundFlightFromDate,
      'return_from' => $RoundFlightReturnDate,
      'return_to' => $RoundFlightReturnDate,
      'adults' => $RoundtripFlightAdultSlct,
      'children' => $RoundtripFlightChildrenSlct,
      'selected_cabins' => $RoundtripFlightCoach,
    ];
    $response = Http::withHeaders($headers)->get($url, $roundtripParam);
    $roundTripResponseData = $response->json();

    return view('web.flight.flightroundtripsearch', [
      /* One Way trip data filteration Start */
      'CurrentCountry' => $CurrentCountry,
      'CurrentCurrency' => $CurrentCurrency,
      'country' => $country,
      /* One Way trip data filteration End */

      /* Round trip data filteration Start */
      'RoundtripFlightAirportCodeFrom' => $RoundtripFlightAirportCodeFrom,
      'RoundtripFlightAirportCodeTo' => $RoundtripFlightAirportCodeTo,
      'roundTripResponseData' => $roundTripResponseData,
      'RoundtripFlightCityFrom' => $RoundtripFlightCityFrom,
      'RoundtripFlightCityTo' => $RoundtripFlightCityTo,
      'RoundFlightFromDate' => $RoundFlightFromDate,
      'RoundFlightReturnDate' => $RoundFlightReturnDate,
      'RoundFlightReturnDateTo' => $RoundFlightReturnDate,
      'RoundtripFlightCoach' => $RoundtripFlightCoach,
      'RoundtripFlightAdultSlct' => $RoundtripFlightAdultSlct,
      'RoundtripFlightChildrenSlct' => $RoundtripFlightChildrenSlct,
      'RoundtripFlightInfantSlct' => $RoundtripFlightInfantSlct,
      'departingDateView' => $departingDateView,
      'returnDateView' => $returnDateView
      /* Round trip data filteration End */
    ]);
  }
  public function roundtripflightdetails(Request $request){
    $locationIP = $request->ip();
    $currentUserInfo = Location::get($locationIP);
    $CurrentCountry = $currentUserInfo->countryName;
    $CurrentCurrency = $currentUserInfo->countryCode;
    $country = Countries::get();
    $airlineDetails = $request->get('airlineDetails');

    $flightPrice = $request->get('flightPrice');
    $flightFromTo = $request->get('flightFromTo');
    $flightTakeoff =  $request->get('flightTakeoff');
    //dd($flghtTakeoff);
    $flightLanding = $request->get('flightLanding');
    $searchFlyFromData = $request->get('searchFlyFromData');
    $searchFlyToData = $request->get('searchFlyToData');
    $searchDepartData = $request->get('searchDepartData');
    $searchAdultData = $request->get('searchAdultData');
    $searchChildData = $request->get('searchChildData');
    $searchInfantData = $request->get('searchInfantData');
    $searchCoach = $request->get('searchCoach');
    $airlineName = $request->get('airlineName');
    $data = array(
      "airlineDetails" => $airlineDetails,
      "flightPrice" => $flightPrice,
      'flightFromTo' => $flightFromTo,
      'flightTakeoff' => $flightTakeoff,
      'flightLanding' => $flightLanding,
      'searchFlyFromData' => $searchFlyFromData,
      'searchFlyToData' => $searchFlyToData,
      'searchDepartData' => $searchDepartData,
      'searchAdultData' => $searchAdultData,
      'searchChildData' => $searchChildData,
      'searchInfantData' => $searchInfantData,
      'searchCoach' => $searchCoach,
      'airlineName' => $airlineName
    );
    $cookie = Cookie::get();
    if (!array_key_exists("CurrentCountry", $cookie)) {
      setcookie("CurrentCurrency", $currentUserInfo->countryCode, time() + 3600);
      setcookie("CurrentCountry", $currentUserInfo->countryName, time() + 3600);
    }
    return view("web.flight.roundtripflight-detail",['country' => $country,'data' => $data]);
  }


  public function multicitysearch(Request $request)
  {
    /* Get Multi City Values Start */
    $MultiCityFrom = $request->get('MultiCityFrom');
    $MultiCityTo = $request->get('MultiCityTo');
    $multiCityFlightAirportCodeFrom = $request->get('multiCityFlightAirportCodeFrom');
    $multiCityFlightAirportCodeTo = $request->get('multiCityFlightAirportCodeTo');

    $departingDate = $request->get('MultiCityDeptDate');
    $departingDateView = $request->get('MultiCityDeptDate');
    $carbonDate = Carbon::parse($departingDate);
    $MultiCityDeptDate = $carbonDate->format('d/m/Y');

    $MultiCityCoach = $request->get('MultiCityCoach');
    $MultiCityAdultSlct = $request->get('MultiCityAdultSlct');
    $MultiCityChildrenSlct = $request->get('MultiCityChildrenSlct');
    $MultiCityInfantSlct = $request->get('MultiCityInfantSlct');
    /* Get Multi City Values End */

    $locationIP = $request->ip();
    $currentUserInfo = Location::get($locationIP);
    $CurrentCountry = $currentUserInfo->countryName;
    $CurrentCurrency = $currentUserInfo->countryCode;
    $country = Countries::get();
    
 
    // For Set Cookies //
    $cookie = Cookie::get();
    if (!array_key_exists("CurrentCountry", $cookie)) {
      setcookie("CurrentCurrency", $currentUserInfo->countryCode, time() + 3600);
      setcookie("CurrentCountry", $currentUserInfo->countryName, time() + 3600);
    }

    $url = 'https://api.tequila.kiwi.com/v2/search';
    $headers = ['apikey' => 'rxBlI0XMHzgplh6d9D7bPpGEeykS_LCj'];

    $multiCityParam = [
      'fly_from' => $MultiCityFlightFrom,
      'fly_to' => $MultiCityFlightTo,
      'date_from' => $MultiCityDeptDate,
      'adults' => $MultiCityAdultSlct,
      'children' => $MultiCityChildrenSlct,
      'selected_cabins' => $MultiCityCoach,
    ];
    $response = Http::withHeaders($headers)->get($url, $multiCityParam);
    $multiCityResponseData = $response->json();

    return view('web.flight.flightmulticitysearch', [
      /* Multi City data filteration Start */
      'CurrentCountry' => $CurrentCountry,
      'CurrentCurrency' => $CurrentCurrency,
      'country' => $country,
      /* Multi City data filteration End */

      /* Multi City filteration Start */
      'MultiCityFrom' => $MultiCityFrom,
      'MultiCityTo' => $MultiCityTo,
      'multiCityResponseData' => $multiCityResponseData,
      'multiCityFlightAirportCodeFrom' => $multiCityFlightAirportCodeFrom,
      'multiCityFlightAirportCodeTo' => $multiCityFlightAirportCodeTo,
      'MultiCityDeptDate' => $MultiCityDeptDate,
      'MultiCityCoach' => $MultiCityCoach,
      'MultiCityAdultSlct' => $MultiCityAdultSlct,
      'MultiCityChildrenSlct' => $MultiCityChildrenSlct,
      'MultiCityInfantSlct' => $MultiCityInfantSlct,
      'departingDateView' => $departingDateView
      /* Multi City filteration End */
    ]);
  }  

   public function testing(Request $request)
  {
    $country = Countries::get();
   
    $locationIP = $request->ip();
    $currentUserInfo = Location::get($locationIP);
    $CurrentCountry = $currentUserInfo->countryName;
    $CurrentCurrency = $currentUserInfo->countryCode;
    return view('web.select2', [
      'country' => $country,
      'CurrentCountry' => $CurrentCountry,
      'CurrentCurrency' => $CurrentCurrency
    ]);
  }
}