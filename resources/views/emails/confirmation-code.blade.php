Bonjour {{$user->email}}  <br>

Votre code de confirmation est arrivé, <br>

cliquez sur ce lien pour l'activer <a href="{{ action('Auth\ConfirmationController@confirmMailCode', ['code' => $code->confirmation_code]) }}">Lien d'activation</a>