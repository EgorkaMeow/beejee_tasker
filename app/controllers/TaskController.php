<?php
    class TaskController
    {   
        public static function updateTaskShow($task_id)
        {
            if(!LoginController::isAuth()) {
                header('Location: /');
                exit;
            }

            $view = new View();
            
            $task = new TaskModel();

            $_task = $task->getTask($task_id);

            $view->generate('update_task.php', [
                'data' => $_task,
            ]);
        }

        public static function createTask()
        {
            $task = new TaskModel();

            $data = json_decode(file_get_contents('php://input'), true);

            $data = [
                'user' => htmlspecialchars($data['user']),
                'email' => htmlspecialchars($data['email']),
                'text' => htmlspecialchars($data['text']),
            ];

            echo $task->createTask($data);
        }

        public static function updateTask($task_id)
        {
            if(!LoginController::isAuth()) {
                echo "NOT AUTH";
                exit;
            }

            $task = new TaskModel();

            $req_data = json_decode(file_get_contents('php://input'), true);

            $data = [
                'id' => $task_id,
            ];

            if(isset($req_data['text'])){
                $data['text'] = htmlspecialchars($req_data['text']);
            }

            if(isset($req_data['done'])){
                $data['done'] = htmlspecialchars($req_data['done']);
            }

            echo $task->updateTask($data);
        }

        public static function deleteTask($task_id)
        {
            $task = new TaskModel();

            echo $task->deleteTask($task_id);
        }
    }