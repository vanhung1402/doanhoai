<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in - Voler Admin Dashboard</title>
    <link rel="stylesheet" href="{$url}dist/templates/admin/assets/css/bootstrap.css">

    <link rel="shortcut icon" href="{$url}dist/templates/admin/assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="{$url}dist/templates/admin/assets/css/app.css">

    <link href="{$url}dist/templates/public/libs/toast-master/css/jquery.toast.css" rel="stylesheet">
    <script src="{$url}dist/custom/admin/js/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div id="auth">

        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card pt-4">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <img src="{$url}files/logo.jpg" height="48" class='mb-4'>
                                <h3>Sign In</h3>
                                <p>Please sign in to continue to Chilin.</p>
                            </div>
                            <form method="post">
                                <div class="form-group position-relative has-icon-left">
                                    <label for="username">Username</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" id="username" name="username" required autofocus>
                                        <div class="form-control-icon">
                                            <i data-feather="user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group position-relative has-icon-left">
                                    <label for="password">Password</label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control" id="password" name="password" required>
                                        <div class="form-control-icon">
                                            <i data-feather="lock"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix text-center">
                                    <button name="action" value="login" class="btn btn-primary float-end">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="{$url}dist/templates/admin/assets/js/feather-icons/feather.min.js"></script>
    <script src="{$url}dist/templates/admin/assets/js/app.js"></script>
    <script src="{$url}dist/templates/public/libs/toast-master/js/jquery.toast.js"></script>

    <script src="{$url}dist/templates/admin/assets/js/main.js"></script>
    {if !empty($message)}
    <script type="text/javascript">
        function showMessage(type, msg){
            (type === 'success') ? type = 'info' : '';
            const title_msg = {
                'success': 'Thành công',
                'warning': 'Cảnh báo',
                'info': 'Thông báo',
                'error': 'Lỗi',
            };

            $.toast({
                heading: title_msg[type],
                text: msg,
                position: 'top-right',
                loaderBg: '#ff6849',
                icon: type,
                hideAfter: 2000,
                stack: 6
            });
        }

        $(document).ready(function() {
            showMessage('{$message.type}', '{$message.msg}');
        });
    </script>
    {/if}
</body>

</html>