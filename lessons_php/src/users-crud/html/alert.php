<?php if (isset($_SESSION['alert'])) : ?>
  <div class="alert alert-<?= $_SESSION['alert']['type'] ?? 'info' ?> alert-dismissible fade show d-inline-block" role="alert">
    <?= $_SESSION['alert']['content'] ?? '' ?>
    <button type="button" class="btn-close btn-sm float-end ms-3" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>
<?php unset($_SESSION['alert']); ?>