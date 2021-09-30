<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>BeeJee Test Tasks</title>
</head>
<body>

    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a href="/" class="navbar-brand">BeeJee Test Tasks</a>
            <div class="d-flex">
                <a href="/task/create" class="btn btn-success me-2">Добавить</a>
                <?php if (\App\Models\User::isGuest()): ?>
                    <a href="/login" class="btn btn-primary">Вход</a>
                <?php else: ?>
                    <a href="/logout" class="btn btn-primary">Выход</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="controller">
        <div class="row justify-content-md-center">
            <div class="col col-md-6">

                <?php if (isset($errors) && is_array($errors)): ?>
                    <?php foreach ($errors as $error): ?>
                        <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
                    <?php endforeach; ?>
                <?php endif; ?>

                
                <form class="card" action="/login" method="post">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="admin">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="123">
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" name="submit" class="btn btn-primary" value="Login">
                    </div>
                </form>


            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>