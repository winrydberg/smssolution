<?php
namespace App\Helpers;

class EnvUpdater {
    public static function update($key, $value) {
        $path = base_path('.env');
        if (file_exists($path)) {
            $env = file_get_contents($path);
            $pattern = "/^" . preg_quote($key) . "=.*/m";
            $replacement = $key . '=' . $value;

            if (preg_match($pattern, $env)) {
                $env = preg_replace($pattern, $replacement, $env);
            } else {
                $env .= "\n" . $replacement;
            }
            file_put_contents($path, $env);
        }
    }
} 