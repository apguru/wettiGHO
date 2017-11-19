Bitte folge dem Link um dein Passwort zurückzusetzten: <br>

<a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}">{{ $link }}</a>