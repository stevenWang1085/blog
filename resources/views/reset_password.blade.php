<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
<h3 style="color:blue;">{{ $subject }}</h3>
{!! $content !!}
<a href="{{$link}}"> 重置連結，請點此 (連結有效時間為五分鐘，至{{$link_limit_time}}為止)</a>

<div style="color:gray;">
    <br /><br /><br />---<br />
    此通知信件為系統自動寄發，請勿回覆，謝謝。
</div>
</body>
</html>
