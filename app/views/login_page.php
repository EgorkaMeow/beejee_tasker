<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="./public/js/common.js"></script>
    <script src="./public/js/login.js"></script>
    <title>Логин</title>
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
                <form id="login_form">
                    <h2>Авторизация</h2>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Логин</label>
                        <input type="text" class="form-control" name="login" placeholder="Логин">
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Пароль</label>
                        <input type="password" class="form-control" name="password" placeholder="Пароль">
                    </div>
                    <div class="mb-3 justify-content-center">
                        <input type="submit" class="btn btn-primary" id="login" value="ВОЙТИ" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>