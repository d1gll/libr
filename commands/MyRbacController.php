<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

class MyRbacController extends Controller {

    public function actionInit() {
        $auth = Yii::$app->authManager;

        $auth->removeAll(); //На всякий случай удаляем старые данные из БД...

        // Создадим роли админа и редактора новостей
        $admin = $auth->createRole('admin');
        $editor = $auth->createRole('editor');

        // запишем их в БД
        $auth->add($admin);
        $auth->add($editor);

        // Создаем наше правило, которое позволит проверить автора новости
        $authorRule = new \app\rbac\AuthorRule;

        // Запишем его в БД
        $auth->add($authorRule);

        // Создаем разрешения. Например, просмотр админки viewAdminPage и редактирование новости updateNews
        $viewAdminPage = $auth->createPermission('viewAdminPage');
        $viewAdminPage->description = 'Просмотр админки';

        $updateNews = $auth->createPermission('updateNews');
        $updateNews->description = 'Редактирование новости';

        // Создадим еще новое разрешение «Редактирование собственной новости» и ассоциируем его с правилом AuthorRule
        $updateOwnNews = $auth->createPermission('updateOwnNews');
        $updateOwnNews->description = 'Редактирование собственной новости';

        // Указываем правило AuthorRule для разрешения updateOwnNews.
        $updateOwnNews->ruleName = $authorRule->name;

        // Запишем все разрешения в БД
        $auth->add($viewAdminPage);
        $auth->add($updateNews);
        $auth->add($updateOwnNews);

        // Теперь добавим наследования. Для роли editor мы добавим разрешение updateOwnNews (редактировать собственную новость),
        // а для админа добавим собственные разрешения viewAdminPage и updateNews (может смотреть админку и редактировать любую новость)

        // Роли «Редактор новостей» присваиваем разрешение «Редактирование собственной новости»
        $auth->addChild($editor,$updateOwnNews);

        // админ имеет собственное разрешение - «Редактирование новости»
        $auth->addChild($editor, $updateNews);

        // Еще админ имеет собственное разрешение - «Просмотр админки»
        $auth->addChild($admin, $viewAdminPage);

        // Назначаем роль admin пользователю с ID 1
        $auth->assign($admin, 1);

        // Назначаем роль editor пользователю с ID 2
        $auth->assign($editor, 2);
    }
}