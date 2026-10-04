<?php

session_start();

require __DIR__ . '/includes/db.php';

$messages = [];
$email = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "Please enter a valid email address.";

    } else {

        $stmt = mysqli_prepare(
            $conn,
            "SELECT id, name, email, message, admin_reply, created_at
             FROM contacts
             WHERE email = ?
             ORDER BY created_at DESC"
        );

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);

            mysqli_stmt_bind_result(
                $stmt,
                $id,
                $name,
                $customer_email,
                $message,
                $admin_reply,
                $created_at
            );

            while (mysqli_stmt_fetch($stmt)) {

                $messages[] = [
                    'id' => $id,
                    'name' => $name,
                    'email' => $customer_email,
                    'message' => $message,
                    'admin_reply' => $admin_reply,
                    'created_at' => $created_at
                ];
            }

            mysqli_stmt_close($stmt);

        } else {

            $error = "Unable to load messages.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>My Messages - ClassyCubic</title>

<style>

* {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f4f6f9;
    color: #222;
}

.container {
    width: 90%;
    max-width: 900px;
    margin: 50px auto;
}

.back {
    display: inline-block;
    margin-bottom: 20px;
    text-decoration: none;
    color: #333;
    font-weight: bold;
}

h1 {
    text-align: center;
    margin-bottom: 30px;
}

.search-box {
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    margin-bottom: 30px;
}

.search-box label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
}

.search-box input {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 7px;
    margin-bottom: 15px;
    font-size: 15px;
}

.search-box button {
    padding: 12px 22px;
    border: none;
    border-radius: 7px;
    background: #10d1f3;
    color: white;
    font-weight: bold;
    cursor: pointer;
}

.search-box button:hover {
    opacity: 0.9;
}

.message-card {
    background: white;
    padding: 25px;
    margin-bottom: 20px;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.customer-message {
    background: #f5f5f5;
    padding: 15px;
    margin: 10px 0;
    border-radius: 8px;
    line-height: 1.6;
}

.admin-reply {
    background: #e8fbff;
    border-left: 5px solid #10d1f3;
    padding: 15px;
    margin-top: 15px;
    border-radius: 6px;
    line-height: 1.6;
}

.no-reply {
    color: #777;
    font-style: italic;
    margin-top: 15px;
}

.error {
    background: #ffe5e5;
    color: #c00;
    padding: 12px;
    border-radius: 7px;
    margin-bottom: 15px;
}

.no-message {
    text-align: center;
    background: white;
    padding: 25px;
    border-radius: 10px;
}

.date {
    color: #777;
    font-size: 14px;
}

</style>

</head>

<body>

<div class="container">

<a href="index.php" class="back">← Back to Home</a>

<h1>My Messages</h1>

<div class="search-box">

<form method="POST">

<label>
Enter the email you used to contact us:
</label>

<input
    type="email"
    name="email"
    value="<?php echo htmlspecialchars($email); ?>"
    placeholder="Enter your email address"
    required
>

<button type="submit">
Check Messages
</button>

</form>

</div>


<?php if ($error !== ''): ?>

<div class="error">
    <?php echo htmlspecialchars($error); ?>
</div>

<?php endif; ?>


<?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && $error === ''): ?>

    <?php if (count($messages) > 0): ?>

        <?php foreach ($messages as $row): ?>

            <div class="message-card">

                <p>
                    <strong>Your Name:</strong>
                    <?php echo htmlspecialchars($row['name']); ?>
                </p>

                <p class="date">
                    <strong>Date:</strong>
                    <?php echo htmlspecialchars($row['created_at']); ?>
                </p>

                <strong>Your Message:</strong>

                <div class="customer-message">
                    <?php
                    echo nl2br(
                        htmlspecialchars($row['message'])
                    );
                    ?>
                </div>


                <?php if (!empty($row['admin_reply'])): ?>

                    <div class="admin-reply">

                        <strong>Admin Reply:</strong>

                        <br><br>

                        <?php
                        echo nl2br(
                            htmlspecialchars($row['admin_reply'])
                        );
                        ?>

                    </div>

                <?php else: ?>

                    <p class="no-reply">
                        Admin has not replied yet.
                    </p>

                <?php endif; ?>

            </div>

        <?php endforeach; ?>

    <?php else: ?>

        <div class="no-message">

            No messages found for this email address.

        </div>

    <?php endif; ?>

<?php endif; ?>

</div>

</body>

</html>