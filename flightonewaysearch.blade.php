


@include('web.layout.header')


<?php
    $data = $responseData["data"];
    $count = count($data);
    // $OneWayFlightAirportCodeFrom = $OneWayFlightAirportCodeFrom;
    // $OneWayFlightAirportCodeTo = $OneWayFlightAirportCodeTo;

    // $getUniqueData = array_map("unserialize", array_unique(array_map("serialize", array_merge($data))));
?>

<section class="breadcrumb-area" style="background-image:url('{{asset('assets/images/bread-bg5.jpg')}}')">
    <input type="hidden" id="searchFlyFromData" value="{{$OneWayFlightCityFrom}}">
    <input type="hidden" id="searchFlyToData" value="{{$OneWayFlightCityTo}}">
    <input type="hidden" id="searchDepartData" value="{{$fromDateView}}">
    <input type="hidden" id="searchAdultData" value="{{$OneWayFlightAdultSlct}}">
    <input type="hidden" id="searchChildData" value="{{$OneWayFlightChildrenSlct}}">
    <input type="hidden" id="searchInfantData" value="{{$OneWayFlightInfantSlct}}">
    <input type="hidden" id="searchCoach" value="{{$OneWayFlightCoach}}">
    <div class="breadcrumb-wrap">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="tab-content search-fields-container" id="myTabContent">
                        <div class="tab-pane fade show active" id="flight" role="tabpanel" aria-labelledby="flight-tab">
                            <div class="section-tab section-tab-2 pb-3">
                                <ul class="nav nav-tabs" id="myTab3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link <?php if ($OneWayFlightCityFrom) {
                                                                echo 'active';
                                                            } else {
                                                                echo '';
                                                            } ?>" id="one-way-tab" data-toggle="tab" href="#one-way" role="tab" aria-controls="one-way" aria-selected="true">
                                            One way
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end section-tab -->
                            <div class="tab-content" id="myTabContent3">
                                <?php
                                if ($OneWayFlightCityFrom) {
                                    echo "<div class='tab-pane fade show active'  id='one-way' role='tabpanel' aria-labelledby='one-way-tab'>";
                                } else {
                                    echo "<div class='tab-pane fade'  id='one-way' role='tabpanel' aria-labelledby='one-way-tab'>";
                                }
                                ?>
                                <!-- <div class="tab-pane fade show active" id="one-way" role="tabpanel" aria-labelledby="one-way-tab"> -->
                                <div class="contact-form-action">
                                    <form method="POST" id="FlightOneWayOneWayResultPage" class="row align-items-center">
                                        <div class="col-lg-6 pr-0">
                                            <div class="input-box">
                                                <label class="label-text">Flying from</label>
                                                <div class="form-group">
                                                    <span class="la la-map-marker form-icon"></span>
                                                    <input class="form-control" id="OneWayFlightCityFromOneWayResultPage" type="text" value="{{ $OneWayFlightCityFrom }}" data-airportcode="{{ $OneWayFlightAirportCodeFrom }}" placeholder="City or airport" autocomplete="off" />
                                                    <div id="airpotcodeOneWayResultPage" style="display: none; cursor:pointer;">
                                                        <ul class='list-group' id="list-codeOneWayResultPage" style='position:absolute; z-index:999; height:200px; width:100%; overflow-y:auto;'></ul>
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
                                                    <input class="form-control" id="OneWayFlightCityToOneWayResultPage" type="text" value="{{ $OneWayFlightCityTo }}" data-airportcode="{{ $OneWayFlightAirportCodeTo }}" placeholder="City or airport" autocomplete="off" />
                                                    <div id="airpotcode2OneWayResultPage" style="display: none; cursor:pointer;">
                                                        <ul class='list-group' id="list-code2OneWayResultPage" style='position:absolute; z-index:999; height:200px; width:100%; overflow-y:auto;'></ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col-lg-3 -->

                                        <div class="col-lg-3 pr-0">
                                            <div class="input-box">
                                                <label class="label-text">Departure Date</label>
                                                <div class="form-group">
                                                    <input class="form-control master-date" id="OneWayFlightDateOneWayResultPage" type="date" min="<?= date('Y-m-d'); ?>" value="<?php  ?>{{ $fromDateView }}" />
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
                                                                        <input type="text" id="OneWayFlightAdultSlctOneWayResultPage" name="adult_number" value="<?php echo $OneWayFlightAdultSlct; ?>" />
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
                                                                        <input type="text" id="OneWayFlightChildrenSlctOneWayResultPage" name="child_number" value="<?php echo $OneWayFlightChildrenSlct; ?>" />
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
                                                                        <input type="text" id="OneWayFlightInfantSlctOneWayResultPage" name="infants_number" value="<?php echo $OneWayFlightInfantSlct; ?>" />
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
                                                <div class="form-group select-contain w-100">
                                                    <select class="select-contain-select w-100" id="OneWayFlightCoachOneWayResultPage">
                                                        <option value="ECONOMY" {{ $OneWayFlightCoach == 'ECONOMY' ? 'selected' : '' }}>Economy</option>
                                                        <option value="PREMIUM_ECONOMY" {{ $OneWayFlightCoach == 'PREMIUM_ECONOMY' ? 'selected' : '' }}>Economy Premium</option>
                                                        <option value="BUSSINESS" {{ $OneWayFlightCoach == 'BUSSINESS' ? 'selected' : '' }}>Bussiness</option>
                                                        <option value="FIRST" {{ $OneWayFlightCoach == 'FIRST' ? 'selected' : '' }}>First class</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col-lg-3 -->
                                        <div class="col-lg-3">
                                            <button type="button" onclick="OnewWayUrlGenerateOneWayResultPage()" class="theme-btn w-100 text-center margin-top-20px">Search
                                                Now</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Backup Code Hotel,car etc in BackupCode File -->
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



<!-- list view card -->

<section class="card-area  section--padding" id="listView_card">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="filter-wrap margin-bottom-30px">
                    <div class="filter-top d-flex align-items-center justify-content-between pb-4">
                        <div>
                            <!-- <h3 class="title font-size-24"><?php //echo count($data); ?> Flights found</h3> -->
                        </div>
                        <!-- <div class="layout-view d-flex align-items-center">
                            <a id="grid_view" data-toggle="tooltip" data-placement="top" title="Grid View"><i class="la la-th-large"></i></a>
                            <a id="list_view" data-toggle="tooltip" data-placement="top" title="List View" class="active"><i class="la la-th-list"></i></a>
                        </div> -->
                    </div><!-- end filter-top -->
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
                                                </div><!-- end price-slider-amount -->
                                                <div id="slider-range"></div><!-- end slider-range -->
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
                    <form method="POST" class="col-lg-12" id="flightsDetailsForm">
                        <?php if (count($data) > 0) {
                            foreach ($data as $key => $value) {
                                if( $value['itineraries'][0]['segments'][0]['arrival']['iataCode'] == $OneWayFlightAirportCodeTo && $value['itineraries'][0]['segments'][0]['departure']['iataCode'] == $OneWayFlightAirportCodeFrom){
                        ?>
                                <div class="col-lg-12">
                                    <div class="card-item flight-card flight--card card-item-list card-item-list-2">
                                        <div class="card-img col-md-3">
                                            <img src="https://content.r9cdn.net/rimg/provider-logos/airlines/v/<?php echo $value['itineraries'][0]['segments'][0]['carrierCode'] ?>.png?crop=false&amp;width=150&amp;height=150">
                                        </div>



                                        <div class="card-body col-md-6">

                                            <div class="card-top-title d-flex justify-content-between">

                                                <div>
                                                    <p class="card-meta font-size-17" id="airlineDetails<?php echo $key; ?>" style="font-weight: 900;">
                                                        <?php
                                                            $airlineData = App\Models\AirlinesTables::where('IATA', $value['itineraries'][0]['segments'][0]['carrierCode'])->pluck('Airline');
                                                            echo " <span><b>" . $airlineData[0] . "</b></span> |  ";
                                                            echo "<input type='hidden' id='airlineName" . $key . "' value='" . $airlineData[0] . "' />";
                                                            echo $value['itineraries'][0]['segments'][0]['carrierCode'], ' - ', $value['itineraries'][0]['segments'][0]['number'];
                                                        ?>
                                                    </p>
                                                    <h3 class="card-title font-size-17" id="flightFromTo<?php echo $key; ?>"><?php echo $OneWayFlightCityFrom; ?> - <?php echo $OneWayFlightCityTo; ?></h3>
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

                                            <p class="font-size-14 text-center mt-md-5"><span class="color-text-2 mr-1" id="totalTimeRemain<?php echo $key; ?>">Total Duration: <?php echo substr($value['itineraries'][0]['duration'], 2); ?></span></p>


                                            <div class="btn-box text-center mt-1">
                                                <button class="theme-btn theme-btn-small w-100" onclick="onewayflightDetails(<?php echo $key; ?>)">View Details
                                                </button>
                                            </div>

                                        </div><!-- end card-body -->
                                    </div><!-- end card-item -->
                                </div>
                        <?php
                                }
                            }
                        } ?>
                    </form>
                </div>
            </div><!-- end col-lg-8 -->

        </div><!-- end row -->
    </div><!-- end container -->
</section>



<div class="section-block"></div>

<section class="info-area info-bg padding-top-90px padding-bottom-70px">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 responsive-column">
                <a href="#" class="icon-box icon-layout-2 d-flex">
                    <div class="info-icon flex-shrink-0 bg-rgb text-color-2">
                        <i class="la la-phone"></i>
                    </div>
                    <div class="info-content">
                        <h4 class="info__title">Need Help? Contact us</h4>
                        <p class="info__desc">
                            Lorem ipsum dolor sit amet, consectetur adipisicing
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 responsive-column">
                <a href="#" class="icon-box icon-layout-2 d-flex">
                    <div class="info-icon flex-shrink-0 bg-rgb-2 text-color-3">
                        <i class="la la-money"></i>
                    </div>
                    <div class="info-content">
                        <h4 class="info__title">Payments</h4>
                        <p class="info__desc">
                            Lorem ipsum dolor sit amet, consectetur adipisicing
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 responsive-column">
                <a href="#" class="icon-box icon-layout-2 d-flex">
                    <div class="info-icon flex-shrink-0 bg-rgb-3 text-color-4">
                        <i class="la la-times"></i>
                    </div>
                    <div class="info-content">
                        <h4 class="info__title">Cancel Policy</h4>
                        <p class="info__desc">
                            Lorem ipsum dolor sit amet, consectetur adipisicing
                        </p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

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

    $(document).ready(function() {

        $("#OneWayFlightCityFromOneWayResultPage").on('keyup', function() {
            $("#list-codeOneWayResultPage").empty();
            var value = $(this).val();
            var getLength = $(this).val().length;
            // alert(getLength);
            if (getLength > 2) {
                $.ajax({
                    url: '{{ route("autoComplete") }}',
                    type: "GET",
                    datatype: "json",
                    data: {
                        "query": value,

                    },
                    success: function(data) {
                        // console.log(data['results_retrieved']);
                        $("#airpotcodeOneWayResultPage").css("display", "");
                        $("#list-codeOneWayResultPage").empty();
                        for (let i = 0; i < data['results_retrieved']; i++) {
                            var location = data['locations'];
                            // console.log(data['locations'][i]['city']['name'],data['locations'][i]['city']['country']['name']);
                            $("#list-codeOneWayResultPage").append("<li class='list-group-item' style='text-align:center;' id='listCodeOneWayResultPage" + i + "' onclick='return selectCodeOneWayResultPage(" + i + ")' ><div class='row displayCntr'><div class='col-md-2 formobileairpoticon'><img src='/assets/images/ic-flight-onward.png' ></div><div class='col-md-8 formobileairpotname text-center'><b>" + data['locations'][i]['city']['name'] + "," + data['locations'][i]['city']['country']['name'] + '</b><br/>  <span style="font-size:12px;">' + location[i].name + " Airport. </span></div><div class='col-md-2 formobileairpotcode'><input id='airpotcodeslctOneWayResultPage" + i + "' style='border:none;background:none; width:100% !important; font-weight:900; text-align:center' value='" + location[i].id + "' data-airportcode='" + location[i]['city']['name'] + " (" + location[i].id + ")' ></div></div></li>");
                        }
                    }
                });
            }
        });
    });

    function selectCodeOneWayResultPage(i) {
        chooseCity = $("#airpotcodeslctOneWayResultPage" + i + "").data("airportcode");
        //alert(chooseCity);
        chooseAirpotCode = $("#airpotcodeslctOneWayResultPage" + i + "").val();
        $("#OneWayFlightCityFromOneWayResultPage").val("");
        $("#OneWayFlightCityFromOneWayResultPage").attr('data-airportname', chooseAirpotCode);
        $("#OneWayFlightCityFromOneWayResultPage").val(chooseCity);
        $("#list-codeOneWayResultPage li").remove();
        $("#airpotcodeOneWayResultPage").css("display", "none");
    }


    $(document).ready(function() {

        $("#OneWayFlightCityToOneWayResultPage").on('keyup', function() {
            $("#list-code2OneWayResultPage").empty();
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
                        $("#airpotcode2OneWayResultPage").css("display", "");
                        // console.log(data['results_retrieved']);
                        $("#list-code2OneWayResultPage").empty();
                        for (let i = 0; i < data['results_retrieved']; i++) {
                            var location = data['locations'];
                            $("#list-code2OneWayResultPage").append("<li class='list-group-item' style='text-align:center;' id='listCode2OneWayResultPage" + i + "' onclick='return selectCode2OneWayResultPage(" + i + ")' ><div class='row displayCntr'><div class='col-md-2 formobileairpoticon'><img src='/assets/images/ic-flight-onward.png' ></div><div class='col-md-8 formobileairpotname text-center'><b>" + data['locations'][i]['city']['name'] + "," + data['locations'][i]['city']['country']['name'] + '</b><br/>  <span style="font-size:12px;">' + location[i].name + " Airport. </span></div><div class='col-md-2 formobileairpotcode'><input id='airpotcodeslct2OneWayResultPage" + i + "' style='border:none;background:none; width:100% !important; font-weight:900;' value='" + location[i].id + "' data-airportcode='" + location[i]['city']['name'] + " (" + location[i].id + ")'></div></div></li>");

                        }
                    }
                });
            }
        });

    });

    function selectCode2OneWayResultPage(i) {
        chooseCity = $("#airpotcodeslct2OneWayResultPage" + i + "").data("airportcode");
        // alert(choosecode);
        chooseAirpotCode = $("#airpotcodeslct2OneWayResultPage" + i + "").val();
        // alert(chooseAirpotCode);
        $("#OneWayFlightCityToOneWayResultPage").val("");
        $("#OneWayFlightCityToOneWayResultPage").attr('data-airporttoname', chooseAirpotCode);
        $("#OneWayFlightCityToOneWayResultPage").val(chooseCity);
        $("#list-code2OneWayResultPage li").remove();
        $("#airpotcode2OneWayResultPage").css("display", "none");
    }

    function OnewWayUrlGenerateOneWayResultPage() {

        OneWayFlightCityFrom = $('#OneWayFlightCityFromOneWayResultPage').val();
        OneWayFlightAirportCodeFrom = $('#OneWayFlightCityFromOneWayResultPage').data("airportname");
        if (OneWayFlightAirportCodeFrom) {
            OneWayFlightAirportCodeFrom = $('#OneWayFlightCityFromOneWayResultPage').data("airportname");
        } else {
            OneWayFlightAirportCodeFrom = $('#OneWayFlightCityFromOneWayResultPage').data("airportcode");
        }
        //alert(OneWayFlightAirportCodeFrom);
        OneWayFlightCityTo = $('#OneWayFlightCityToOneWayResultPage').val();

        OneWayFlightAirportCodeTo = $('#OneWayFlightCityToOneWayResultPage').data("airporttoname");
        if (OneWayFlightAirportCodeTo) {
            OneWayFlightAirportCodeTo = $('#OneWayFlightCityToOneWayResultPage').data("airporttoname");
        } else {
            OneWayFlightAirportCodeTo = $('#OneWayFlightCityToOneWayResultPage').data("airportcode");
        }
        //alert(OneWayFlightAirportCodeTo);
        OneWayFlightDate = $('#OneWayFlightDateOneWayResultPage').val();
        OneWayToFlightDate = $('#OneWayFlightDateOneWayResultPage').val();
        OneWayFlightCoach = $('#OneWayFlightCoachOneWayResultPage').val();
        OneWayFlightAdultSlct = $('#OneWayFlightAdultSlctOneWayResultPage').val();
        OneWayFlightChildrenSlct = $('#OneWayFlightChildrenSlctOneWayResultPage').val();
        OneWayFlightInfantSlct = $('#OneWayFlightInfantSlctOneWayResultPage').val();

        if (OneWayFlightCityFrom == '') {
            Swal.fire({
                position: "top-cneter",
                icon: "error",
                title: "<p>Please Enter Flying From</p>",
                showConfirmButton: false,
                timer: 5500
            });
        } else {
            if (OneWayFlightCityTo == '') {
                Swal.fire({
                    position: "top-cneter",
                    icon: "error",
                    title: "<p>Please Enter Flying To</p>",
                    showConfirmButton: false,
                    timer: 5500
                });
            } else {
                if (OneWayFlightDate == '0') {
                    Swal.fire({
                        position: "top-cneter",
                        icon: "error",
                        title: "<p>Please Select Departing Date</p>",
                        showConfirmButton: false,
                        timer: 5500
                    });
                } else {
                    if (OneWayFlightAdultSlct == '0') {
                        Swal.fire({
                            position: "top-cneter",
                            icon: "error",
                            title: "<p>Adult Should be Minimum 1</p>",
                            showConfirmButton: false,
                            timer: 5500
                        });
                    } else {
                        data = {
                            'OneWayFlightCityFrom': OneWayFlightCityFrom,
                            'OneWayFlightAirportCodeFrom': OneWayFlightAirportCodeFrom,
                            'OneWayFlightAirportCodeTo': OneWayFlightAirportCodeTo,
                            'OneWayFlightCityTo': OneWayFlightCityTo,
                            'OneWayFlightDate': OneWayFlightDate,
                            'OneWayToFlightDate': OneWayFlightDate,
                            'OneWayFlightCoach': OneWayFlightCoach,
                            'OneWayFlightAdultSlct': OneWayFlightAdultSlct,
                            'OneWayFlightChildrenSlct': OneWayFlightChildrenSlct,
                            'OneWayFlightInfantSlct': OneWayFlightInfantSlct
                        };
                        $('#FlightOneWayOneWayResultPage').attr("action", "/flight/onewaysearch/?" + $.param(data));
                        $('#FlightOneWayOneWayResultPage').submit();
                    }
                }
            }
        }

    }

    function onewayflightDetails(i) {
        airlineDetails = $('#airlineDetails' + i).text();
        flightPrice = $('#flightPrice' + i).text();
        flightFromTo = $('#flightFromTo' + i).text();
        flghtTakeoff = $('#flghtTakeoff' + i).text();
        flightLanding = $('#flightLanding' + i).text();
        searchFlyFromData = $('#searchFlyFromData').val();
        searchFlyToData = $('#searchFlyToData').val();
        searchDepartData = $('#searchDepartData').val();
        searchAdultData = $('#searchAdultData').val();
        searchChildData = $('#searchChildData').val();
        searchInfantData = $('#searchInfantData').val();
        airlineName = $('#airlineName' + i).val();
        searchCoach = $('#searchCoach').val();
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
            'searchAdultData': searchAdultData,
            'searchChildData': searchChildData,
            'searchInfantData': searchInfantData,
            'searchCoach': searchCoach,
            'airlineName': airlineName,
            'totalTimeRemain': totalTimeRemain
        };
        //alert(data);
        console.log(data);
        // alert(flightLanding);
        $('#flightsDetailsForm').attr("action", "/flight/onewaydetails/?" + $.param(data));
        $('#flightsDetailsForm').submit();
    }
</script>