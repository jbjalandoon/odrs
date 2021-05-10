<?php if(!empty($requirements)): ?>
    <ul>
        <?php foreach($requirements as $requirement): ?>
            <li><?=esc($requirement['office'])?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <b>No Office Requirements</b>
<?php endif; ?>