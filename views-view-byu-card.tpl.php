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

<div class="card-container columns-<?php print $cols[$id]; ?>" >
    <?php foreach ($rows as $id => $row): ?>
        <byu-card columns="<?php print $cols[$id]; ?>" class="<?php print $card_width[$id]; ?>"><?php print $row; ?></byu-card>
    <?php endforeach; ?>

</div>

