<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= bloginfo('name') ?> - <?= __('Site in maintenance', 'dezo-tools') ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">

    <!-- CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    <style>
        body        { background: #34495E; color: #EEE; text-align: left; font-size: 18px; }
        .header     { background: #FFF; color: #333; text-align: center; padding: 20px 0;}
        .content    { padding: 20px 0; }
        .container  { position: relative; }

        .header h1  { margin-top: 0; margin-bottom: 0; }
        #icon-state { position: absolute; top: -15px; left: -15px;font-size: 4.5em; opacity: 0.25; transform: rotate(25deg); }

        a { color: #F1892D; text-decoration: none; }
        a:hover { color: #D87400; text-decoration: none; }
    </style>

</head>
<body>
    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1><?= bloginfo('name').' '.__('is back soon !', 'dezo-tools') ?></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content convert-emoji">
        <div class="container">
            <i id="icon-state" class="fa fa-wrench"></i>
            <div class="row">
                <div class="col-xs-12">
                    <p><?= __('Your site is at present off-line. We are realizing a maintenance. Thank you for your understanding.', 'dezo-tools') ?></p>

                    <?php
                        if(!empty($reason)){
                            echo '<p>'.__('Reason:', 'dezo-tools').' '.$reason.'</p>';
                        }
                    ?>

                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
