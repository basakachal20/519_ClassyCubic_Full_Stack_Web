
<?php
session_start();

require_once "../includes/db.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}


/* =========================
   SAVE ADMIN REPLY
========================= */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $message_id = isset($_POST['message_id'])
        ? intval($_POST['message_id'])
        : 0;

    $admin_reply = isset($_POST['admin_reply'])
        ? trim($_POST['admin_reply'])
        : '';

    if ($message_id > 0 && $admin_reply !== '') {

        $admin_reply = mysqli_real_escape_string(
            $conn,
            $admin_reply
        );

        $sql = "UPDATE contacts
                SET admin_reply = '$admin_reply'
                WHERE id = $message_id";

        mysqli_query($conn, $sql);
    }

    header("Location: messages.php");
    exit();
}


/* =========================
   GET CUSTOMER MESSAGES
========================= */

$result = mysqli_query(
    $conn,
    "SELECT * FROM contacts ORDER BY created_at DESC"
);

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Customer Messages - ClassyCubic</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 30px;
        }

        h1 {
            text-align: center;
            margin-bottom: 25px;
        }

        .back {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 16px;
            background: #333;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
            vertical-align: top;
        }

        th {
            background: #222;
            color: white;
        }

        tr:nth-child(even) {
            background: #f8f8f8;
        }

        .message {
            max-width: 300px;
            word-wrap: break-word;
        }

        .reply-box {
            width: 250px;
            min-height: 80px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: vertical;
        }

        .reply-button {
            margin-top: 8px;
            padding: 8px 15px;
            background: #10d1f3;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .reply-button:hover {
            opacity: 0.85;
        }

        .admin-reply {
            margin-bottom: 10px;
            padding: 8px;
            background: #e8f8ff;
            border-left: 4px solid #10d1f3;
        }

    </style>

</head>


<body>


<h1>Customer Contact Messages</h1>


<a href="dashboard.php" class="back">
    ← Back to Dashboard
</a>


<table>

    <tr>

        <th>ID</th>

        <th>Name</th>

        <th>Email</th>

        <th>Customer Message</th>

        <th>Date</th>

        <th>Admin Reply</th>

    </tr>


    <?php if ($result && mysqli_num_rows($result) > 0): ?>


        <?php while ($row = mysqli_fetch_assoc($result)): ?>

            <tr>

                <td>
                    <?php echo $row['id']; ?>
                </td>


                <td>
                    <?php
                    echo htmlspecialchars($row['name']);
                    ?>
                </td>


                <td>
                    <?php
                    echo htmlspecialchars($row['email']);
                    ?>
                </td>


                <td class="message">

                    <?php
                    echo nl2br(
                        htmlspecialchars($row['message'])
                    );
                    ?>

                </td>


                <td>
                    <?php
                    echo htmlspecialchars(
                        $row['created_at']
                    );
                    ?>
                </td>


                <td>


                    <?php if (!empty($row['admin_reply'])): ?>

                        <div class="admin-reply">

                            <strong>Replied:</strong>

                            <br>

                            <?php
                            echo nl2br(
                                htmlspecialchars(
                                    $row['admin_reply']
                                )
                            );
                            ?>

                        </div>

                    <?php endif; ?>


                    <form method="POST">

                        <input
                            type="hidden"
                            name="message_id"
                            value="<?php
                                echo $row['id'];
                            ?>"
                        >


                        <textarea
                            name="admin_reply"
                            class="reply-box"
                            placeholder="Write your reply..."
                            required
                        ></textarea>


                        <br>


                        <button
                            type="submit"
                            class="reply-button"
                        >

                            <?php

                            if (!empty($row['admin_reply'])) {

                                echo "Update Reply";

                            } else {

                                echo "Save Reply";

                            }

                            ?>

                        </button>

                    </form>


                </td>

            </tr>

        <?php endwhile; ?>


    <?php else: ?>

        <tr>

            <td
                colspan="6"
                style="text-align:center;"
            >
                No messages found.
            </td>

        </tr>

    <?php endif; ?>


</table>


</body>

</html>

