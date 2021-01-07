<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Basic Project Template</h1>
    <br>
</p>

Для работы приложения необходимо:

    1.Установить и обновить composer: 
        composer self-update
        composer install
        composer update
        
    2.Настроить файл db.php (подключение к БД)
    
    3.Создать таблицы прописав:
        yii migrate
        
    4.Создать таблицы для RBAC:
        php yii migrate --migrationPath=@yii/rbac/migrations
        
    5. Добавить данные в таблицу RBAC: 
        yii my-rbac/init
        
    6. В файле config/params.php изменить adminEmail и supportEmail на свой.
