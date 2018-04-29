<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>File storage</title>
        <style>
            @import '/app/theme/style.css';
            @import '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css';
            @import '//fonts.googleapis.com/css?family=Roboto';
        </style>
    </head>
    <body>
        <main class="wrapper">
            <header class="header">
                <h2 class="text-center">Demonstration simple file storage</h2>
            </header>
            <div class="page-content">
                <?php print $this->data; ?>
            </div>
            <footer class="footer"></footer>
        </main>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
        <script>
            jQuery(function($) {
                $.validate({
                    modules : 'file'
                });
            });
        </script>
    </body>
</html>
