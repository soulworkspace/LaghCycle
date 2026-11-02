<?php
/**
 * Fix Laravel Storage Symbolic Link
 * Place this file inside: /home/deqqzhrg/laghouatcycle.ilyasmaidi.com/public/fixlinkstorage.php
 * Access via browser: https://laghouatcycle.ilyasmaidi.com/fixlinkstorage.php
 */

// Define target (storage directory) and shortcut (public/storage link)
$target = __DIR__ . '/../storage/app/public';
$shortcut = __DIR__ . '/storage';

echo '<h3>Laravel Storage Link Diagnostic & Fix</h3>';

// Check if target directory exists
if (!is_dir($target)) {
    die("<p style='color:red;'>Error: Target path missing at: {$target}</p>");
}

// Remove old or broken link/folder if it exists
if (file_exists($shortcut) || is_link($shortcut)) {
    if (is_link($shortcut)) {
        unlink($shortcut);
        echo "<p>Existing symbolic link removed.</p>";
    } elseif (is_dir($shortcut)) {
        rmdir($shortcut);
        echo "<p>Existing storage folder removed.</p>";
    }
}

// Create new symlink
if (symlink($target, $shortcut)) {
    echo "<p style='color:green;'><b>Success!</b> Symbolic link created successfully.</p>";
    echo "<p>Linked <b>{$shortcut}</b> &rarr; <b>{$target}</b></p>";
} else {
    echo "<p style='color:red;'><b>Failed:</b> Unable to create symbolic link. The <code>symlink()</code> function might be disabled by your hosting provider.</p>";
}