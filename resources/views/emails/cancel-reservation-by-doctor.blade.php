@extends('emails.layouts.main')
@section('meta')
    <title> إلغاء حجز موعد طبي </title>
@endsection
@section('main-container')
    <p>مرحبا : {{$emailData['user']}}</p>
    <p>
    <p>
        نأسف لإبلاغك بأنه تم إلغاء موعدك الطبي الذي كان مقررًا في
    </p>
    
    <span class="otp">
        {{$emailData['reservation_date']}}
    </span>
    يعتذر الطبيب عن هذا الإلغاء غير المتوقع.
</p>
<ul>
    بيانات الحجز :
    <li> تاريخ الحجز : {{$emailData['reservation_date']}}</li>
    <li> وقت الحجز : {{$emailData['reservation_start_time']}} : {{$emailData['reservation_end_time']}}  </li>
    <li> اسم الطبيب : {{$emailData['doctor']}}  </li>
</ul>
    <p>
        نود أن نلفت انتباهك إلى أن الرصيد الذي تم دفعه مسبقًا لهذا الموعد تم اعتماده في محفظتك الشخصية على التطبيق الخاص بك.
    </p>
    <p>
        الرصيد في محفظتك يمكن استخدامه لحجز مواعيد طبية مستقبلية. إذا كان لديك أي استفسار أو تحتاج إلى مزيد من المساعدة، فلا تتردد في الاتصال بنا عبر البريد الإلكتروني أو الهاتف.
    </p>
    <p>
        نعتذر مجددًا عن أي إزعاج ناتج عن هذا الإلغاء، ونتطلع إلى خدمتك في المستقبل.
    </p>
@endsection
