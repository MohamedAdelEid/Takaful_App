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

        .policy {
        }

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
                &nbsp; </span><span class="number">M552405MTR1030001</span>
        </div>

        <table style="width: 100% ; font-size: 13px ; font-weight:bold">
            <tr>
                <td style="text-align: right ;">
                    <span>الوكيل :</span>
                </td>
                <td style="text-align: center">
                    <span>مكتب محمد عادل</span>
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
                    <span>mohamed adel</span>
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
                    <span></span>
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
                    <span></span>
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
                    <span> من يوم &nbsp; <span>6/5/2024</span></span> &nbsp; &nbsp;
                    <span>الي يوم &nbsp; <span>5/8/2006</span></span>
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
                    <span>ودي - 8A</span>
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
                    <span></span>
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
                    <span>16</span>
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
                    <span>4</span>
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
                    <span>2020</span>
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
                    <span>20202</span>
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
                    <span>01212</span>
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
                    <span>أسود</span>
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
                    <span>خاصة</span>
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
                    <span>64.000</span>
                </td>
                <td style="text-align: left">
                    <span>Net Premium</span>
                </td>
            </tr>
            <tr>
                <td style="text-align: right ; padding-top:10px">
                    <span>لضريبة</span>
                </td>
                <td>
                    <span>1.000</span>
                </td>
                <td style="text-align: left">
                    <span>Tax</span>
                </td>
            </tr>
            <tr>
                <td style="text-align: right ; padding-top:10px">
                    <span>رسوم إشراف</span>
                </td>
                <td>
                    <span>0.320</span>
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
                    <span>0.500 </span>
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
                    <span>2020</span>
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
                    <span>68.820</span> &nbsp; &nbsp;
                    <span>L.D</span>
                </td>
                <td style="text-align: left">
                    <span>Total Premium</span>
                </td>
            </tr>
        </table>

        <div style="margin-bottom: 50px"></div>

        <p style="text-align: center; padding-top:10px ; font-weight:bold">
            <span>شركة التكافل للتأمين</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <span>.Insurance Takaful Co</span>
        </p>
        <p style="text-align: center; padding-top:0px ; font-weight:bold">
            <span>التاريخ : </span> &nbsp; &nbsp; <span>5/4/2024</span> &nbsp; &nbsp; &nbsp; &nbsp;
            <span> : Date</span>
        </p>

    </div>
</body>

</html>
