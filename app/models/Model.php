<?php

/**
 * General model.
 */
class Model {

  /**
   * Render.
   *
   * @param $template string
   *
   * @return string
   */
  public function render($template) {
    $template .= '.php';
    ob_start();
    include $template;
    return ob_get_clean();
  }

}
