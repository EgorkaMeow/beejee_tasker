<?php
    class TaskModel
    {
        public function __construct(){
            R::setup( 'mysql:host=mysql.zzz.com.ua;dbname=testnewtasker','testtasker', 'Test321/.,');
        }

        public function getTask($task_id)
        {   
            return R::findOne('tasks', ' id = :id', [
                ':id' => $task_id,
            ]);
        }

        public function getTasks($sort, $page)
        {   
            $order = "";

            if(!empty($sort['by'])){
                $order = ' ORDER BY ' . $sort['by'] . ' ' . $sort['type'];
            }

            return R::findAll('tasks', $order . ' LIMIT 3 OFFSET ' . (($page - 1) * 3));
        }

        public function createTask($data)
        {
            $task = R::dispense('tasks');
            $task->user = $data['user'];
            $task->email = $data['email'];
            $task->text = $data['text'];
            $task->done = 0;
            $task->is_edited = 0;

            return R::store($task);
        }

        public function deleteTask($id)
        {
            $task = R::findOne('tasks', ' id = ? ', [$id]);
            R::trash($task);

            echo "OK";
        }

        public function updateTask($data)
        {
            $task = R::findOne('tasks', ' id = ? ', [$data['id']]);

            if(isset($data['text'])){
                if($task->text != $data['text']){
                    $task->is_edited = 1;
                }
                $task->text = $data['text'];
            }

            if(isset($data['done'])){
                $task->done = $data['done'];
            }

            R::store($task);

            echo "OK";
        }

        public function count()
        {
            return R::count('tasks');
        }
    }