@extends('emails.layouts.main')
@section('meta')
    <title> إعادة جدولة موعد الاستشارة</title>
@endsection
@section('main-container')
    <p>عزيزي المريض : {{$emailData['user']}}</p>
    <p>آملنا أن تكون بأتم الصحة والعافية. نود أن نعلمك بأنه تم إعادة جدولة موعد استشارتك الطبية المقررة في
    <span class="otp">
        {{$emailData['old_reservation_start_time']}} : {{$emailData['old_reservation_end_time']}} في تاريخ : {{$emailData['old_reservation_date']}}
    </span></p>
    <ul>
        التفاصيل الجديدة لموعدك هي كما يلي:
    </ul>
    <li> تاريخ الموعد الجديد: {{$emailData['reservation_date']}}</li>
    <li> وقت الموعد الجديد: {{$emailData['reservation_start_time']}} : {{$emailData['reservation_end_time']}}</li>
    <p>
        نعتذر عن أي إزعاج قد تسببه هذه الإعادة، ونأمل أن يكون الموعد الجديد مناسبًا لك. إذا كان لديك أي استفسارات أو إذا كنت بحاجة إلى إجراء تغييرات إضافية في الموعد، فيرجى الاتصال بنا مباشرة.
    </p>
    <p>
        نحن نهدف دائمًا إلى تقديم الرعاية الصحية بأعلى مستوى، ونحن نتطلع إلى رؤيتك في الموعد الجديد. إذا لديك أي احتياجات خاصة أو طلبات، فلا تتردد في مشاركتها معنا.
    </p>
    <p>
        شكرًا لتفهمك وتعاونك. نتمنى لك يومًا موفقًا.
    </p>
@endsection