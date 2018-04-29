<form enctype="multipart/form-data" method="post">
  <p>Select file. The file must be less than 2 MB.</p>
  <input type="hidden" name="id_form" value="upload-file"/>
  <input type="hidden" name="MAX_FILE_SIZE" value="2097152"/>
  <div class="form-group required">
    <input required id="uploadInput" type="file" placeholder="File" name="file"
           class="form-control"
           data-validation="size"
           data-validation-max-size="2000kb"
           data-validation-error-msg-size="The file cant be larger than 2MB"
    />
  </div>
  <button type="submit" class="btn btn-default">Load</button>
</form>
