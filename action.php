<?php declare(strict_types=1);
if ( ! defined('DOKU_INC')) die();

class action_plugin_katex extends DokuWiki_Action_Plugin {
  public function register(Doku_Event_Handler $ctrl) {
    $ctrl->register_hook(
      'TPL_METAHEADER_OUTPUT', 'BEFORE', $this, 'handle_meta_event');
  }

  public function handle_meta_event(Doku_Event $event, $param) {
    $event->data['link'][] = [
      'rel' => 'stylesheet',
      'href' => 'https://cdn.jsdelivr.net/npm/katex@0.11.1/dist/katex.min.css',
      'integrity' => 'sha384-zB1R0rpPzHqg7Kpt0Aljp8JPLqbXI3bhnPWROx27a9N0Ll6ZP/+DiW/UqRcLbRjq',
      'crossorigin' => 'anonymous',
    ];
    $event->data['script'][] = [
      'defer' => 'defer',
      'src' => 'https://cdn.jsdelivr.net/npm/katex@0.11.1/dist/katex.min.js',
      'integrity' => 'sha384-y23I5Q6l+B6vatafAwxRu/0oK/79VlbSz7Q9aiSZUvyWYIYsd+qj+o24G5ZU2zJz',
      'crossorigin' => 'anonymous',
      'id' => 'dwkatex--js',
    ];
  }
}
