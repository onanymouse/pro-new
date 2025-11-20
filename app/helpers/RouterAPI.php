<?php
// /app/helpers/RouterAPI.php

class RouterAPI
{
    /**
     * Cek koneksi ke router (login)
     * @param string $host IP atau hostname MikroTik
     * @param string $user Username API
     * @param string $pass Password API
     * @param int $port Port API default 8728
     * @return bool
     */
    public static function checkConnection($host, $user, $pass, $port = 8728)
    {
        try {
            $socket = @fsockopen($host, $port, $errno, $errstr, 2);
            if (!$socket) return false;

            // Jika perlu login API lebih dalam, bisa pakai library PHP API RouterOS
            fclose($socket);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Contoh menjalankan command sederhana
     * @param string $host
     * @param string $user
     * @param string $pass
     * @param string $command /interface/print
     * @return array
     */
    public static function runCommand($host, $user, $pass, $command, $port = 8728)
    {
        // Placeholder, nanti bisa diganti dengan PHP RouterOS API library
        return [];
    }

    /**
     * Cek semua queue
     */
    public static function getQueues($host, $user, $pass)
    {
        return self::runCommand($host, $user, $pass, '/queue/simple/print');
    }

    /**
     * Tambah queue
     */
    public static function addQueue($host, $user, $pass, $name, $target, $maxLimit)
    {
        return self::runCommand($host, $user, $pass, "/queue/simple/add name=$name target=$target max-limit=$maxLimit");
    }

    /**
     * Ping sederhana
     */
    public static function ping($host, $count = 4)
    {
        $output = [];
        $result = exec("ping -c $count $host", $output, $status);
        return [
            'output' => $output,
            'status' => $status === 0
        ];
    }
}
