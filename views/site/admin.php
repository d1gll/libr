
<div class="jumbotron">
    <h1>Личноe</h1>

    <?php if ($model->age < 18): ?>
        <div class="alert alert-info blockquote" role="alert">
            <p class="mb-0">
                Акция для тех, кто моложе 18 лет!
            </p>
        </div>
    <?php elseif ($model->age >50) : ?>
        <div class="alert alert-info blockquote" role="alert">
            <p class="mb-0">
                Акция для тех, кто старше 50 лет!
            </p>
        </div>
    <?php endif; ?>
</div>

<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">Логин</th>
        <th scope="col">Email</th>
        <th scope="col">Возраст (лет)</th>
        <th scope="col">Номер карты</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?= $model->username; ?></td>
        <td><?= $model->email; ?></td>
        <td><?= $model->age; ?></td>
        <td><?= $model->card; ?></td>
    </tr>
    </tbody>
</table>

