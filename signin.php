<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
</head>
<body>
    <h2>Sign In</h2>
    <form action="signin_action.php" method="POST">
        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="Student">Student</option>
            <option value="Mentor">Mentor</option>
            <option value="HOD">HOD</option>
            <option value="Principal">Principal</option>
            <option value="Admin">Admin</option>
        </select>

        <div id="commonFields">
            <label for="username">Roll Number / Email:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit">Sign In</button>
        <button type="button" onclick="window.location.href='signup.php'">Sign Up</button>
    </form>
</body>
</html>
