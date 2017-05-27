<?php

namespace FiiSoft\Tools\OutputWriter;

interface OutputLevel
{
    const QUIET = 100;
    const ERROR = 80;
    const NORMAL = 60;
    const VERBOSE = 40;
    const VERY_VERBOSE = 20;
    const DEBUG = 0;
}