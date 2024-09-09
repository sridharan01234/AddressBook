<?php

/**
 * Logger class to log messages to a file.
 *
 * @author Sridharan
 */
class DbLogger
{
    public const file = '/var/log/database.log'; // Update the log file path as needed

    /**
     * Logs a test message to the file.
     */
    public function log()
    {
        $message = 'Test message to log.';
        error_log($message, E_USER_NOTICE, self::file);
    }
}
