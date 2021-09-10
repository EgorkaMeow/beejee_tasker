<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="../../public/js/common.js"></script>
    <script src="../../public/js/update.js"></script>
    <title>Редактирование задания</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">Beejee</a>
            </div>
        </nav>
    </header>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4">
                <form id="update_form">
                    <h2>Задание № <?php echo $data->id; ?></h2>
                    <div class="mb-3">
                        <label class="form-label">Пользователь</label>
                        <input type="text" class="form-control" name="user" placeholder="Логин" value="<?php echo $data->user; ?>" disabled readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="E-mail" value="<?php echo $data->email; ?>" disabled readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Текст</label>
                        <textarea rows="3" class="form-control" name="text" placeholder="Текст"><?php echo $data->text; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <input class="form-check-input" name="done" type="checkbox" value="" id="flexCheckChecked" <?php if($data->done == 1){ ?>checked<?php } ?>>
                        <label class="form-check-label" for="flexCheckChecked">
                            Выполнено
                        </label>
                    </div>
                    <div class="mb-3 justify-content-center">
                        <input name="task_id" type="hidden" value="<?php echo $data->id; ?>" />
                        <input type="submit" class="btn btn-primary" value="СОХРАНИТЬ" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>