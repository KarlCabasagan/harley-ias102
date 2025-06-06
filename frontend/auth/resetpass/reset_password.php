<?php

$email = $_GET['email'] ?? '';

include 'backend\database\config.php'; 
if ($email != '') {
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result->fetch_assoc()) {
        die('This email is not found in our records.');
    }
} else {
    die('Invalid request.');
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Reset Password</title>
    <link rel="icon" type="image/x-icon" href="../../logo.svg">
    <style>
        :root {
            --dashboard-primary: #f97316;          /* vibrant orange */
            --dashboard-primary-dark: #c2410c;     /* deeper orange */
            --dashboard-background: #0f172a;       /* dark navy */
            --dashboard-surface: #1e293b;          /* dark slate panel */
            --dashboard-text: #fef3c7;             /* warm light for text */
            --dashboard-text-secondary: #fcd34d;   /* soft golden yellow */
            --dashboard-error: #ef4444;            /* red for errors */
            --dashboard-success: #10b981;          /* green for success messages */
            --dashboard-border: #f97316;           /* orange-tinted borders */
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, var(--dashboard-background), var(--dashboard-surface));
            color: var(--dashboard-text);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .box {
            background: var(--dashboard-surface);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 20px var(--dashboard-primary);
            width: 90%;
            max-width: 400px;
            text-align: center;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 8px;
            background: #333;
            color: var(--dashboard-primary);
        }

        input[type="submit"] {
            background: var(--dashboard-primary);
            color: var(--dashboard-text);
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        input[type="submit"]:hover {
            background: var(--dashboard-primary-dark);
            color: white;
        }
    </style>
</head>

<body>
    <div class="box">
        <h2>Reset Your Password</h2>
        <form action="process_reset.php" method="POST">
            <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
            <input type="password" name="new_password" placeholder="New Password" required>
            <input type="submit" value="Reset Password">
        </form>
    </div>
</body>

</html>