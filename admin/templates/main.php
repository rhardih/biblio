<div class="wrap">
<div id="icon-plugins" class="icon32"></div>
<h2>Biblio Settings</h2>

<p>
This is the content of the main settings page of biblio.
</p>

<?php
settings_errors();
?>

<form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<?php
settings_fields( 'plugin_options' );
do_settings_sections('plugin');
?>
  <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</form
</div>
