<?php declare(strict_types=1);
if ( ! defined('DOKU_INC')) die();

class syntax_plugin_katex_inline extends DokuWiki_Syntax_Plugin {
  public function getType() {
    return 'protected';
  }

  public function getSort() {
    return 65;
  }

  public function connectTo($mode) {
    $this->Lexer->addEntryPattern(
        '(?<!\\\\)\$\$(?=.*?\$\$)', $mode, 'plugin_katex_inline');
  }

  public function postConnect() {
    $this->Lexer->addExitPattern('(?<!\$\$)\$\$', 'plugin_katex_inline');
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
      $renderer->doc .= '<span class="dwkatex--render">' .
        htmlspecialchars($data) . '</span>';
      return true;
    }
    return false;
  }
}
