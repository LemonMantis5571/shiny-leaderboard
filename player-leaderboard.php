<?php
function getUsersData($file) {
    $json = file_get_contents($file);
    $data = json_decode($json, true);
    return $data['users'];
}

function sortUsersByCount($users) {
    usort($users, function ($a, $b) {
        return $b['count'] - $a['count'];
    });
    return $users;
}

$users = getUsersData('users/users.json');
$sortedUsers = sortUsersByCount($users);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokeMMO Player OT Shiny Leaderboard</title>
    <?php include 'styles-scripts.php'; ?>
</head>
<body>
    <?php include 'nav.php'; ?>
    <div class="container">
        <h1>PokeMMO Player OT Shiny Leaderboard</h1>
        <table>
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Username</th>
                    <th>Total Shinies</th>
                    <th>Team</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sortedUsers as $index => $user) : ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo $user['count']; ?></td>
                        <td><a href="<?php echo htmlspecialchars($user['team']['url']); ?>" target="_blank"><?php echo htmlspecialchars($user['team']['name']); ?></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
