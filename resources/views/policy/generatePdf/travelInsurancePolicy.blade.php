<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    {{-- style this policy --}}
    <style>
        body {
            font-family: 'NotoKufiArabic';
            padding: 20px;
        }

        .policy {}

        .table-container {
            border-radius: 10px;
            overflow: hidden;
            /* Ensure the border-radius is visible */
        }

        .header {
            width: 100%;
            padding: 0;
            border-collapse: collapse;
        }

        .header td {
            width: 50%;
            text-align: center;
            font-weight: bold;
            border: 2px solid #000000;
        }

        .header td:nth-child(1) {
            text-align: right;
            border-left: none;
            padding: 8px;
            border-top-left-radius: 10px
        }

        .header td:nth-child(2) {
            text-align: left;
            border-right: none;
            padding: 8px
        }

        .policy-no {
            text-align: center;
            font-size: 15px;
            font-weight: bold;
            margin-top: 10px
        }
    </style>

</head>

<body>
    <div class="policy">

        <div style="border-radius: 10px; overflow: hidden;">
            <table class="header">
                <tr>
                    <td>عقد التأمين علي سفر</td>
                    <td>Travel Insurance Policy</td>
                </tr>
            </table>
        </div>

        <div class="policy-no">
            <span> رقم الوثيقة : &nbsp; &nbsp; &nbsp; </span><span style="text-align: center">Policy No : &nbsp; &nbsp;
                &nbsp; </span><span class="number">{{ $trip->policy->policy_number }}</span>
        </div>

        <table style="width: 100% ; font-size: 13px ; font-weight:bold">
            <tr>
                <td style="text-align: right ;">
                    <span>الوكيل :</span>
                </td>
                <td style="text-align: center">
                    <span>{{ $trip->traveler->user->branche->name }}</span>
                </td>
                <td style="text-align: left">
                    <span>: Agent</span>
                </td>
            </tr>
            <tr>
                <td style="text-align: right ;padding-top:10px">
                    <span>إسم المؤمن له :</span>
                </td>
                <td style="text-align: center">
                    <span>{{ $trip->traveler->name_in_passport }}</span>
                </td>
                <td style="text-align: left">
                    <span>: Insured Name </span>
                </td>
            </tr>
            <tr>
                <td style="text-align: right ; padding-top:10px">
                    <span>رقم الجواز :</span>
                </td>
                <td style="text-align: center">
                    <span>{{ $trip->traveler->passport_number }}</span>
                </td>
                <td style="text-align: left">
                    <span>: Passport Number </span>
                </td>
            </tr>
            <tr>
                <td style="text-align: right ; padding-top:10px">
                    <span>تاريخ الميلاد : </span>
                </td>
                <td style="text-align: center">
                    <span>{{ $trip->traveler->date_of_birth }}</span>
                </td>
                <td style="text-align: left">
                    <span>:Date of Birth</span>
                </td>
            </tr>
            <tr>
                <td style="text-align: right ; padding-top:10px">
                    <span>الجنس : </span>
                </td>
                <td style="text-align: center">
                    <span>{{ $trip->traveler->gender }}</span>
                </td>
                <td style="text-align: left">
                    <span>: Sex</span>
                </td>
            </tr>
            <tr>
                <td style="text-align: right ; padding-top:10px">
                    <span>رقم الهاتف : </span>
                </td>
                <td style="text-align: center">
                    <span>{{ $trip->traveler->user->phone }}</span>
                </td>
                <td style="text-align: left">
                    <span>: Phone No</span>
                </td>
            </tr>
            <tr>
                <td style="text-align: right ; padding-top:10px">
                    <span>مدة التامين :</span>
                </td>
                <td style="text-align:">
                    <span> من يوم &nbsp; <span>{{ $trip->policy->start_date }}</span></span> &nbsp; &nbsp;
                    <span>الي يوم &nbsp; <span>{{ $trip->policy->end_date }}</span></span>
                </td>
                <td style="text-align: left">
                    <span>: Insured Period </span>
                </td>
            </tr>
        </table>

        <div style="margin-bottom: 25px"></div>

        @if ($trip->dependents->isNotEmpty())
            <div style="border: 2px solid black; padding:10px">
                <table
                    style="width: 100% ; font-size: 13px ; border:2px solid black; padding:10px ; border-collapse: collapse;">
                    <tr>
                        <td style="text-align: right ; font-weight:bold;font-size:15px ; padding-bottom:13px">
                            <span>المرافقون </span>
                        </td>
                    </tr>

                    @php
                        $dependents = $trip->dependents;
                        $dependentsCount = $dependents->count();
                    @endphp

                    @foreach ($dependents->chunk(2) as $dependentChunk)
                        <tr>
                            @foreach ($dependentChunk as $dependent)
                                <td
                                    style="text-align: left; {{ $dependentsCount == 1 ? 'width: 100%;' : 'width: 50%;' }} border: 2px solid black ; ">
                                    <table style="width: 100%">
                                        <tr>
                                            <td style="text-align: right; padding-top:10px">
                                                <span>الاسم :</span>
                                            </td>
                                            <td style="text-align: center">
                                                <span>{{ $dependent->passport_name }}</span>
                                            </td>
                                            <td style="text-align: left">
                                                <span> Name</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; padding-top:10px">
                                                <span>رقم جواز السفر</span>
                                            </td>
                                            <td style="text-align: center">
                                                <span>{{ $dependent->passport_number }}</span>
                                            </td>
                                            <td style="text-align: left">
                                                <span>Passport Number</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; padding-top:10px">
                                                <span>الجنس</span>
                                            </td>
                                            <td style="text-align: center">
                                                <span>{{ $dependent->gender }}</span>
                                            </td>
                                            <td style="text-align: left">
                                                <span>Sex</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; padding-top:10px">
                                                <span>تاريخ الميلاد</span>
                                            </td>
                                            <td style="text-align: center">
                                                <span>{{ $dependent->date_of_birth }}</span>
                                            </td>
                                            <td style="text-align: left">
                                                <span>Date Of Birth</span>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach


                </table>
        @endif
    </div>

    <div style="margin-bottom: 25px"></div>

    <table style="width: 100% ; font-size: 13px ; border:2px solid black; padding:10px">
        <tr>
            <td style="text-align: right ; font-weight:bold;font-size:15px;padding-bottom:13px">
                <span>قيمة القسط طبقا للتعريفة المقررة</span>
            </td>
            <td style="text-align: left ;font-weight:bold;font-size:15px ; padding-bottom:13px" colspan="2">
                <span>: Premium amount according to item of the traffic </span>
            </td>
        </tr>
        <tr>
            <td style="text-align: right ;padding-top:10px">
                <span>صافي القسط</span>
            </td>
            <td>
                <span>{{ $trip->policy->premium->net_premiums }}</span>
            </td>
            <td style="text-align: left;">
                &nbsp; &nbsp; <span>Net Premium</span>
            </td>
        </tr>
        <tr>
            <td style="text-align: right ; padding-top:10px">
                <span>لضريبة</span>
            </td>
            <td>
                <span>{{ $trip->policy->premium->tax }}</span>
            </td>
            <td style="text-align: left;">
                <span>Tax</span>
            </td>
        </tr>
        <tr>
            <td style="text-align: right ; padding-top:10px">
                <span>رسوم إشراف</span>
            </td>
            <td>
                <span>{{ $trip->policy->premium->supervision_fees }}</span>
            </td>
            <td style="text-align: left">
                <span>Supervision Fees</span>
            </td>
        </tr>
        <tr>
            <td style="text-align: right ; padding-top:10px">
                <span>الدمغة</span>
            </td>
            <td>
                <span>{{ $trip->policy->premium->stamps }}</span>
            </td>
            <td style="text-align: left">
                <span>Stamps</span>
            </td>
        </tr>
        <tr>
            <td style="text-align: right ; padding-top:10px">
                <span>مصاريف إصدار</span>
            </td>
            <td>
                <span>{{ $trip->policy->premium->issuance_fees }}</span>
            </td>
            <td style="text-align: left">
                <span>Issuance Fees</span>
            </td>
        </tr>
    </table>
    <table style="border:2px solid black; border-top:none; width:100% ; padding:0 10px">
        <tr>
            <td style="text-align: right ; padding-top:none ; ">
                <span>إجمالي القسط</span>
            </td>
            <td dir="ltr" style="text-align: right;">
                <span>{{ $trip->policy->premium->total_premium }}</span> &nbsp; &nbsp;
                <span>{{ config('app.currency') }}</span>
            </td>
            <td style="text-align: left">
                <span>Total Premium</span>
            </td>
        </tr>
    </table>

    @php
        $zone = $trip->coverageArea;
    @endphp

    <p style="text-align: right ; font-weight: bold ;">
        {{ $zone->zone_number == 1 ? 'هذا العقد يغطي جميع أنحاء العالم ما عدا ليبيا - أمريكا - كندا - اليابان - أستراليا' : 'هذا العقد يغطي أمريكا - كندا - اليابان - أستراليا' }}
    </p>
    <p style="text-align: left ; font-weight: bold ; border-bottom:1px solid black">
        {{ $zone->zone_number == 1 ? "Zone 1 $zone->title" : "Zone 2 $zone->title" }}
    </p>


    <table>
        <tr>
            <td style="text-align: right;">
                <img width="60px" src="data:image/png;base64,{{ $qrCode }}" alt="QR Code" />
            </td>
            <td style="text-align: left;">
                <p style="padding-top:0px ; font-weight:bold">
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    <span>التاريخ : </span> &nbsp;
                    &nbsp; <span>{{ $trip->policy->created_at }}</span> &nbsp; &nbsp;
                    &nbsp;
                    &nbsp;
                    <span> : Date</span>
                </p>
            </td>
        </tr>
    </table>

    {{-- View Image --}}
    @if (!empty($image))
        <h3>Car Insurance Image:</h3>
        {{ base_path('public/images/travel_insurance/' . $image) }}
        <img src="{{ base_path('public/images/travel_insurance/' . $image) }}" alt="Car Insurance Image"
            style="width: 200px; height: auto;" />
    @endif


    </div>
</body>

</html>
