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
                    <td>عقد مشاركة المركبات الاجباري</td>
                    <td>Compulsory Insurance Policy</td>
                </tr>
            </table>
        </div>

        <div class="policy-no">
            <span> رقم الوثيقة : &nbsp; &nbsp; &nbsp; </span><span style="text-align: center">Policy No : &nbsp; &nbsp;
                &nbsp; </span><span class="number">{{ $policy->policy_number }}</span>
        </div>

        <table style="width: 100% ; font-size: 13px ; font-weight:bold">
            <tr>
                <td style="text-align: right ;">
                    <span>الوكيل :</span>
                </td>
                <td style="text-align: center">
                    <span>{{ $policy->branche->name }}</span>
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
                    <span>{{ $policy->user->first_name . ' ' . $policy->user->last_name }}</span>
                </td>
                <td style="text-align: left">
                    <span>: Insured Name </span>
                </td>
            </tr>
            <tr>
                <td style="text-align: right ; padding-top:10px">
                    <span>عنوانه :</span>
                </td>
                <td style="text-align: center">
                    <span>{{ $policy->user->address }}</span>
                </td>
                <td style="text-align: left">
                    <span>: Insured Address </span>
                </td>
            </tr>
            <tr>
                <td style="text-align: right ; padding-top:10px">
                    <span>رقم الهاتف :</span>
                </td>
                <td style="text-align: center">
                    <span>{{ $policy->user->phone }}</span>
                </td>
                <td style="text-align: left">
                    <span>: Tel Number </span>
                </td>
            </tr>
            <tr>
                <td style="text-align: right ; padding-top:10px">
                    <span>مدة التامين :</span>
                </td>
                <td style="text-align:">
                    <span> من يوم &nbsp; <span>{{ $policy->start_date }}</span></span> &nbsp; &nbsp;
                    <span>الي يوم &nbsp; <span>{{ $policy->end_date }}</span></span>
                </td>
                <td style="text-align: left">
                    <span>: Insured Period </span>
                </td>
            </tr>
        </table>

        <div style="margin-bottom: 25px"></div>

        <table style="width: 100% ; font-size: 13px ; border:2px solid black; padding:10px">
            <tr>
                <td style="text-align: right ; font-weight:bold;font-size:15px" colspan="2">
                    <span>بيانات المركبات </span>
                </td>
                <td style="text-align: left ;font-weight:bold;font-size:15px ; padding-bottom:13px">
                    <span>Data Vehicles</span>
                </td>
            </tr>
            <tr>
                <td style="text-align: right ;padding-top:10px">
                    <span>النوع :</span>
                </td>
                <td style="text-align: center">
                    <span>{{ $policy->vehicle->type . ' - ' . $policy->vehicle->model }}</span>
                </td>
                <td style="text-align: left">
                    <span> Car Type</span>
                </td>
            </tr>
            <tr>
                <td style="text-align: right ; padding-top:10px">
                    <span>الحمولة بالطن</span>
                </td>
                <td style="text-align: center">
                    <span>{{ $policy->vehicle->load_tonnage }}</span>
                </td>
                <td style="text-align: left">
                    <span>Load Tonnage</span>
                </td>
            </tr>
            <tr>
                <td style="text-align: right ; padding-top:10px">
                    <span>قوة المحرك </span>
                </td>
                <td style="text-align: center">
                    <span>{{ $policy->vehicle->engine_hours_power }}</span>
                </td>
                <td style="text-align: left">
                    <span>Engine Hours Power</span>
                </td>
            </tr>
            <tr>
                <td style="text-align: right ; padding-top:10px">
                    <span> عدد المقاعد (باستثناء السائق)</span>
                </td>
                <td style="text-align: center">
                    <span>{{ $policy->vehicle->number_of_seats }}</span>
                </td>
                <td style="text-align: left">
                    <span>Number of seats (Execluding driv)</span>
                </td>
            </tr>
            <tr>
                <td style="text-align: right ; padding-top:10px">
                    <span>سنة الصنع</span>
                </td>
                <td style="text-align: center">
                    <span>{{ $policy->vehicle->year_of_manufacturing }}</span>
                </td>
                <td style="text-align: left">
                    <span>Year of Manufacturing</span>
                </td>
            </tr>
            <tr>
                <td style="text-align: right ; padding-top:10px">
                    <span>رقم اللوحة</span>
                </td>
                <td style="text-align: center">
                    <span>{{ $policy->vehicle->plate_number }}</span>
                </td>
                <td style="text-align: left">
                    <span>Plate Number</span>
                </td>
            </tr>
            <tr>
                <td style="text-align: right ; padding-top:10px">
                    <span>رقم الهيكل</span>
                </td>
                <td style="text-align: center">
                    <span>{{ $policy->vehicle->chassis_number }}</span>
                </td>
                <td style="text-align: left">
                    <span>Chassis Number</span>
                </td>
            </tr>
            <tr>
                <td style="text-align: right ; padding-top:10px">
                    <span>لون السيارة</span>
                </td>
                <td style="text-align: center">
                    <span>{{ $policy->vehicle->color }}</span>
                </td>
                <td style="text-align: left">
                    <span>Color</span>
                </td>
            </tr>
            <tr>
                <td style="text-align: right ; padding-top:10px">
                    <span>الغرض من الترخيص</span>
                </td>
                <td style="text-align: center">
                    <span>{{ $policy->vehicle->purpose_of_license }}</span>
                </td>
                <td style="text-align: left">
                    <span>Purpose of License</span>
                </td>
            </tr>
        </table>

        <div style="margin-bottom: 25px"></div>

        <table style="width: 100% ; font-size: 13px ; border:2px solid black; padding:10px">
            <tr>
                <td style="text-align: right ; font-weight:bold;font-size:15px">
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
                    <span>{{ $policy->premium->net_premiums }}</span>
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
                    <span>{{ $policy->premium->tax }}</span>
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
                    <span>{{ $policy->premium->supervision_fees }}</span>
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
                    <span>{{ $policy->premium->stamps }}</span>
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
                    <span>{{ $policy->premium->issuance_fees }}</span>
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
                    <span>{{ $policy->premium->total_premium }}</span> &nbsp; &nbsp;
                    <span>{{ config('app.currency') }}</span>
                </td>
                <td style="text-align: left">
                    <span>Total Premium</span>
                </td>
            </tr>
        </table>

        <div style="margin-bottom: 20px"></div>

        <p style="text-align: center; font-weight:bold">
            <span>شركة التكافل للتأمين</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <span>.Insurance Takaful Co</span>
        </p>
        <p style="text-align: center; padding-top:0px ; font-weight:bold">
            <span>التاريخ : </span> &nbsp; &nbsp; <span>{{ $policy->created_at }}</span> &nbsp; &nbsp; &nbsp; &nbsp;
            <span> : Date</span>
        </p>
        <p>
            <img width="80px" dir="ltr" src="data:image/png;base64,{{ $qrCode }}" alt="QR Code" />
        </p>
        @if ($imageCarBrochure)
            <h3>Image Car Brochure : </h3>
            <img src="{{ $imageCarBrochure }}" alt="Car Insurance Image" style="width: 200px; height: auto;" />
        @endif
    </div>
</body>

</html>
