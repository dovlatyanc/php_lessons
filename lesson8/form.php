<?php

function showForm(array $task, bool $isNew): void {
    ?>
    <form action="<?= $isNew ? 'insert.php' : 'update.php' ?>" method="post">
        <?php if (!$isNew): ?>
            <input type="hidden" name="id" value="<?= htmlspecialchars($task['id']) ?>" />
        <?php endif; ?>

        <div>
            <label for="name">Название:</label>
            <input type="text" 
                   id="name" 
                   name="name" 
                   value="<?= htmlspecialchars($task['name'] ?? '') ?>" 
                   required />
        </div>

        <div>
            <label for="due">Срок выполнения:</label>
            <input type="date" 
                   id="due" 
                   name="due" 
                   value="<?= htmlspecialchars($task['due'] ?? '') ?>" />
        </div>

        <div>
            <label for="priority">Приоритет (1–5):</label>
            <input type="number" 
                   id="priority" 
                   name="priority" 
                   min="1" 
                   max="5" 
                   value="<?= htmlspecialchars($task['priority'] ?? '') ?>" 
                   required />
        </div>

        <div>
            <label for="description">Описание:</label>
                <div>
                    <textarea id="description" 
                        name="description" 
                        rows="4" 
                        cols="50"><?= htmlspecialchars($task['description'] ?? '') ?></textarea>
                </div>
        </div>

        <div>
            <input type="submit" value="<?= $isNew ? 'Создать' : 'Сохранить' ?>" />
        </div>
    </form>
    <?php
}