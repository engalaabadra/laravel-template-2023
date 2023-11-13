@extends('emails.layouts.main')
@section('meta')
    <title> تأكيد حجز موعد طبي </title>
@endsection
@section('main-container')
    <p>مرحبا : {{$emailData['user']}}</p>
    <p>
    <p>
        نحن نشكرك على حجز موعد طبي مع الدكتور
    </p>

    <span class="otp">
            {{$emailData['doctor']}}
    </span>
    </p>
    <ul>
    يسرنا تأكيد حجزك للموعد التالي:
    <li> تاريخ الموعد : {{$emailData['reservation_date']}}</li>
    <li> وقت الموعد : {{$emailData['reservation_start_time']}} : {{$emailData['reservation_end_time']}}  </li>
    </ul>
    <p>
        نرجو منك الالتزام بالوقت المحدد للموعد. في حال كنت بحاجة إلى إلغاء الموعد أو إعادة جدولته، يُرجى الاتصال بنا مسبقًا.
    </p>
    <p>
        نشير إلى أن الرصيد الذي تم دفعه مسبقًا لهذا الموعد سيتم اعتماده في حسابك الشخصي على التطبيق
    </p>
    <p>
        إذا كنت بحاجة إلى استفسارات إضافية أو مزيد من المعلومات، فلا تتردد في الاتصال بنا عبر البريد الإلكتروني أو الهاتف.
    </p>
    <p>
        نتطلع إلى خدمتك وتقديم الرعاية الصحية الممتازة.
    </p>
@endsection
