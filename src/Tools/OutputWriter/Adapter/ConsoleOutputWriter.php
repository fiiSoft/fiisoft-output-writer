<?php

namespace FiiSoft\Tools\OutputWriter\Adapter;

use FiiSoft\Tools\OutputWriter\AbstractOutputWriter;

final class ConsoleOutputWriter extends AbstractOutputWriter
{
    /**
     * @param string $message
     * @param bool $newLine
     * @param int $level
     * @return void
     */
    protected function write($message, $newLine, $level)
    {
        if ($newLine) {
            echo $message, PHP_EOL;
        } else {
            echo $message;
        }
    }
}