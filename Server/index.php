<?php
require("db.inc.php");

if (!empty($_SESSION[$sessionName]) && !empty($_POST['caption'])) {
    $caption = $dblink->escapeString($_POST['caption']);
    $link = !empty($_POST['link']) ? $dblink->escapeString($_POST['link']) : "";
    $priority = !empty($_POST['priority']) ? $dblink->escapeString($_POST['priority']) : "2";
    $importance = !empty($_POST['importance']) ? $dblink->escapeString($_POST['importance']) : "0";
    $country = !empty($_POST['country']) ? $dblink->escapeString($_POST['country']) : "0";
    $countryT = $countries[$country];
    $sql = "INSERT INTO `orders` 
            (`caption`, `link`, `priority`, `country`, `importance`)
        VALUES
            ('$caption', '$link', '$priority', '$countryT', $importance) ";
    $dblink->query($sql);
    $_SESSION['success'] = "Added";
    header("Location: $self");
    exit;
} else if (!empty($_POST['caption']) && empty($_SESSION[$sessionName])) {
    header('HTTP/1.0 403 Forbidden');
    echo 'You are not validated to change instructions!';
    exit;
}
if (!empty($_POST['username'])) {
    if ($_POST['username'] == 'master' and $_POST['password'] == 'Dr$mAQu33n') { // user/password in plain text. Can be changed. :-D
        $_SESSION[$sessionName] = true;
        header("Location: $self");
        exit;
    }
}
if (!empty($_SESSION[$sessionName]) && !empty($_GET['del'])) {
    $id = preg_replace("/[^0-9]/", "", $_GET['del']);
    if (!empty($id)) {
        $sql = "DELETE FROM `orders` WHERE `id` = '$id'";
        $dblink->query($sql);
    }
    $_SESSION['success'] = "Deleted";
    header("Location: $self");
    exit;
}
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Erepublik tools</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
            body {
                padding-top: 50px;
            }
            .starter-template {
                padding: 40px 15px;
                text-align: center;
            }
            li {
                overflow: hidden;
            }
            .importance {
                cursor: pointer;
            }
            @media (min-width: 600px) {
                .importance {
                    margin-right: 6px;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="col-lg-6">
                <ul class="list-group">
                    <li class="list-group-item active">Battle orders</li>
                    <?php
                    $sql = "SELECT id, caption, link, date, priority, importance, country
                            FROM orders 
                            ORDER BY importance DESC, priority DESC, id ASC";
                    ($q = $dblink->query($sql)) || die($dblink->error);
                    if (count($q) > 0) {
                        while ($row = $q->fetchArray(SQLITE3_ASSOC)) {
                            $id = $row['id'];
                            $caption = $row['caption'];
                            $battleId = preg_replace("/[^0-9]/", '', $row['link']);
                            $date = $row['date'];
                            $priority = $row['priority'];
                            $importance = $row['importance'];
                            $img = $flags[$priority];
                            $country = preg_replace("/[\(\)]/", "", preg_replace("/\ /", '-', $row['country']));
                            $link = 'https://www.erepublik.com/en/military/battlefield' . ($priority < 3 ? '-choose-side' : '') . '/' . $battleId . ($priority < 3 ? "/" . array_search($row['country'], $countries) : '');
                            $link = empty($row['link']) ? "javascript:void(0);" : $link;
                            echo "
                            <li class='list-group-item in-bl'>
                                <img src='$img' alt='' width='150px'>
                                <img src='https://www.erepublik.net/images/flags_png/L/{$country}.png' alt=''>
                                <a href='$link' title='$date' target='_blank'>$caption</a>";
                            if (!empty($_SESSION[$sessionName])) {
                                echo "
                                <button type='button' class='btn btn-xs btn-danger pull-right' onclick='dn($id)' title='delete'>X</button>";
                            }
                            echo "
                                <span class='pull-right badge importance' title='Importance'>$importance</span>
                            </li>
                            ";
                        }
                    } else {
                        echo "<li class='list-group-item'>No orders set</li>\n";
                    }
                    ?>
                </ul>
            </div>
            <?php if (empty($_SESSION[$sessionName])) { ?>
                <div class="col-lg-6">
                    <form class="form-signin" method="post" action="index.php">
                        <h2 class="form-signin-heading">Please authorize</h2>
                        <div class="form-group">
                            <label for="inputUser" class="sr-only">Username</label>
                            <input type="text" id="inputUser" name="username" class="form-control" placeholder="Username" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="sr-only">Password</label>
                            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
                    </form>
                </div>
            <?php } ?>
            <?php if (!empty($_SESSION[$sessionName])) {
                ?>
                <div class="row">
                    <div class="col-lg-6">
                        <?php if (!empty($_SESSION['success'])) { ?>
                            <div class="alert alert-success">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                Order set!
                            </div>
                            <?php
                            unset($_SESSION['success']);
                        }
                        ?>
                        <form method="post" action="<?php echo $self; ?>">
                            <div class="form-group">
                                <label>Country</label>
                                <select name="country" class="form-control">
                                    <option value="" selected="selected">Select country</option>
                                    <?php
                                    foreach ($countries as $cId => $cName) {
                                        echo "                                    <option value='$cId'>$cName</option>\n";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Region (instructions)</label>
                                <input type="text" class="form-control" name="caption" value="" placeholder="Example.: Region (English name)" required>
                            </div>
                            <div class="form-group">
                                <label>Link to the battle</label>
                                <input type="text" class="form-control" name="link" value="" placeholder="https://www.erepublik.com/en/military/battlefield/76842">
                            </div>
                            <div class="form-group">
                                <label>Priority</label>
                                <select name="priority" class="form-control">
                                    <option value="1">RW, red flag (releasing)</option>
                                    <option value="2">RW, green flag (keep)</option>
                                    <option value="3" selected="">Direct battle grey flag</option>
                                    <option value="4">Direct battle blue flag</option>
                                    <option value="5">Direct battle green flag</option>
                                    <option value="6">Direct battle red flag</option>
                                    <option value="7">Direct battle black flag</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Importance (wage)</label>
                                <select name="importance" class="form-control">
                                    <option value="0" selected="">Grey/blue flag</option>
                                    <option value="1">Green flag</option>
                                    <option value="2">Red flag</option>
                                    <option value="3">Black flag</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-success">Set</button>
                            </div>
                        </form>
                        <?php if (true) { ?>
                        <div class="form-group">
                            <button type="button" onclick="location.href = 'instrukcii.php'" class="form-control btn btn-info">Code for the newspaper</button>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script>
                function dn(id) {
                    if (confirm("Confirm")) {
                        location.href = '<?php echo $self; ?>?del=' + id;
                    }
                }
                $(function() {
                    $('body > a').hide();
                })
        </script>
    </body>
</html>