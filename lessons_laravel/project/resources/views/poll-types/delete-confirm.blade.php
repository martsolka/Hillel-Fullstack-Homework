<div class="modal fade text-wrap" id="delete-poll-type-{{ $pollType->id }}" tabindex="-1">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
       <h5 class="modal-title">Confirm Deletion</h5>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this poll type <strong class="text-danger">"{{ $pollType->name }}"</strong> from the database ❓</p>
        <small class="text-muted">⚠️ This action cannot be undone.</small>
      </div>
      <div class="modal-footer">
        <form action="{{ route('poll-types.destroy', $pollType) }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="button" class="btn link-body-emphasis fw-medium flex-grow-1" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger fw-medium flex-grow-1">Yes, Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
