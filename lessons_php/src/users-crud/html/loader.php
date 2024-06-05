  <div class="position-fixed h-100 w-100 bg-black bg-opacity-50 hstack justify-content-center gap-2 z-3 text-muted" id="loader">
    <div class="spinner-border" aria-hidden="true"></div>
    <strong role="status">Loading...</strong>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => document.getElementById('loader').classList.add('d-none'));
  </script>