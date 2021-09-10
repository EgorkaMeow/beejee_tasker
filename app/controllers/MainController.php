<?php
    class MainController
    {   
        public static function show()
        {
            $view = new View();
            $task = new TaskModel();
            
            $sort = [
                'type' => in_array($_REQUEST['type'], ['asc', 'desc']) ? $_REQUEST['type'] : '',
                'by' => in_array($_REQUEST['by'], ['user', 'email', 'done']) ? $_REQUEST['by'] : '',
            ];
            $page = $_REQUEST['page'] ?: 1;

            $task_count = $task->count();

            $data = $task->getTasks($sort, $page);

            $sort_links = [
                'user' => [
                    'icon' => $sort['by'] == 'user'
                        ? (
                            $sort['type'] == 'asc'
                                ? '&#11014;'
                                : '&#11015;'
                        )
                        : '',
                    'url' => $sort['by'] == 'user'
                        ? (
                            $sort['type'] == 'asc'
                                ? '?type=desc&by=user&page=' . $page
                                : '?type=asc&by=user&page=' . $page
                        )
                        : '?type=asc&by=user&page=' . $page,
                ],
                'email' => [
                    'icon' => $sort['by'] == 'email'
                        ? (
                            $sort['type'] == 'asc'
                                ? '&#11014;'
                                : '&#11015;'
                        )
                        : '',
                    'url' => $sort['by'] == 'email'
                        ? (
                            $sort['type'] == 'asc'
                                ? '?type=desc&by=email&page=' . $page
                                : '?type=asc&by=email&page=' . $page
                        )
                        : '?type=asc&by=email&page=' . $page,
                ],
                'done' => [
                    'icon' => $sort['by'] == 'done'
                        ? (
                            $sort['type'] == 'asc'
                                ? '&#11014;'
                                : '&#11015;'
                        )
                        : '',
                    'url' => $sort['by'] == 'done'
                        ? (
                            $sort['type'] == 'asc'
                                ? '?type=desc&by=done&page=' . $page
                                : '?type=asc&by=done&page=' . $page
                        )
                        : '?type=asc&by=done&page=' . $page,
                ]
            ];

            $view->generate('index_page.php', [
                'is_auth' => LoginController::isAuth(),
                'tasks' => $data,
                'current_page' => $page,
                'sort' => $sort,
                'sort_links' => $sort_links,
                'count_pages' => $task_count % 3 !== 0 ? floor($task_count / 3) + 1 : $task_count / 3,
            ]);
        }
    }