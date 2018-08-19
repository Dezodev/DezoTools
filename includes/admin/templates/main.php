
<div id="wrapper" data-plugin="dezo-tools">
    <h1 class="page-title">Dezo Tools : Réglages</h1>

    <?php settings_errors(); ?>
    <form action="options.php" method="post">
        <?php settings_fields('dezotools-settgroup'); ?>

        <?php do_settings_sections('dezotools_main'); ?>

        <?php submit_button(); ?>
    </form>
</div>
