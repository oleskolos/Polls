<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/fonts/css/fontawesome.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="icon" type="image/x-icon" sizes="196x196" href="/images/favicon.ico">

    <title><?php echo $pageData['title']; ?></title>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-container">
                    <form method="POST">
                        <?php 
                            if(!empty($pageData['errorLog'])) : ?>
                            <div class="alert alert-danger"><?php echo $pageData['errorLog']; ?></div>
                        <?php endif; ?>
                    <div class="mb-3 text-center">
                        <h2>Sign in</h2>
                    </div>
                        <input type="hidden" name="action" value="login" class="form-control" required>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Login</label>
                        <input type="text" name="login" class="form-control" id="login" aria-describedby="emailHelp" placeholder="Login" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="Password" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Sign in</button>
                    </div>
                </form>
            </div>
        </div>
            <div class="col-lg-6">
                <div class="form-container">
                    <form method="POST">
                        <?php 
                            if(!empty($pageData['errorReg'])) : ?>
                            <div class="alert alert-danger"><?php echo $pageData['errorReg']; ?></div>
                        <?php endif; ?>
                    <div class="mb-3 text-center">
                        <h2>Register</h2>
                    </div>
                    <input type="hidden" name="action" value="register" class="form-control" required>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Login</label>
                        <input type="text" name="login" class="form-control" id="loginReg" aria-describedby="emailHelp" placeholder="Login" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="email" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" id="passwordReg" placeholder="Password" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

    

    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/angular.min.js"></script>
    <script src="/js/script.js"></script>
</body>
</html>