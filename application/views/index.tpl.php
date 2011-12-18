<!DOCTYPE html>
<html lang="zh-TW">
    <head>
        <meta charset="utf-8" />
    <head>
        <link href="css/screen.css" media="screen, projection" rel="stylesheet" type="text/css" />
        <link href="css/print.css" media="print" rel="stylesheet" type="text/css" />
        <!--[if IE]>
            <link href="css/ie.css" media="screen, projection" rel="stylesheet" type="text/css" />
        <![endif]-->
    </head>
    <title>Advanced PHP Testing Demo: Todo</title>
</head>

<body>
    <div id="todoapp">
        <div class="title">
            <h1>Todos</h1>
        </div>
        <div class="content">
            <div id="create-todo">
                <form id="add-todo" method="post" action="./?act=add">
                    <input id="new-todo" name="task" placeholder="What needs to be done?" type="text" />
                </form>
            </div>
            <div id="todos">
                <?php if (count($this->todos)): ?>
                    <form id="update-todo" method="post" action="./?act=done">
                        <ul id="todo-list">
                            <?php foreach ($this->todos as $id => $todo): ?>
                                <div class="todo<?php if ('y' === $todo['done']): ?> done<?php endif; ?>">
                                    <div class="display">
                                        <input class="check" value="<?php echo $todo['id']; ?>" type="checkbox"<?php if ('y' === $todo['done']): ?> checked="checked"<?php endif; ?> />
                                        <div class="todo-text"><?php echo $todo['task']; ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </ul>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div id="instructions">
        <p>WebDev Party 2011</p>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <script src="js/todo.js"></script>
</body>
</html>
