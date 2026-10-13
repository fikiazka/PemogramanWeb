</main>

    <footer>
        <p>
            &copy; 2026 SIMPUS-Mini &mdash; Jobsheet 12
        </p>
    </footer>

    <script src="<?= e($base ?? '') ?>assets/js/app.js"></script>
    <?php if (!empty($extra_scripts)): ?>
        <?php foreach ($extra_scripts as $src): ?>
            <script src="<?= e($src) ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
    </body>

    </html>