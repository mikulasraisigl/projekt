<!-- resources/views/auth/register.blade.php -->
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrace</title>
</head>
<body>
<h1>Registrace</h1>


<form method="POST" action="{{ route('register') }}">
    <div>
        <label for="name">Jméno:</label>
        <input type="text" id="name" name="name" value="" required>



    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="" required>



    </div>
    <div>
        <label for="password">Heslo:</label>
        <input type="password" id="password" name="password" required>



    </div>
    <div>
        <label for="password_confirmation">Potvrzení hesla:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
    </div>
    <button type="submit">Registrovat</button>
</form>
</body>
</html>
