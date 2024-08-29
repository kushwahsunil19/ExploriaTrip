@include('web.layout.header')

<?php
$data = $roundTripResponseData["data"];
$datas = array();
/*dd($data[0]['itineraries'][0]);*/

for ($a =0; $a < count($data); $a++){
    if($a > count($data)){
        break;
    } 
    // $arrival_at[] = $data[$a]['itineraries'][0]['segments'][0]['arrival']['at'];
    // $arrival_iataCode[] = $data[$a]['itineraries'][0]['segments'][0]['arrival']['iataCode'];
    // $departure_at[] = $data[$a]['itineraries'][0]['segments'][0]['departure']['at'];
    // $departure_iataCode[] = $data[$a]['itineraries'][0]['segments'][0]['departure']['iataCode'];
   // $arrival_iataCode[] = $data[$a]['itineraries'][0]['segments'][0]['arrival']['iataCode'];
    if($data[$a]['itineraries'][0]['segments'][0]['arrival']['at'] != $data[$a+1]['itineraries'][0]['segments'][0]['arrival']['at'] && 
    $data[$a]['itineraries'][0]['segments'][0]['departure']['at'] != $data[$a+1]['itineraries'][0]['segments'][0]['departure']['at'] &&
    $data[$a]['itineraries'][0]['segments'][0]['number'] != $data[$a+1]['itineraries'][0]['segments'][0]['number']){
      $datas[$a] = $data[$a];
    } 
   
   // $departure [] = $data[$a]['itineraries'][0]['segments'][0]['departure'];
   // $arrival [] = $data[$a]['itineraries'][0]['segments'][0]['arrival'];
       // $i = 0;
  // if($data[$a]['itineraries'][0]['segments'][0]['arrival']['at'] ==$data[$a]['itineraries'][0]['segments'][0]['arrival']['at'] ){
  //          if($i==0){
  //            $datas[$a] =$data[$a];
  //            $i++;
  //          }
           
  //      }
    
}
dd($datas); 
/*$temp1 = array_unique(array_column($departure, 'at'));
$departureData['departure'] = array_intersect_key($departure, $temp1);
$temp2 = array_unique(array_column($arrival, 'at'));
$arrivalData['arrival'] = array_intersect_key($arrival, $temp2);
 //  $info [] = array_map($ids, $data[$a]['itineraries'][0]['segments'][0]['departure']);
$c = array_merge($arrivalData,$departureData);*/
/*echo "<pre>"; print_r($datas);
*/
// $infoData = [];
//  foreach ($data as $key => $value) {
//         $infoData ['type'] =$value['type'];
//         $infoData ['id'] =$value['id'];
//         $infoData ['source'] =$value['source'];
//         $infoData ['instantTicketingRequired'] =$value['instantTicketingRequired'];
//         $infoData ['nonHomogeneous'] =$value['nonHomogeneous'];
//         $infoData ['oneWay'] =$value['oneWay'];
//         $infoData ['lastTicketingDate'] =$value['lastTicketingDate'];
//         $infoData ['lastTicketingDateTime'] =$value['lastTicketingDateTime'];
//         $infoData ['numberOfBookableSeats'] =$value['numberOfBookableSeats'];              
//         $i=0;
//         $result['segments'] = [];
//      foreach ( $value['itineraries'] as $k => $res) {
//             $departure_at  = $res['segments'][0]['departure']['at'];
//             $arrival_at  = $res['segments'][0]['arrival']['at'];
//            if(!in_array($res['segments'][0], $result)){
//                array_push($result, $res['segments'][0]);
//             }else{
//             // array_push($result, $res['segments'][0]);
//             }
//              echo "<pre>"; print_r($result ); 
//             $infoData ['segments']  =$res['segments'];
//      }
//         $infoData ['price'] =$value['price'];    

    
     
//  }

?>


<section class="breadcrumb-area" style="background-image:url('{{asset('assets/images/bread-bg5.jpg')}}')">
    <input type="hidden" id="searchFlyFromDataRoundTrip" value="{{$RoundtripFlightCityFrom}}">
    <input type="hidden" id="searchFlyToDataRoundTrip" value="{{$RoundtripFlightCityTo}}">
    <input type="hidden" id="searchDepartDataRoundTrip" value="{{$departingDateView}}">
    <input type="hidden" id="searchreturnDataRoundTrip" value="{{$returnDateView}}">
    <input type="hidden" id="searchAdultDataRoundTrip" value="{{$RoundtripFlightAdultSlct}}">
    <input type="hidden" id="searchChildDataRoundTrip" value="{{$RoundtripFlightChildrenSlct}}">
    <input type="hidden" id="searchInfantDataRoundTrip" value="{{$RoundtripFlightInfantSlct}}">
    <input type="hidden" id="searchCoachRoundTrip" value="{{$RoundtripFlightCoach}}">
    <div class="breadcrumb-wrap">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="tab-content search-fields-container" id="myTabContent">
                        <div class="tab-pane fade show active" id="flight" role="tabpanel" aria-labelledby="flight-tab">
                            <div class="section-tab section-tab-2 pb-3">
                                <ul class="nav nav-tabs" id="myTab3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link <?php if ($RoundtripFlightCityFrom) {
                                                                echo 'active';
                                                            } else {
                                                                echo '';
                                                            } ?>" id="round-trip-tab" data-toggle="tab" href="#round-trip" role="tab" aria-controls="round-trip" aria-selected="false">
                                            Round-trip
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <?php
                            if ($RoundtripFlightCityFrom) {
                                echo "<div class='tab-pane fade show active' id='round-trip' role='tabpanel' aria-labelledby='round-trip-tab'>";
                            } else {
                                echo "<div class='tab-pane fade' id='round-trip' role='tabpanel' aria-labelledby='round-trip-tab'>";
                            }
                            ?>

                            <div class="contact-form-action">
                                <form method="POST" id="FlightRoundtripRoundtripResultPage" class="row align-items-center">
                                    <div class="col-lg-6 pr-0">
                                        <div class="input-box">
                                            <label class="label-text">Flying from</label>
                                            <div class="form-group">
                                                <span class="la la-map-marker form-icon"></span>
                                                <input class="form-control" id="RoundtripFlightCityFromRoundtripResultPage" type="text" placeholder="City or airport" value="{{ $RoundtripFlightCityFrom }}" data-airportcode="{{ $RoundtripFlightAirportCodeFrom }}" />
                                                <div id="airpotcode3RoundtripResultPage" style="display: none; cursor:pointer;">
                                                    <ul class='list-group' id="list-code3RoundtripResultPage" style='position:absolute; z-index:999; height:200px; width:100%; overflow-y:auto;'></ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col-lg-3 -->
                                    <div class="col-lg-6">
                                        <div class="input-box">
                                            <label class="label-text">Flying to</label>
                                            <div class="form-group">
                                                <span class="la la-map-marker form-icon"></span>
                                                <input class="form-control" id="RoundtripFlightCityToRoundtripResultPage" type="text" placeholder="City or airport" value="{{ $RoundtripFlightCityTo }}" data-airportcode="{{ $RoundtripFlightAirportCodeTo }}" />
                                                <div id="airpotcode4RoundtripResultPage" style="display: none; cursor:pointer;">
                                                    <ul class='list-group' id="list-code4RoundtripResultPage" style='position:absolute; z-index:999; height:200px; width:100%; overflow-y:auto;'></ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col-lg-3 -->
                                    <div class="col-lg-3 pr-0">
                                        <div class="input-box">
                                            <label class="label-text">Departure</label>
                                            <div class="form-group">
                                                <input class="form-control master-date" id="RoundFlightFromDateRoundtripResultPage" type="date" min="<?= date('Y-m-d'); ?>" value="{{ $departingDateView }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col-lg-3 -->
                                    <div class="col-lg-3 pr-0">
                                        <div class="input-box">
                                            <label class="label-text">Return</label>
                                            <div class="form-group">
                                                <input class="form-control master-date" id="RoundFlightReturnDateRoundtripResultPage" type="date" min="<?= date('Y-m-d'); ?>" value="{{ $returnDateView }}" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- end col-lg-3 -->
                                    <div class="col-lg-3 pr-0">
                                        <div class="input-box">
                                            <label class="label-text">Passengers</label>
                                            <div class="form-group">
                                                <div class="dropdown dropdown-contain gty-container">
                                                    <a class="dropdown-toggle dropdown-btn" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                                        <span class="adult" data-text="Adult" data-text-multi="Adults"></span>
                                                        -
                                                        <span class="children" data-text="Child" data-text-multi="Children"></span>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-wrap">
                                                        <div class="dropdown-item">
                                                            <div class="qty-box d-flex align-items-center justify-content-between">
                                                                <label>Adults</label>
                                                                <div class="qtyBtn d-flex align-items-center">
                                                                    <div class="qtyDec">
                                                                        <i class="la la-minus"></i>
                                                                    </div>
                                                                    <input type="text" id="RoundtripFlightAdultSlctRoundtripResultPage" name="adult_number" value="<?php echo $RoundtripFlightAdultSlct ?>" />
                                                                    <div class="qtyInc">
                                                                        <i class="la la-plus"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown-item">
                                                            <div class="qty-box d-flex align-items-center justify-content-between">
                                                                <label>Children</label>
                                                                <div class="qtyBtn d-flex align-items-center">
                                                                    <div class="qtyDec">
                                                                        <i class="la la-minus"></i>
                                                                    </div>
                                                                    <input type="text" id="RoundtripFlightChildrenSlctRoundtripResultPage" name="child_number" value="<?php echo $RoundtripFlightChildrenSlct ?>" />
                                                                    <div class="qtyInc">
                                                                        <i class="la la-plus"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown-item">
                                                            <div class="qty-box d-flex align-items-center justify-content-between">
                                                                <label>Infants</label>
                                                                <div class="qtyBtn d-flex align-items-center">
                                                                    <div class="qtyDec">
                                                                        <i class="la la-minus"></i>
                                                                    </div>
                                                                    <input type="text" id="RoundtripFlightInfantSlctRoundtripResultPage" name="infants_number" value="<?php echo $RoundtripFlightInfantSlct ?>" />
                                                                    <div class="qtyInc">
                                                                        <i class="la la-plus"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end dropdown -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col-lg-3 -->
                                    <div class="col-lg-3 pr-0">
                                        <div class="input-box">
                                            <label class="label-text">Coach</label>
                                            <div class="form-group">
                                                <div class="select-contain w-auto">
                                                    <select class="select-contain-select" id="RoundtripFlightCoachRoundtripResultPage">
                                                        <option value="ECONOMY" {{ $RoundtripFlightCoach == 'ECONOMY' ? 'selected' : '' }}>Economy</option>
                                                        <option value="PREMIUM_ECONOMY" {{ $RoundtripFlightCoach == 'PREMIUM_ECONOMY' ? 'selected' : '' }}>Economy Premium</option>
                                                        <option value="BUSSINESS" {{ $RoundtripFlightCoach == 'BUSSINESS' ? 'selected' : '' }}>Bussiness</option>
                                                        <option value="FIRST" {{ $RoundtripFlightCoach == 'FIRST' ? 'selected' : '' }}>First class</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col-lg-3 -->
                                    <div class="col-lg-3">
                                        <button type="button" onclick="RoundtripUrlGenerateRoundtripResultPage()" class="theme-btn w-100 text-center margin-top-20px">Search
                                            Now</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Backup Code of Hotel,car etc in BackupCode File -->
            </div>
        </div>
    </div>
    </div>
    </div>
    <div class="bread-svg-box">
        <svg class="bread-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 10" preserveAspectRatio="none">
            <polygon points="100 0 50 10 0 0 0 10 100 10"></polygon>
        </svg>
    </div>
</section>

<!-- List View Card  -->
<section class="card-area  section--padding" id="listView_card">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="filter-wrap margin-bottom-30px">
                    <div class="filter-top d-flex align-items-center justify-content-between pb-4">
                        <div>
                            <h3 class="title font-size-24"><?php //echo count($filteredData); ?> Flights found</h3>
                        </div>
                    </div>
                    <div class="filter-bar d-flex align-items-center justify-content-between">
                        <div class="filter-bar-filter d-flex flex-wrap align-items-center">
                            <div class="filter-option">
                                <h3 class="title font-size-16">Filter by:</h3>
                            </div>
                            <div class="filter-option">
                                <div class="dropdown dropdown-contain">
                                    <a class="dropdown-toggle dropdown-btn dropdown--btn" href="#" role="button" data-toggle="dropdown">
                                        Filter Price
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-wrap">
                                        <div class="dropdown-item">
                                            <div class="slider-range-wrap">
                                                <div class="price-slider-amount padding-bottom-20px">
                                                    <label for="amount" class="filter__label">Price:</label>
                                                    <input type="text" id="amount" class="amounts">
                                                </div>
                                                <div id="slider-range"></div>
                                            </div><!-- end slider-range-wrap -->
                                            <div class="btn-box pt-4">
                                                <button class="theme-btn theme-btn-small theme-btn-transparent" type="button">Apply</button>
                                            </div>
                                        </div><!-- end dropdown-item -->
                                    </div><!-- end dropdown-menu -->
                                </div><!-- end dropdown -->
                            </div>
                            <div class="filter-option">
                                <div class="dropdown dropdown-contain">
                                    <a class="dropdown-toggle dropdown-btn dropdown--btn" href="#" role="button" data-toggle="dropdown">
                                        Review Score
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-wrap">
                                        <div class="dropdown-item">
                                            <div class="checkbox-wrap">
                                                <div class="custom-checkbox">
                                                    <input type="checkbox" id="r1">
                                                    <label for="r1">
                                                        <span class="ratings d-flex align-items-center">
                                                            <i class="la la-star"></i>
                                                            <i class="la la-star"></i>
                                                            <i class="la la-star"></i>
                                                            <i class="la la-star"></i>
                                                            <i class="la la-star"></i>
                                                            <span class="color-text-3 font-size-13 ml-1">(55.590)</span>
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="custom-checkbox">
                                                    <input type="checkbox" id="r2">
                                                    <label for="r2">
                                                        <span class="ratings d-flex align-items-center">
                                                            <i class="la la-star"></i>
                                                            <i class="la la-star"></i>
                                                            <i class="la la-star"></i>
                                                            <i class="la la-star"></i>
                                                            <i class="la la-star-o"></i>
                                                            <span class="color-text-3 font-size-13 ml-1">(40.590)</span>
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="custom-checkbox">
                                                    <input type="checkbox" id="r3">
                                                    <label for="r3">
                                                        <span class="ratings d-flex align-items-center">
                                                            <i class="la la-star"></i>
                                                            <i class="la la-star"></i>
                                                            <i class="la la-star"></i>
                                                            <i class="la la-star-o"></i>
                                                            <i class="la la-star-o"></i>
                                                            <span class="color-text-3 font-size-13 ml-1">(23.590)</span>
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="custom-checkbox">
                                                    <input type="checkbox" id="r4">
                                                    <label for="r4">
                                                        <span class="ratings d-flex align-items-center">
                                                            <i class="la la-star"></i>
                                                            <i class="la la-star"></i>
                                                            <i class="la la-star-o"></i>
                                                            <i class="la la-star-o"></i>
                                                            <i class="la la-star-o"></i>
                                                            <span class="color-text-3 font-size-13 ml-1">(12.590)</span>
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="custom-checkbox">
                                                    <input type="checkbox" id="r5">
                                                    <label for="r5">
                                                        <span class="ratings d-flex align-items-center">
                                                            <i class="la la-star"></i>
                                                            <i class="la la-star-o"></i>
                                                            <i class="la la-star-o"></i>
                                                            <i class="la la-star-o"></i>
                                                            <i class="la la-star-o"></i>
                                                            <span class="color-text-3 font-size-13 ml-1">(590)</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div><!-- end dropdown-item -->
                                    </div><!-- end dropdown-menu -->
                                </div><!-- end dropdown -->
                            </div>
                            <div class="filter-option">
                                <div class="dropdown dropdown-contain">
                                    <a class="dropdown-toggle dropdown-btn dropdown--btn" href="#" role="button" data-toggle="dropdown">
                                        Airlines
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-wrap">
                                        <div class="dropdown-item">
                                            <div class="checkbox-wrap">
                                                <div class="custom-checkbox">
                                                    <input type="checkbox" id="catChb1">
                                                    <label for="catChb1">Major Airlines</label>
                                                </div>
                                                <div class="custom-checkbox">
                                                    <input type="checkbox" id="catChb2">
                                                    <label for="catChb2">United Airlines</label>
                                                </div>
                                                <div class="custom-checkbox">
                                                    <input type="checkbox" id="catChb3">
                                                    <label for="catChb3">Delta Airlines</label>
                                                </div>
                                                <div class="custom-checkbox">
                                                    <input type="checkbox" id="catChb4">
                                                    <label for="catChb4">Alitalia</label>
                                                </div>
                                                <div class="custom-checkbox">
                                                    <input type="checkbox" id="catChb5">
                                                    <label for="catChb5">US Airways</label>
                                                </div>
                                                <div class="custom-checkbox">
                                                    <input type="checkbox" id="catChb6">
                                                    <label for="catChb6">Air France</label>
                                                </div>
                                                <div class="custom-checkbox">
                                                    <input type="checkbox" id="catChb7">
                                                    <label for="catChb7">Air Tahiti Nui</label>
                                                </div>
                                                <div class="custom-checkbox">
                                                    <input type="checkbox" id="catChb8">
                                                    <label for="catChb8">Indigo</label>
                                                </div>
                                            </div>
                                        </div><!-- end dropdown-item -->
                                    </div><!-- end dropdown-menu -->
                                </div><!-- end dropdown -->
                            </div>
                        </div><!-- end filter-bar-filter -->
                        <div class="select-contain">
                            <select class="select-contain-select">
                                <option value="1">Short by default</option>
                                <option value="2">Popular Flight</option>
                                <option value="3">Price: low to high</option>
                                <option value="4">Price: high to low</option>
                                <option value="5">A to Z</option>
                            </select>
                        </div><!-- end select-contain -->
                    </div><!-- end filter-bar -->
                </div><!-- end filter-wrap -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
        <div class="row">

            <div class="col-lg-12">
                <div class="row">
                    <form method="POST" class="col-lg-12" id="roundtripFlightDetailForm">
                        <?php if (count($datas) > 0) {
                          foreach($datas as $key => $value){

                            ?>
                                <div class="col-lg-12">
                                    <div class="card-item flight-card flight--card card-item-list card-item-list-2">
                                    <div class="card-img col-md-3">
                                            <img src="https://content.r9cdn.net/rimg/provider-logos/airlines/v/<?php echo $value['itineraries'][0]['segments'][0]['carrierCode'] ?>.png?crop=false&amp;width=150&amp;height=150">
                                        </div>



                                        <div class="card-body col-md-6">

                                            <div class="card-top-title d-flex justify-content-between">

                                                <div>
                                                    <!-- <p class="card-meta font-size-17" id="airlineDetails<?php //echo $key; ?>" style="font-weight: 900;">
                                                        <?php
                                                        //$airlineData = App\Models\AirlinesTables::where('IATA', $data['route'][0]['airline'])->pluck('Airline');
                                                        //echo " <span><b>" . $airlineData[0] . "</b></span> |  ";
                                                        //echo "<input type='hidden' id='airlineName" . $a . "' value='" . $airlineData[0] . "' />";
                                                        //echo $data['route'][0]['airline'], ' - ', $data['route'][0]['flight_no'];
                                                        ?>
                                                    </p> -->
                                                    <h3 class="card-title font-size-17" id="flightFromTo<?php echo $key; ?>"><?php echo $value['itineraries'][0]['segments'][0]['departure']['iataCode'] ?> - <?php echo $value['itineraries'][0]['segments'][0]['arrival']['iataCode'] ?></h3>
                                                </div>
                                                <div>

                                                </div>
                                            </div><!-- end card-top-title -->
                                            <div class="flight-details mt-1">
                                                <div class="flight-time">
                                                    <div class="flight-time-item take-off d-flex">
                                                        <div class="flex-shrink-0 mr-2">
                                                            <i class="la la-plane"></i>
                                                        </div>
                                                        <div>
                                                            <h3 class="card-title font-size-15 font-weight-medium mb-0">Take off</h3>
                                                            <p class="card-meta font-size-14" id="flghtTakeoff<?php echo $key; ?>"><?php echo date('d-m-Y h:i:s', strtotime($value['itineraries'][0]['segments'][0]['departure']['at'])); ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="flight-time-item landing d-flex">
                                                        <div class="flex-shrink-0 mr-2">
                                                            <i class="la la-plane"></i>
                                                        </div>
                                                        <div>
                                                            <h3 class="card-title font-size-15 font-weight-medium mb-0">Landing</h3>
                                                            <p class="card-meta font-size-14" id="flightLanding<?php echo $key; ?>"><?php echo date('d-m-Y h:i:s', strtotime($value['itineraries'][0]['segments'][0]['arrival']['at'])); ?></p>
                                                        </div>
                                                    </div>
                                                </div><!-- end flight-time -->

                                            </div><!-- end flight-details -->


                                        </div>
                                        <div class="card-body col-md-3">

                                            <!-- end card-top-title -->
                                            <!-- end flight-details -->

                                            <div class="text-right">
                                                <span class="font-weight-regular font-size-14 d-block">avg/person</span>
                                                <h4 class="font-weight-bold color-text text-dark" id="flightPrice<?php echo $key; ?>">$ <?php echo $value['price']['total'] ?></h4>
                                            </div>
                                            <?php
                                            // $seconds = $data['duration']['departure'];

                                            // $secs = $seconds % 60;
                                            // $hrs = $seconds / 60;
                                            // $mins = $hrs % 60;

                                            // $hrs = $hrs / 60;
                                            // ?>
                                             <p class="font-size-14 text-center mt-md-5"><span class="color-text-2 mr-1" id="totalTimeRemain<?php echo $key; ?>">Total Duration: <?php echo substr($value['itineraries'][0]['duration'], 2); ?></span></p>


                                            <div class="btn-box text-center mt-1">
                                                <button class="theme-btn theme-btn-small w-100" onclick="roundtripflightDetails(<?php //echo $key; ?>)">View Details
                                                </button>
                                            </div>

                                        </div><!-- end card-body -->
                                    </div><!-- end card-item -->
                                </div>
                        <?php
                        }
                        } ?>
                        
                    </form>
                </div>
            </div><!-- end col-lg-8 -->

        </div><!-- end row -->
    </div><!-- end container -->
</section>



<div class="section-block"></div>
@include('web.layout.footer')

<script>
    $(document).ready(function() {
        $('#list_view').click(function() {
            $('#list_view').addClass("active");
            $('#grid_view').removeClass("active");
            $('#listView_card').css('display', 'block');
            $('#gridView_card').css('display', 'none');
        });
    });

    $(document).ready(function() {
        $('#grid_view').click(function() {
            $('#grid_view').addClass("active");
            $('#list_view').removeClass("active");
            $('#listView_card').css('display', 'none');
            $('#gridView_card').css('display', 'block');
        });
    });

    $(document).ready(function() {
        $('#list_views').click(function() {
            $('#list_views').addClass("active");
            $('#grid_views').removeClass("active");
            $('#listView_card').css('display', 'block');
            $('#gridView_card').css('display', 'none');
        });
    });

    $(document).ready(function() {
        $('#grid_views').click(function() {
            $('#grid_views').addClass("active");
            $('#list_views').removeClass("active");
            $('#listView_card').css('display', 'none');
            $('#gridView_card').css('display', 'block');
        });
    });


    /////////////////       RoundTrip Flight


    $(document).ready(function() {

        $("#RoundtripFlightCityFromRoundtripResultPage").on('keyup', function() {
            $("#list-code3RoundtripResultPage").empty();
            var value = $(this).val();
            var getLength = $(this).val().length;
            // alert(getLength);
            if (getLength > 2) {
                $.ajax({
                    url: '{{ route("autoComplete") }}',
                    type: "GET",
                    datatype: "json",
                    data: {
                        "query": value
                    },
                    success: function(data) {
                        // console.log(data['results_retrieved']);
                        $("#airpotcode3RoundtripResultPage").css("display", "");
                        $("#list-code3RoundtripResultPage").empty();
                        for (let i = 0; i < data['results_retrieved']; i++) {
                            var location = data['locations'];
                            $("#list-code3RoundtripResultPage").append("<li class='list-group-item' style='text-align:center;' id='listCode3RoundtripResultPage" + i + "' onclick='return selectCode3(" + i + ")' ><div class='row displayCntr'><div class='col-md-2 formobileairpoticon'><img src='/assets/images/ic-flight-onward.png' ></div><div class='col-md-8 formobileairpotname text-center'><b>" + data['locations'][i]['city']['name'] + "," + data['locations'][i]['city']['country']['name'] + '</b><br/>  <span style="font-size:12px;">' + location[i].name + " Airport. </span></div><div class='col-md-2 formobileairpotcode'><input id='airpotcodeslct3RoundtripResultPage" + i + "' style='border:none;background:none; width:100% !important; font-weight:900;' value='" + location[i].id + "' data-airportcode='" + location[i]['city']['name'] + " (" + location[i].id + ")' ></div></div></li>");

                        }
                    }
                });
            }
        });
    });

    function selectCode3(i) {
        chooseCity = $("#airpotcodeslct3RoundtripResultPage" + i + "").data("airportcode");
        // alert(choosecode);
        chooseAirpotCode = $("#airpotcodeslct3RoundtripResultPage" + i + "").val();
        $("#RoundtripFlightCityFromRoundtripResultPage").val("");
        // $("#OneWayFlightCityFrom").data(choosecode);
        $("#RoundtripFlightCityFromRoundtripResultPage").attr('data-airportname', chooseAirpotCode);
        $("#RoundtripFlightCityFromRoundtripResultPage").val(chooseCity);
        $("#list-code3RoundtripResultPage li").remove();
        $("#airpotcode3RoundtripResultPage").css("display", "none");
    }

    $(document).ready(function() {

        $("#RoundtripFlightCityToRoundtripResultPage").on('keyup', function() {
            $("#list-code4RoundtripResultPage").empty();
            var value = $(this).val();
            var getLength = $(this).val().length;
            // alert(getLength);
            if (getLength > 2) {
                $.ajax({
                    url: '{{ route("autoComplete") }}',
                    type: "GET",
                    datatype: "json",
                    data: {
                        "query": value
                    },
                    success: function(data) {
                        $("#airpotcode4RoundtripResultPage").css("display", "");
                        $("#list-code4RoundtripResultPage").empty();
                        // console.log(data['results_retrieved']);
                        for (let i = 0; i < data['results_retrieved']; i++) {
                            var location = data['locations'];
                            //  $("#list-code4").append("<li class='list-group-item' id='listCode4" + i + "' onclick='return selectCode4(" + i + ")' ><span></span>" + location[i].id + "</li>");
                            $("#list-code4RoundtripResultPage").append("<li class='list-group-item' style='text-align:center;' id='listCode4RoundtripResultPage" + i + "' onclick='return selectCode4RoundtripResultPage(" + i + ")' ><div class='row displayCntr'><div class='col-md-2 formobileairpoticon'><img src='/assets/images/ic-flight-onward.png' ></div><div class='col-md-8 formobileairpotname text-center'><b>" + data['locations'][i]['city']['name'] + "," + data['locations'][i]['city']['country']['name'] + '</b><br/>  <span style="font-size:12px;">' + location[i].name + " Airport. </span></div><div class='col-md-2 formobileairpotcode'><input id='airpotcodeslct4RoundtripResultPage" + i + "' style='border:none;background:none; width:100% !important; font-weight:900;' value='" + location[i].id + "' data-airportcode='" + location[i]['city']['name'] + " (" + location[i].id + ")' ></div></div></li>");

                        }
                    }
                });
            }
        });
    });

    function selectCode4RoundtripResultPage(i) {
        chooseCity = $("#airpotcodeslct4RoundtripResultPage" + i + "").data("airportcode");
        chooseAirpotCode = $("#airpotcodeslct4RoundtripResultPage" + i + "").val();
        $("#RoundtripFlightCityToRoundtripResultPage").val("");
        $("#RoundtripFlightCityToRoundtripResultPage").attr('data-airporttoname', chooseAirpotCode);
        $("#RoundtripFlightCityToRoundtripResultPage").val(chooseCity);
        $("#list-code4RoundtripResultPage li").remove();
        $("#airpotcode4RoundtripResultPage").css("display", "none");
    }



    ///////////////////////////////////



    function RoundtripUrlGenerateRoundtripResultPage() {

        RoundtripFlightAirportCodeFrom = $('#RoundtripFlightCityFromRoundtripResultPage').data("airportname");
        if (RoundtripFlightAirportCodeFrom) {
            RoundtripFlightAirportCodeFrom = $('#RoundtripFlightCityFromRoundtripResultPage').data("airportname");
        } else {
            RoundtripFlightAirportCodeFrom = $('#RoundtripFlightCityFromRoundtripResultPage').data("airportcode");
        }
        RoundtripFlightAirportCodeTo = $('#RoundtripFlightCityToRoundtripResultPage').data("airporttoname");
        if (RoundtripFlightAirportCodeTo) {
            RoundtripFlightAirportCodeTo = $('#RoundtripFlightCityToRoundtripResultPage').data("airporttoname");
        } else {
            RoundtripFlightAirportCodeTo = $('#OneWayFlightCityToOneWayResultPage').data("airportcode");
        }


        RoundtripFlightCityFrom = $('#RoundtripFlightCityFromRoundtripResultPage').val();
        RoundtripFlightCityTo = $('#RoundtripFlightCityToRoundtripResultPage').val();

        RoundFlightFromDate = $('#RoundFlightFromDateRoundtripResultPage').val();
        RoundFlightReturnDate = $('#RoundFlightReturnDateRoundtripResultPage').val();
        RoundtripFlightCoach = $('#RoundtripFlightCoachRoundtripResultPage').val();
        RoundtripFlightAdultSlct = $('#RoundtripFlightAdultSlctRoundtripResultPage').val();
        RoundtripFlightChildrenSlct = $('#RoundtripFlightChildrenSlctRoundtripResultPage').val();
        RoundtripFlightInfantSlct = $('#RoundtripFlightInfantSlctRoundtripResultPage').val();

        if (RoundtripFlightCityFrom == '') {
            Swal.fire({
                position: "top-cneter",
                icon: "error",
                title: "<p>Please Enter Flying From</p>",
                showConfirmButton: false,
                timer: 5500
            });
        } else {
            if (RoundtripFlightCityTo == '') {
                Swal.fire({
                    position: "top-cneter",
                    icon: "error",
                    title: "<p>Please Enter Flying To</p>",
                    showConfirmButton: false,
                    timer: 5500
                });
            } else {
                if (RoundFlightFromDate == '') {
                    Swal.fire({
                        position: "top-cneter",
                        icon: "error",
                        title: "<p>Please Select Departing Date</p>",
                        showConfirmButton: false,
                        timer: 5500
                    });
                } else {
                    if (RoundFlightReturnDate == '') {
                        Swal.fire({
                            position: "top-cneter",
                            icon: "error",
                            title: "<p>Please Select Return From Date</p>",
                            showConfirmButton: false,
                            timer: 5500
                        });
                    } else {
                        if (RoundtripFlightAdultSlct == '0') {
                            Swal.fire({
                                position: "top-cneter",
                                icon: "error",
                                title: "<p>Adult Should be Minimum 1</p>",
                                showConfirmButton: false,
                                timer: 5500
                            });
                        } else {
                            data = {
                                'RoundtripFlightInfantSlct': RoundtripFlightInfantSlct,
                                'RoundtripFlightAirportCodeFrom': RoundtripFlightAirportCodeFrom,
                                'RoundtripFlightCityFrom': RoundtripFlightCityFrom,
                                'RoundtripFlightAirportCodeTo': RoundtripFlightAirportCodeTo,
                                'RoundtripFlightCityTo': RoundtripFlightCityTo,
                                'RoundFlightFromDate': RoundFlightFromDate,
                                'RoundFlightReturnDate': RoundFlightReturnDate,
                                'RoundtripFlightCoach': RoundtripFlightCoach,
                                'RoundtripFlightAdultSlct': RoundtripFlightAdultSlct,
                                'RoundtripFlightChildrenSlct': RoundtripFlightChildrenSlct
                            };
                            $('#FlightRoundtripRoundtripResultPage').attr("action", "/flight/roundtripsearch/?" + $.param(data));
                            $('#FlightRoundtripRoundtripResultPage').submit();
                        }
                    }
                }
            }
        }
    }

    function roundtripflightDetails(i) {
        airlineDetails = $('#airlineDetails' + i).text();
        flightPrice = $('#flightPrice' + i).text();
        flightFromTo = $('#flightFromTo' + i).text();
        flghtTakeoff = $('#flghtTakeoff' + i).text();
        flightLanding = $('#flightLanding' + i).text();
        searchFlyFromData = $('#searchFlyFromDataRoundTrip').val();
        searchFlyToData = $('#searchFlyToDataRoundTrip').val();
        searchDepartData = $('#searchDepartDataRoundTrip').val();
        searchReturnData = $('#searchreturnDataRoundTrip').val();
        searchAdultData = $('#searchAdultDataRoundTrip').val();
        searchChildData = $('#searchChildDataRoundTrip').val();
        searchInfantData = $('#searchInfantDataRoundTrip').val();
        airlineName = $('#airlineName'+i).val();
        searchCoach = $('#searchCoachRoundTrip').val();
        totalTimeRemain = $('#totalTimeRemain' + i).text();

        data = {
            "airlineDetails": airlineDetails,
            'flightPrice': flightPrice,
            'flightFromTo': flightFromTo,
            'flightTakeoff': flghtTakeoff,
            'flightLanding': flightLanding,
            'searchFlyFromData': searchFlyFromData,
            'searchFlyToData': searchFlyToData,
            'searchDepartData': searchDepartData,
            'searchReturnData' : searchReturnData,
            'searchAdultData': searchAdultData,
            'searchChildData': searchChildData,
            'searchInfantData': searchInfantData,
            'searchCoach': searchCoach,
            'airlineName': airlineName,
            'totalTimeRemain' :totalTimeRemain,
        };
        //alert(data);
        //console.log(data);
        // alert(flightLanding);
        $('#roundtripFlightDetailForm').attr("action", "/flight/roundtripflightdetails/?" + $.param(data));
        $('#roundtripFlightDetailForm').submit();
    }
</script>