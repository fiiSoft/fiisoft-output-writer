<?php

namespace FiiSoft\Tools\OutputWriter;

use InvalidArgumentException;

abstract class AbstractOutputWriter implements OutputWriter
{
    /** @var integer minimal output level, by default cut off everything below normal */
    protected $level = OutputLevel::NORMAL;
    
    /**
     * @param integer $level one of OutputLevel::* constants
     * @throws InvalidArgumentException
     * @return void
     */
    final public function setLevel($level)
    {
        if (!is_int($level) || $level < OutputLevel::DEBUG || $level > OutputLevel::QUIET) {
            throw new InvalidArgumentException('Invalid value of parameter level');
        }
        
        $this->level = $level;
    }
    
    /**
     * @return integer current level
     */
    final public function getLevel()
    {
        return $this->level;
    }
    
    /**
     * @param string $message
     * @param bool $newLine
     * @return void
     */
    final public function normal($message, $newLine = true)
    {
        $this->writeFiltered($message, $newLine, OutputLevel::NORMAL);
    }
    
    /**
     * @param string $message
     * @param bool $newLine
     * @return void
     */
    final public function verbose($message, $newLine = true)
    {
        $this->writeFiltered($message, $newLine, OutputLevel::VERBOSE);
    }
    
    /**
     * @param string $message
     * @param bool $newLine
     * @return void
     */
    final public function veryVerb($message, $newLine = true)
    {
        $this->writeFiltered($message, $newLine, OutputLevel::VERY_VERBOSE);
    }
    
    /**
     * @param string $message
     * @param bool $newLine
     * @return void
     */
    final public function debug($message, $newLine = true)
    {
        $this->writeFiltered($message, $newLine, OutputLevel::DEBUG);
    }
    
    /**
     * @param string $message
     * @param bool $newLine
     * @return void
     */
    final public function error($message, $newLine = true)
    {
        $this->writeFiltered($message, $newLine, OutputLevel::ERROR);
    }
    
    /**
     * @param string $message
     * @param bool $newLine
     * @param int $level
     * @return void
     */
    private function writeFiltered($message, $newLine, $level)
    {
        if ($level >= $this->level) {
            $this->write($message, $newLine, $level);
        }
    }
    
    /**
     * @param string $message
     * @param bool $newLine
     * @param int $level
     * @return void
     */
    abstract protected function write($message, $newLine, $level);
}