<main class="form-signin">
    <h1>Find Resorts, Hotels, and Attractionss</h1>
    <form method="post" action="<?php echo base_url('search/query'); ?>">
        <input type="text" name="location" placeholder="Enter location (e.g., Paris)" required>
        <button type="submit">Search</button>
    </form>

    <?php if (isset($results)): ?>
        <h2>Results for <?php echo htmlspecialchars($this->input->post('location')); ?>:</h2>
        <p><?php echo $results; ?></p>
    <?php endif; ?>
</main>