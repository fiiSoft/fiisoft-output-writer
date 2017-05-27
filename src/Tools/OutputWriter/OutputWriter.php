<?php

namespace FiiSoft\Tools\OutputWriter;

use InvalidArgumentException;

interface OutputWriter
{
    /**
     * Set minimum level of messages that will be passed through OutputWriter.
     *
     * @param integer $level one of OutputLevel::* constants
     * @throws InvalidArgumentException if param level has invalid value
     * @return void
     */
    public function setLevel($level);
    
    /**
     * @return integer current level
     */
    public function getLevel();
    
    /**
     * @param string $message
     * @param bool $newLine
     * @return void
     */
    public function normal($message, $newLine = true);
    
    /**
     * @param string $message
     * @param bool $newLine
     * @return void
     */
    public function verbose($message, $newLine = true);
    
    /**
     * @param string $message
     * @param bool $newLine
     * @return void
     */
    public function veryVerb($message, $newLine = true);
    
    /**
     * @param string $message
     * @param bool $newLine
     * @return void
     */
    public function debug($message, $newLine = true);
    
    /**
     * @param string $message
     * @param bool $newLine
     * @return void
     */
    public function error($message, $newLine = true);
}