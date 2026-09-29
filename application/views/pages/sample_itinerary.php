<h2>Itinerary for <?= ucfirst($location) ?></h2>

<?php if ($itinerary): ?>
    <?php foreach ($itinerary as $day => $segments): ?>
        <h3><?= $day ?></h3>

        <?php foreach ($segments as $time_period => $activities): ?>
            <h4><?= ucfirst($time_period) ?></h4>
            <ul>
                <?php foreach ($activities as $activity): ?>
                    <li>
                        <strong><?= $activity['time'] ?> - <?= $activity['title'] ?></strong><br>
                        <em><?= $activity['location'] ?></em><br>
                        <?= $activity['description'] ?><br>
                        <small><strong>Tips:</strong> <?= $activity['tips'] ?? 'None' ?></small>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endforeach; ?>

    <?php endforeach; ?>
<?php else: ?>
    <p>No itinerary found for this location.</p>
<?php endif; ?>
