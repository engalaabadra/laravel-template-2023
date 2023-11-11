<!DOCTYPE html>
<html>
<head>
    <title>تأكيد حجز</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
        }
        .header {
            text-align: center;
            padding: 20px;
        }
        .header h1 {
            color: #274d70;
        }
        .header img {
            max-width: 150px;
        }
        .content {
            padding: 20px;
        }
        .content p {
            color: #333;
            font-size: 16px;
        }
        .otp {
            font-size: 24px;
            color: #274d70;
        }
        .footer {
            text-align: center;
            padding: 20px;
        }
        .footer p {
            color: #888;
        }
        .social-icons {
            margin-top: 20px;
        }
        .social-icons a {
            text-decoration: none;
            color: #274d70;
            margin: 0 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <img src="{{asset('dashboard_assets/Template.png')}}" alt="Company Logo">
        <h1>تذكير حجز</h1>
    </div>
    <div class="content">
        <p>مرحبا,</p>
        <p> يوجد لديك حجز بعد نصف ساعة من الان من قبل : <span class="otp">{{$emailData['message']}}</span></p>
    </div>
    <p>تحياتنا </p>
    <p>Template 👋</p>
    <div class="footer">
        <div class="social-icons">
            <a href="https://www.facebook.com/TemplateApp" target="_blank">Facebook</a>
            <a href="https://twitter.com/Templateco" target="_blank">Twitter</a>
            <a href="https://www.instagram.com/templateco/" target="_blank">Instagram</a>
            <a href="https://www.youtube.com/channel/UC9E9CQeyAkiWYjPqSG7FS_A" target="_blank">YouTube</a>
            <a href="https://www.linkedin.com/company/100702383/admin/feed/posts/?feedType=following&shareMsgArgs=null" target="_blank">LinkedIn</a>
        </div>
    </div>
</div>
</body>
</html>
