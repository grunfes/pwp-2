<?php

/**
 * @file
 * Display Suite 1 column template.
 */

$pool_id = NULL;
if ($node = menu_get_object()) {
  // Get the nid
  $pool_id = $node->nid;
}

$pool_node = node_load($pool_id);
$pool_locked = boolval($pool_node->field_closed['und'][0]['value']);
$redirect_url = drupal_get_path_alias(current_path());
$is_member = og_is_member('node', $pool_id);

$show_id = $nid;
?>
  <<?php print $ds_content_wrapper;
print $layout_attributes; ?> class="ds-1col <?php print $classes; ?> clearfix">

<?php if (isset($title_suffix['contextual_links'])): ?>
  <?php print render($title_suffix['contextual_links']); ?>
<?php endif; ?>

  <form action="<?php echo "/my_picks/{$pool_id}"; ?>" method="POST"
        class="clearfix">
    <?php print $ds_content; ?>
    <input type="hidden" name="redirectUrl"
           value="<?php echo $redirect_url; ?>"/>
    <?php if ($is_member && (is_user_administrator() || $_SESSION['show_expired'] !== TRUE)): ?>
      <input type="hidden" name="show_id" value="<?php echo $show_id; ?>" />
      <input type="submit" value="<?php echo t('Save Picks'); ?>"/>
    <?php endif; ?>
    <?php unset($_SESSION['show_expired']); ?>
  </form>

  </<?php print $ds_content_wrapper ?>>

<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children ?>
<?php endif; ?>