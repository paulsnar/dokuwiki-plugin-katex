<?php declare(strict_types=1);
if ( ! defined('DOKU_INC')) die();

class syntax_plugin_katex_block extends DokuWiki_Syntax_Plugin {
  public function getType() {
    return 'protected';
  }

  public function getSort() {
    return 65;
  }

  public function connectTo($mode) {
    $this->Lexer->addEntryPattern(
        '<math>(?=.*?<\/math>)', $mode, 'plugin_katex_block');
  }

  public function postConnect() {
    $this->Lexer->addExitPattern('<\/math>', 'plugin_katex_block');
  }

  public function handle($match, $state, $pos, Doku_Handler $handler) {
    if ($state === DOKU_LEXER_UNMATCHED) {
      return $match;
    } else {
      return null;
    }
  }

  public function render($mode, Doku_Renderer $renderer, $data) {
    if ($data === null) {
      return false;
    }
    if ($mode === 'xhtml') {
      $renderer->doc .= '<div class="dwkatex--render dwkatex--block">' .
        htmlspecialchars($data) . '</div>';
      return true;
    }
    return false;
  }
}
