<?php
/**
 * @file
 * Default simple view template to display a rows in a BYU card.
 *
 * - $rows contains a nested array of rows. Each row contains an array of
 *   columns.
 * - $columns contains a nested array of columns. Each column contains an
 *   array of columns.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)) : ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>

<div class="card-container" >
    <?php foreach ($rows as $id => $row): ?>
        <byu-card style="width: 30%" class="<?php print $classes; ?>"><?php print $row; ?></byu-card>
    <?php endforeach; ?>

</div>

