@extends('emails.layouts.main')
@section('meta')
    <title> استشارة مريض جديد </title>
@endsection
@section('main-container')

    <p>عزيزي الدكتور : {{$emailData['doctor']}}</p>

    <ul>
    أود أن أقدم لك تفاصيل حول مريض جديد يرغب في استشارتك. الرجاء مراجعة المعلومات أدناه:
    <li> اسم المريض : {{$emailData['user']}}</li>
    <li> تاريخ الميلاد : {{$emailData['reservation_birth_date']}}</li>
    <li> سبب الاستشارة : {{$emailData['reservation_problem']}}</li>
    </ul>
    <p>
        إذا كنت بحاجة إلى مزيد من المعلومات أو لديك أسئلة إضافية حول هذا المريض، تستطيع متابعة الحجز من التطبيق
    </p>
    <p>
        نحن نثمن تعاونك وجهوزيتك لخدمة مرضانا. شكرًا مقدمًا على وقتك واهتمامك.
    </p>
       
@endsection
