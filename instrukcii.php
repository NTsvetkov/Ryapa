<?php
require ("db.inc.php");
$self = 'instrukcii.php';

$keys = array('header', 'rws', 'team', 'footer');

if (!empty($_SESSION[$sessionName]) && !empty($_POST['data'])) {
    $data = $_POST['data'];
    foreach ($keys as $key) {
        $text = !empty($data[$key]) ? $dblink->escapeString($data[$key]) : "";
            $sql = <<<END
UPDATE texts SET value = '$text' WHERE key = '$key';
END;
        $dblink->query($sql);

    }
}

$data = array();
foreach ($keys as $key) {
    $sql = <<<END
    SELECT 
        value
    FROM
        texts
    WHERE
        key = '$key'
END;
    $q = $dblink->query($sql);
    $row = $q->fetchArray(SQLITE3_ASSOC);
    $data[$key] = $row['value'];
}
$stars = "*******";
$win = 'България 👍 ПЕЧЕЛИ: ';
$lose = 'България 👎 ГУБИ: ';
$win2 = "БЪЛГАРИЯ ✅ ПЕЧЕЛИ:\n\n";
$lose2 = "БЪЛГАРИЯ ❌ ГУБИ: \n\n";
$sql = "SELECT caption, importance  FROM orders WHERE country='Bulgaria' ORDER BY importance DESC, date ASC";
$q = $dblink->query($sql);
while ($row = $q->fetchArray(SQLITE3_ASSOC)) {
    $win .= $row['caption'] . substr($stars, 0, $row['importance']) . ', ';
    $win2 .= "✅ " . $row['caption'] . substr($stars, 0, $row['importance']) . "\n";
}
$sql = "SELECT caption, importance  FROM orders WHERE country<>'Bulgaria' ORDER BY importance DESC, date ASC";
$q = $dblink->query($sql);
while ($row = $q->fetchArray(SQLITE3_ASSOC)) {
    $lose .= $row['caption'] . substr($stars, 0, $row['importance']) . ', ';
    $lose2 .= "❌ " . $row['caption'] . substr($stars, 0, $row['importance']) . "\n";
}
$win = preg_replace('/\,\ $/', '.', $win);
$lose = preg_replace('/\,\ $/', '.', $lose);
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Военни инструкции</title>
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
            textarea.form-control {
                height: 400px;
            }
            textarea#shout, textarea#shout2 {
                height: 200px;
            }
            #compiled {
                background-color: #ccffcc;
            }
            #shout, #shout2 {
                background-color: #ffcccc;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <form method="post" action="instrukcii.php">
                <?php if (!empty($_SESSION[$sessionName])) { ?>
                <div class="col-lg-6">
                    <h3>Header</h3>
                    <div class="form-group">
                        <textarea class="form-control" id="header" name="data[header]"><?php echo $data['header']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <h3>Инструкции за въстанията</h3>
                        <textarea class="form-control" id="top-text" name="data[rws]"><?php echo $data['rws']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <h3>Битки</h3>
                        <textarea class="form-control" id="battles"><?php
$sql = <<<END
                                SELECT 
                                    id, caption, link, date, priority, country, importance
                                FROM
                                    orders
                                ORDER BY 
                                    importance DESC,
                                    priority DESC,
                                    id ASC
END;
$q = $dblink->query($sql);
$i = 0;
if (count($q) > 0) {
    while ($row = $q->fetchArray(SQLITE3_ASSOC)) {
        if (empty($row['link'])) {
            continue;
        }
        $priority = $row['priority'];
        $img = $flags[$priority];
        $caption = $row['caption'];
        $engCaption = "For " . $row['country'] . " in " . $caption;
        echo <<<"END"
[img]http://i66.tinypic.com/30if7kk.jpg[/img][img]http://i63.tinypic.com/244s6le.jpg[/img]


[b]За {$row['country']} в/във {$caption}[/b]
[b][url={$row['link']}][img]{$img}[/img] {$engCaption}[/url][/b]


END;
    }
}
?></textarea>
                    </div>
                    <div class="form-group">
                        <h3>Екип</h3>
                        <textarea class="form-control" id="team" name="data[team]"><?php echo $data['team']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <h3>Footer</h3>
                        <textarea class="form-control" id="footer" name="data[footer]"><?php echo $data['footer']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success pull-right">Запиши</button>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <h2>За вестника</h2>
                        <textarea class="form-control" id="compiled"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="reset" value="" class="btn btn-block btn-danger">Оригинал</button><br>
                        <button type="button" id="compile" class="btn btn-block btn-success" data-clipboard-target="#compiled">Компилирай/копирай инструкции</button><br>
                        <button type="button" onclick="location.href = 'index.php'" class="form-control btn btn-info">Задаване на битки</button>
                    </div>
                </div>
                <?php } ?>
                <div class="col-lg-6">
                    <div class="form-group">
                        <h2>Shout</h2>
                        <textarea class="form-control" id="shout" readonly="">Военни инструкции:

<?php echo $win; ?>


<?php echo $lose; ?></textarea>
                    </div>
                    <div class="form-group">
                        <button type="button" id="compileShout" class="btn btn-block btn-success" data-clipboard-target="#shout">Копирай shout</button><br>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <h2>Shout 2</h2>
                        <textarea class="form-control" id="shout2" readonly="">Военни инструкции:

<?php echo $win2; ?>


<?php echo $lose2; ?></textarea>
                    </div>
                    <div class="form-group">
                        <button type="button" id="compileShout2" class="btn btn-block btn-success" data-clipboard-target="#shout2">Копирай shout</button><br>
                    </div>
                </div>
            </form>
        </div>
        <!-- page content -->
        <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>
        <script>
                        $(function () {
                            $('#compile').click(function () {
                                header = $("#header").val();
                                topText = $("#top-text").val();
                                battles = $("#battles").val();
                                team = $("#team").val();
                                footer = $("#footer").val();
                                $("#compiled").val(header + topText + battles + team + footer);
                            });
                            new ClipboardJS('#compile');
                            new ClipboardJS('#compileShout');
                            new ClipboardJS('#compileShout2');
                        });
        </script>
    </body>
</html>