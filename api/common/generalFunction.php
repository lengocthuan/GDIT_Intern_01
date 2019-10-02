<?php
    public static function replaceContentForPartent ($partern, $replacement, $subject, $file) {
        $subject = file_get_contents($file);
        return file_put_contents($file, preg_replace($parternTitle, $replacementTitle, $subject));
    }
    