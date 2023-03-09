Chào bạn, <b>{{ $data['email'] }}</b>
<br>
Bạn vào đây để kích hoạt nè: <a href="{{ env('APP_URL') }}/active/{{ $data['hash_active'] }}">Tại đây</a>
