<?php

namespace FiiSoft\Tools\OutputWriter\Adapter;

use FiiSoft\Tools\OutputWriter\AbstractOutputWriter;

final class NullOutputWriter extends AbstractOutputWriter
{
    /**
     * @param string $message
     * @param bool $newLine
     * @param int $level
     * @return void
     */
    protected function write($message, $newLine, $level)
    {
        // noop
    }
}