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

    <div class="container">
        <div class="row justify-content-md-center mb-4">
            <div class="col col-md-6">
    
                <div class="btn-group" role="group">
                    <a href="<?php echo "/?page=$page&sort=$sort&order=name" ?>" class="btn <?php echo $order == 'name' ? 'btn-primary' : 'btn-outline-primary' ?>">Name</a>
                    <a href="<?php echo "/?page=$page&sort=$sort&order=email" ?>" class="btn <?php echo $order == 'email' ? 'btn-primary' : 'btn-outline-primary' ?>">Email</a>
                    <a href="<?php echo "/?page=$page&sort=$sort&order=text" ?>" class="btn <?php echo $order == 'text' ? 'btn-primary' : 'btn-outline-primary' ?>">Text</a>
                </div>

                <div class="btn-group" role="group">
                    <a href="<?php echo "/?page=$page&sort=ASC&order=$order" ?>" class="btn <?php echo $sort == 'ASC' ? 'btn-primary' : 'btn-outline-primary' ?>">ASC</a>
                    <a href="<?php echo "/?page=$page&sort=DESC&order=$order" ?>" class="btn <?php echo $sort == 'DESC' ? 'btn-primary' : 'btn-outline-primary' ?>">DESC</a>
                </div>

            </div>
        </div>


        <div class="row justify-content-md-center">
            <div class="col col-md-6">
                
                <?php foreach ($tasks as $task): ?>
                    <div class="card mb-2">
                        <div class="card-body">
                            <span class="badge bg-secondary float-end">ID: <?php echo $task['id']; ?></span>
                            <?php if ($task['status']): ?>
                                <span class="badge bg-success float-end me-2">Выполнено</span>
                            <?php endif; ?>
                            <h5 class="card-title"><?php echo $task['name']; ?></h5>
                            <h5><small class="text-muted"><?php echo $task['email']; ?></small></h5>
                            <p class="card-text"><?php echo $task['text']; ?></p>
                            <?php if ($task['updated_at']): ?>
                                <p class="card-text"><small class="text-muted">Обновлено администратором</small></p>
                            <?php endif; ?>
                        </div>
                        <?php if (!\App\Models\User::isGuest()): ?>
                            <div class="card-footer text-end">
                                <?php if (!$task['status']): ?>
                                    <a href="/task/<?php echo $task['id']; ?>/success" class="btn btn-success">Выполнено</a>
                                <?php endif; ?>
                                <a href="/task/<?php echo $task['id']; ?>/edit" class="btn btn-secondary">Редактировать</a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>

                <?php if ($pagination > 1): ?>
                    <nav>
                        <ul class="pagination justify-content-center">
                            <?php for ($i=1; $i <= $pagination; $i++): ?>
                                <li class="page-item <?php echo $i == $page ? 'active' : '' ?>">
                                    <a class="page-link" href="<?php echo "/?page=$i&sort=$sort&order=$order" ?>">
                                        <?php echo $i ?>
                                    </a>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </nav>
                <?php endif; ?>

            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>