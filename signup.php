<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>Sign Up</title>
    <style>
        /* Styling for the form container */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px; /* Fixed width for the form */
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Sign Up</h2>
            <form action="signup_action.php" method="POST">
                <select name="user_type" required>
                    <option value="student">Student</option>
                    <option value="mentor">Mentor</option>
                    <option value="staff">Staff</option>
                    <option value="hod">HOD</option>
                    <option value="principal">Principal</option>
                    <option value="admin">Admin</option>
                </select>
                <input type="text" name="identifier" placeholder="Roll Number / Email ID" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Sign Up</button>
            </form>
            <p style="text-align: center; margin-top: 20px;">Already have an account? <a href="signin.html">Sign In</a></p>
        </div>
    </div>
</body>
</html>
