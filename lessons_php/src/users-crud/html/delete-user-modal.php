<div class="modal modal-sm fade" id="delete-user-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="delete-user-modal-label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content backdrop-filter">
      <div class="modal-header justify-content-center">
        <h5 class="modal-title" id="delete-user-modal-label">Confirm User Deletion</h5>
      </div>
      <div class="modal-body text-center">
        <span>Are you sure you want to delete <strong class="text-danger text-nowrap" data-user-name></strong> from the database ❓</span>
      </div>
      <div class="modal-footer p-1">
        <form id="delete-user-form" action="delete.php" method="post" hidden>
          <input type="hidden" name="id" data-user-id>
        </form>
        <button type="button" class="btn link-body-emphasis fw-medium flex-grow-1" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-danger fw-medium flex-grow-1" type="submit" form="delete-user-form">Yes, delete</button>
      </div>
    </div>
  </div>
</div>

<script>
  const deleteUserModal = document.getElementById('delete-user-modal');

  deleteUserModal.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget;
    console.log(button);
    const userId = button.getAttribute('data-bs-user-id');
    const userName = button.getAttribute('data-bs-user-name');

    if (userId && userName) {
      deleteUserModal.querySelector('[data-user-id]').value = userId;
      deleteUserModal.querySelector('[data-user-name]').textContent = userName;
    }
  })
</script>