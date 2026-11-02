<?php
/**
 * Script to fix Laravel storage link and remove old public/storage folder/link
 * Path: /home/afrrxwxq/public_html/public/fixstorage.php
 */

$publicStoragePath = __DIR__ . '/storage';
$targetStoragePath = __DIR__ . '/../storage/app/public';

$output = "<h2>Laravel Storage Link Fixer</h2>";

// 1. Check and remove existing public/storage link or directory
if (file_exists($publicStoragePath) || is_link($publicStoragePath)) {
    if (is_link($publicStoragePath)) {
        if (unlink($publicStoragePath)) {
            $output .= "<p style='color:green;'>✓ Old storage symbolic link successfully removed.</p>";
        } else {
            $output .= "<p style='color:red;'>✗ Failed to remove old storage symbolic link.</p>";
        }
    } else {
        // If it's accidentally a physical directory, recursive delete it
        function deleteDirectory($dir) {
            if (!file_exists($dir)) return true;
            if (!is_dir($dir) || is_link($dir)) return unlink($dir);
            foreach (scandir($dir) as $item) {
                if ($item == '.' || $item == '..') continue;
                if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) return false;
            }
            return rmdir($dir);
        }
        
        if (deleteDirectory($publicStoragePath)) {
            $output .= "<p style='color:green;'>✓ Old physical storage directory successfully deleted.</p>";
        } else {
            $output .= "<p style='color:red;'>✗ Failed to delete physical storage directory.</p>";
        }
    }
} else {
    $output .= "<p style='color:blue;'>i No existing public/storage found, creating a new one...</p>";
}

// 2. Create the new symbolic link
if (file_exists($targetStoragePath)) {
    if (symlink($targetStoragePath, $publicStoragePath)) {
        $output .= "<p style='color:green; font-weight:bold;'>✓ SUCCESS: New storage symbolic link created successfully!</p>";
        $output .= "<p>Target path: <code>{$targetStoragePath}</code></p>";
    } else {
        $output .= "<p style='color:red; font-weight:bold;'>✗ ERROR: Failed to create symbolic link. Check your server permissions or disable_functions in PHP.</p>";
    }
} else {
    $output .= "<p style='color:red; font-weight:bold;'>✗ ERROR: Target storage folder does not exist at: <code>{$targetStoragePath}</code></p>";
}

$output .= "<hr><p><strong>Important:</strong> Please delete this file (<code>fixstorage.php</code>) from your public directory after running it for security reasons.</p>";

echo $output;