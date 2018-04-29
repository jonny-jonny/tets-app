<?php

/**
 * Controller for working with files.
 */
class FileController {

  /**
   * The array objects of files.
   *
   * @var mixed
   */
  public $files;

  /**
   * Delete file.
   */
  public function deleteAction() {

    $fc = FrontController::getInstance();
    $params = $fc->getParams();
    $file_path = CONTENT_FOLDER . $params['name'];

    if (file_exists($file_path)) {
      chmod($file_path, 0755);
      unlink($file_path);
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
  }

  /**
   * Create array with object of files.
   *
   * @return mixed
   */
  public function __construct() {

    $iterator = new \FilesystemIterator(CONTENT_FOLDER);

    if ($iterator->valid()) {
      foreach ($iterator as $file_obj) {
        if ($file_obj->isFile()) {
          $this->files[] = $file_obj;
        }
      }
    }
    else {
      $this->files = NULL;
    }

  }

  /**
   * Save files uploaded files.
   *
   * @return void
   */
  public static function uploadFiles() {

    $final_name = CONTENT_FOLDER . $_FILES['file']['name'];

    if (file_exists($final_name)) {
      self::renameFinalName($final_name);
    }
    move_uploaded_file($_FILES['file']['tmp_name'], $final_name);
    header('Location: ' . $_SERVER['REQUEST_URI']);
  }

  /**
   * Rename the downloaded file if it already exists.
   *
   * @param string $file_name
   *
   * @return string
   */
  private static function renameFinalName(&$file_name) {

    $file = basename($file_name);
    $file_name = CONTENT_FOLDER . 'duplicate_' . $file;

    if (file_exists($file_name)) {
      self::renameFinalName($file_name);
    }
  }

  /**
   * Render rable with files.
   *
   * @return string
   */
  public function renderListFiles() {
    $model = new Model();
    $model->files = $this->files;
    return $model->render('table-files');
  }

}
