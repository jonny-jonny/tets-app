<?php

/**
 * General controller.
 */
class IndexController {

  /**
   * General action.
   *
   * @return void
   */
  public function indexAction() {

    $model = new Model();
    $fc = FrontController::getInstance();
    $output = NULL;

    if (!empty($_POST)) {
      if (isset($_POST['id_form']) && $_POST['id_form'] == 'upload-file') {
        FileController::uploadFiles();
      }
    }

    $output .= $model->render('form-upload');

    $files = new FileController();
    $output .= $files->renderListFiles();

    $model->data = $output;
    $content = $model->render('base');

    $fc->setBody($content);

  }

}
