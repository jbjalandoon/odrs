<?php if(!empty($notes)): ?>
    <ul>
        <?php foreach($notes as $note): ?>
            <li><?=esc($note['note'])?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <b>No Notes</b>
<?php endif; ?>