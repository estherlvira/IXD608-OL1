<?php
$filename = "parts/users.json";
$users = json_decode(file_get_contents($filename), true);

if (isset($_GET['id'], $_GET['crud']) && $_GET['crud'] == "update") {
    $id = (int)$_GET['id'];

    $users[$id] = [
        "name"    => $_POST['user-name'],
        "type"    => $_POST['user-type'],
        "email"   => $_POST['user-email'],
        "classes" => array_map('trim', explode(",", $_POST['user-classes'])),
    ];

    file_put_contents($filename, json_encode($users, JSON_PRETTY_PRINT));

    header("Location: users-index.php?id=$id");
    exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$user = ($id !== null && isset($users[$id])) ? $users[$id] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User List</title>

    <?php include "parts/meta.php"; ?> 

</head>
<body>

<header class="navbar">
    <div class="container navbar-inner">
        <h2 class="h2-light navbar-logo">User Admin</h2>

        <div class="navbar-menu">
            <nav class="nav">
                <ul>
                    <li><a href="users-index.php">User List</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<div class="container" id="tableofcontents">

<?php if ($user): ?> 

    <nav class="nav nav-crumbs">
        <ul>
            <li><a href="users-index.php">Back</a></li>
        </ul>
    </nav>

<div class="card soft">
        <h2>Edit User</h2>

        <form method="post" action="users-index.php?id=<?= $id ?>&crud=update">

            <div class="form-control">
                <label for="user-name" class="form-label">Name</label>
                <input id="user-name" name="user-name" type="text" class="form-input"
                       value="<?= htmlspecialchars($user['name']) ?>">
            </div>

            <div class="form-control">
                <label for="user-type" class="form-label">Type</label>
                <select id="user-type" name="user-type" class="form-input">
                    <?php foreach (["teacher", "student" ] as $type): ?>
                        <option value="<?= $type ?>"  <?= $user['type'] == $type ? "selected" : "" ?>>
                            <?= ucfirst($type) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-control">
                <label for="user-email" class="form-label">Email</label>
                <input id="user-email" name="user-email" type="email" class="form-input"
                       value="<?= htmlspecialchars($user['email']) ?>">
            </div>

            <div class="form-control">
                <label for="user-classes" class="form-label">Classes</label>
                <input id="user-classes" name="user-classes" type="text" class="form-input"
                       value="<?= htmlspecialchars(implode(", ", $user['classes'])) ?>">
            </div>

            <div class="form-control">
                <input type="submit" class="form-button" value="Save Changes">
            </div>
        </form>
    </div>

<?php else: ?>

    <h2>User List</h2>

    <div class="card soft">
        <nav class="nav">
            <ul>
                <?php foreach ($users as $index => $u): ?>
                    <li><a href="users-index.php?id=<?= $index ?>"><?= htmlspecialchars($u['name']) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>

<?php endif; ?>

</div>
</body>
</html>