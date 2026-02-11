<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Emails</title>
</head>
<body>
  @foreach ($messages as $message)
      <p>{{ $message->getSubject() }}</p>
      <p>{{ $message->getFrom()[0]->mail }}</p>
      <p>{{ $message->date }}</p>
      <p>{!! $message->getHTMLBody() !!}</p>
  @endforeach
</body>
</html>