
<?php
session_start();
require __DIR__.'/../includes/db.php';

if(!isset($_SESSION['admin_id'])){
    header('Location: login.php');
    exit;
}

$tp = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) total FROM products")
)['total'];

$tu = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) total FROM users")
)['total'];

$to = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) total FROM orders")
)['total'];

$tm = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) total FROM contacts")
)['total'];

$low = mysqli_query(
    $conn,
    "SELECT * FROM products WHERE stock<=5 ORDER BY stock ASC"
);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<?php include __DIR__.'/../includes/admin_navbar.php'; ?>

<main class="admin-main">

    <h1>Admin Dashboard</h1>

    <div class="admin-card-grid">

        <div class="admin-card">
            <h3>Total Products</h3>
            <p><?php echo $tp; ?></p>
        </div>

        <div class="admin-card">
            <h3>Total Users</h3>
            <p><?php echo $tu; ?></p>
        </div>

        <div class="admin-card">
            <h3>Total Orders</h3>
            <p><?php echo $to; ?></p>
        </div>

        <div class="admin-card">

            <h3>Customer Messages</h3>

            <p><?php echo $tm; ?></p>

            <a
                class="btn-primary"
                href="messages.php"
                style="display:inline-block; margin-top:10px;"
            >
                View Messages
            </a>

        </div>

    </div>


    <h2>Low Stock Products</h2>

    <table class="admin-table">

        <tr>
            <th>Product</th>
            <th>Stock</th>
            <th>Action</th>
        </tr>

        <?php while($p=mysqli_fetch_assoc($low)): ?>

            <tr>

                <td>
                    <?php echo htmlspecialchars($p['name']); ?>
                </td>

                <td>
                    <?php echo $p['stock']; ?>
                </td>

                <td>

                    <a
                        class="btn-primary"
                        href="restock.php?id=<?php echo $p['id']; ?>"
                    >
                        Restock
                    </a>

                </td>

            </tr>

        <?php endwhile; ?>

    </table>

</main>

</body>

</html>

