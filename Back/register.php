<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER</title>
</head>
<body>
    <form action="registerDatos.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" placeholder="Username" required>
        <label for="email">Email:</label>
        <input type="email" name="email" placeholder="Email" required>
        <label for="name">Name:</label>
        <input type="text" name="name" placeholder="Name" required>
        <label for="firstSurname">First Surname:</label>
        <input type="text" name="firstSurname" placeholder="First Surname" required>
        <label for="secondSurname">Second Surname:</label>
        <input type="text" name="secondSurname" placeholder="Second Surname" required>
        <label for="password">Password:</label>
        <input type="password" name="password" placeholder="Password" required>
        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" name="confirmPassword" placeholder="Confirm Password" required>
        <label for="dni">DNI:</label>
        <input type="text" name="dni" placeholder="DNI" required>
        <label for="interested">I am interested in distributing content on VEX</label>
        <input type="checkbox" name="interested">
        <label for="terms">I agree to the terms and conditions</label>
        <input type="checkbox" name="terms" required>
        <div class="g-recaptcha" data-sitekey="6LfzikksAAAAANlB-hHh0Lw3ozKIOMAspxtvpA7A"></div>

        <button type="submit">REGISTER</button>
    </form>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>