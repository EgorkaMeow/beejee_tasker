<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/css/index.css">
    <link rel="stylesheet" href="./public/css/create_task.css">
    <script src="./public/js/common.js"></script>
    <script src="./public/js/create_task.js"></script>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">Beejee</a>
                <div>
                    <button type="button" class="btn btn-success" id="header__auth-link-create">Создать</button>
                    
                    <?php
                        if(!$is_auth){
                    ?>
                    <button type="button" class="btn btn-primary" id="header__auth-link-auth">Авторизация</button>
                    <?php
                        }
                        else {
                    ?>
                    <button type="button" class="btn btn-danger" id="header__auth-link-logout">Выйти</button>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-10 table__container">
                    <table class="table <?php if($is_auth){ ?>table-hover table-cursor<?php } ?>">
                        <thead class="thead-dark">
                            <tr>
                                <th><a href="<?php echo $sort_links['user']['url']; ?>">Пользователь <?php echo $sort_links['user']['icon']; ?></a></th>
                                <th><a href="<?php echo $sort_links['email']['url']; ?>">Email <?php echo $sort_links['email']['icon']; ?></a></th>
                                <th>Текст</th>
                                <th><a href="<?php echo $sort_links['done']['url']; ?>">Выполнено <?php echo $sort_links['done']['icon']; ?></a></th>
                                <th>Редактировано</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            foreach($tasks as $item){
                        ?>
                            <tr <?php if($is_auth){ ?> onclick="location.href='./task/update/<?php echo $item->id; ?>'" <?php } ?>>
                                <td><? echo $item->user; ?></td>
                                <td><? echo $item->email; ?></td>
                                <td><? echo $item->text; ?></td>
                                <td><? if($item->done == 1){ ?>&#10004;<?php } else { ?> &#10008; <?php } ?></td>
                                <td><? if($item->is_edited == 1){ ?>&#10004;<?php } else { ?> &#10008; <?php } ?></td>
                            </tr>
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        
        <?php
            if($count_pages > 1){
        ?>    
            <div class="row justify-content-center">
                <div class="col-sm-10">
                    <ul class="pagination justify-content-center">
                        <?php
                            $prev_dots = !($current_page - 1 > 2);
                            $post_dots = !($count_pages - $current_page > 2);

                            for($i = 1; $i <= $count_pages; $i++){
                                if($current_page == $i){
                        ?>  
                            <li class="page-item active"><a class="page-link" href="#"><?php echo $i; ?></a></li>
                        <?php
                                }
                                else if(
                                    $i == 1 || 
                                    $i == $current_page - 1 || 
                                    $i == $current_page + 1 ||
                                    $i == $count_pages
                                ) {
                        ?>
                        
                            <li class="page-item"><a class="page-link" href="?type=<?php echo $sort['type']; ?>&by=<?php echo $sort['by']; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php
                                }
                                else { 
                                    if($i < $current_page && !$prev_dots){
                                        $prev_dots = true;
                                        echo "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"#\">...</a></li>";
                                    } 
                                    if($i > $current_page && !$post_dots){
                                        $post_dots = true;
                                        echo "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"#\">...</a></li>";
                                    }
                                }
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php } ?>
    </main>
    <div class="create_task__container" id="create_task__container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-4">
                    <div class="create_task__form">
                        <div class="create_task-close">&#10006;</div>
                        <form id="create_form">
                            <h2>Создать задачу</h2>
                            <div class="mb-3">
                                <label class="form-label">Пользователь</label>
                                <input type="text" class="form-control" name="user" placeholder="Пользователь" value="">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="E-mail" value="">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Текст</label>
                                <textarea rows="3" class="form-control" name="text" placeholder="Текст"></textarea>
                            </div>
                            <div class="mb-3 justify-content-center">
                                <input type="submit" class="btn btn-primary" value="Создать" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>