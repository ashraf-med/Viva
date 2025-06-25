
<!DOCTYPE html>
<html>
<head>
    <title>vivaproject.com</title>
</head>
<body>
<strong>Dear sir</strong>
<p>project name:{{ $mailData['pname'] }}</p>
<p>project year:{{ $mailData['year'] }}</p>
<p>president name:{{ $mailData['prname'] }}</p>
<p>president mark:{{ $mailData['prmark'] }}</p>
<p>supervisor name:{{ $mailData['sname'] }}</p>
<p>supervisor mark:{{ $mailData['smark'] }}</p>
<p>examiner name:{{ $mailData['ename'] }}</p>
<p>examiner mark:{{ $mailData['emark'] }}</p>
<p>students names:-{{ $mailData['s1name'] }}     @if($mailData['s2name'])  - {{ $mailData['s2name'] }} @endif @if($mailData['s3name']) - {{ $mailData['s3name'] }}@endif</p>
<p>final mark:{{ $mailData['fmark'] }}</p>



<p>Thank you</p>
</body>
</html>
