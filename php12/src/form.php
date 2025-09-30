<?php
require_once 'config.php';
require_once 'Task.php';

function showForm(Task $task, bool $isNew): void {
    $csrfToken = generateCsrfToken();
    ?>
    <form action="<?= $isNew ? 'insert.php' : 'update.php' ?>" method="post">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken) ?>" />
        <?php if (!$isNew): ?>
            <input type="hidden" name="id" value="<?= htmlspecialchars($task->id ?? '') ?>" />
        <?php endif; ?>

        <div>
            <label for="name">Название:</label>
            <input type="text" 
                   id="name" 
                   name="name" 
                   value="<?= htmlspecialchars($task->name ?? '') ?>" 
                   required />
        </div>

        <div>
            <label for="due">Срок выполнения:</label>
            <input type="date" 
                   id="due" 
                   name="due" 
                   value="<?= htmlspecialchars($task->due ?? '') ?>" />
        </div>

        <div>
            <label for="urgencyId">Срочность:</label>
            <select id="urgencyId" name="urgencyId" required>
                <?php

                $pdo = getPDO();
                $stmt = $pdo->query("SELECT id, name FROM urgency ORDER BY id ASC");
                $urgencies = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($urgencies as $urgency):
                ?>
                    <option value="<?= $urgency['id'] ?>" 
                        <?= (isset($task->urgencyId) && $task->urgencyId == $urgency['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($urgency['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="description">Описание:</label>
                <div>
                    <textarea id="description" 
                        name="description" 
                        rows="4" 
                        cols="50"><?= htmlspecialchars($task->description ?? '') ?></textarea>
                </div>
        </div>

        <div>
            <input type="submit" value="<?= $isNew ? 'Создать' : 'Сохранить' ?>" />
        </div>
    </form>
    <?php
}