<?php
require_once('includes.php');
$pageTitle = 'Page Builder | Generated Code';
require_once('./../page-head.php');
?>
<style>
  .highlight-html {
    color: var(--bs-secondary-text-emphasis);
  }

  .highlight-default {
    color: var(--bs-info-text-emphasis);
  }

  .highlight-keyword {
    color: var(--bs-primary-text-emphasis);
    font-weight: bold;
  }

  .highlight-string {
    color: var(--bs-success-text-emphasis);
  }

  .highlight-comment {
    color: var(--bs-secondary-text-emphasis);
  }
</style>
<?php
// source: https://www.php.net/manual/en/misc.configuration.php
// Create an array with default php functions
$functions = array("default", "html", "keyword", "string", "comment");
// Replace color code (ex: #FF8000) with class name (ex:"highlight-comment")
foreach ($functions as $value) {
  ini_set("highlight.$value", "highlight-$value;");
}
// Read generated code and highlight
$code = highlight_string('<!-- <?php Generated code (remove this line) -->' . PHP_EOL . file_get_contents('generated-code.html'), true);
// Convert style="color: highlight-function" into class="highlight-function" into $content
// It allows you to modify only the default functions
foreach ($functions as $value) {
  $code = preg_replace("/style=\"color: highlight-$value;\"/", "class=\"highlight-$value\"", $code);
}
?>

<body class="d-flex flex-column vh-100 mesh-gradient overflow-y-auto overflow-x-hidden p-3 p-lg-5">
  <?php
  echo (new NodeBlock)
    ->setClass('card', 'w-100', 'h-100')
    ->addChild((new NodeBlock)
      ->setClass('card-header', 'h1', 'text-center')
      ->addChild('Generated Page Code'))
    ->addChild((new NodeBlock)
      ->setClass('card-body', 'overflow-auto')
      ->setId('generated-code')
      ->addChild($code))
    ->addChild((new NodeBlock)
      ->setClass('card-footer', 'text-center')
      ->addChild((new NodeInline('button'))
        ->setClass('btn', 'btn-success', 'bg-gradient', 'px-4', 'fw-medium')
        ->addChild('📋 Copy to Clipboard')))
    ->setAttribute('onclick', 'copyToClipboard()')
    ->render();
  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script>
    function copyToClipboard() {
      const code = document.getElementById('generated-code');
      const range = document.createRange();
      range.selectNode(code);
      window.getSelection().removeAllRanges();
      window.getSelection().addRange(range);
      document.execCommand('copy');
      window.getSelection().removeAllRanges();

      const button = document.querySelector('.btn');
      button.textContent = '✔ Copied!';

      setTimeout(() => {
        button.textContent = '📋 Copy to Clipboard';
      }, 2500);
    }
  </script>
</body>

</html>