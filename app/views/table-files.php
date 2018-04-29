<h3 class="text-center">- List of files -</h3>
<?php if ($this->files): ?>
  <table class="table table-bordered table-hover">
    <tr>
      <th class="text-center">Name file</th>
      <th width="130" class="text-center">File size</th>
      <th width="130" class="text-center">Delete</th>
    </tr>
      <?php foreach ($this->files as $item) : ?>
        <tr>
          <td class="text-left">
            <?php  $fileName = $item->getFilename(); ?>
            <a href="<?php print '/files/' . $fileName; ?>" download>
              <?php print  $fileName; ?>
            </a>
          </td>
          <td class="text-right">
            <?php
              $size = round(($item->getSize()/1024), 1);
              print  $size . ' kb';
            ?>
          </td>
          <td class="text-center">
              <a href="<?php print '/file/delete/name/' . $fileName; ?>">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
</table>
<?php else: ?>
  <h3 class="text-center">The file store is empty.</h3>
<?php endif; ?>