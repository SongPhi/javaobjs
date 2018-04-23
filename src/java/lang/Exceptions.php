<?php
namespace java\lang;

define ('NO_EXCEPTION',         0);
define ('EXCEPTION_DIE',        1);
define ('EXCEPTION_PRINT',      2);
define ('EXCEPTION_RETURN',     3);
define ('EXCEPTION_TRIGGER',    4);
define ('EXCEPTION_CALL_BACK',  5);

class Exceptions extends \java\lang\Object {
    /* Mode of error */
    var $mode       = EXCEPTION_RETURN;

    /* Trigger_error level */
    var $level      = E_USER_NOTICE;

    /* Error code */
    var $code       = -1;

    /* Error message */
    var $message    = '';

    /* Debug backtrace */
    var $backtrace  = null;

    /* Callback method */
    var $callback   = null;

    /* File info */
    var $file       = __FILE__;

    /* Line info */
    var $line       = __LINE__;

    /**
     *  Construction
     *  @param  String  $message
     *  @param  int     $code
     *  @param  int     $mode
     *  @param  mixed   $option
     */
    function __construct($message = 'Unkown Exception',
                        $code = null,
                        $mode = null,
                        $option = null,
                        $file = __FILE__,
                        $line = __LINE__,
                        $debug = false) {

        if (null === $mode) {
            $level = E_USER_ERROR;
        } else {
            $this->mode = $mode;
            if ($mode & EXCEPTION_CALL_BACK) {
                $this->callback = $option['callback'];
            } else if ($option != null) {
                $level = $option['level'];
            }
        }

        $this->code = (null !== $code) ? $code: -1;
        $this->level = $level;
        $this->message = $message;
        $this->file = (!$file) ? '\'unknow file\'': $file;
        $this->line = (!$line) ? (int)0: $line;
        $this->debug = $debug;

        $this->debug();

        switch ($this->mode) {
            /* Return mode: return an new Exceptions object */
            case EXCEPTION_RETURN :
                return new $this($message);
                break;
            
            /* Error print mode: print error message, not stop running */
            case EXCEPTION_PRINT :
                printf ($this->getFormat($option), $this->getMessage());
                break;

            /* Error die mode: print error message and stop program */
            case EXCEPTION_DIE :
                die(sprintf($this->getFormat($option), $this->getMessage()));
                break;

            /* Trigger_error mode: using build in php trigger_error mode */
            case EXCEPTION_TRIGGER :
                trigger_error($this->getMessage(), $this->level);
                break;
            
            /* Callback mode: invoke callback function that user setup */
            case EXCEPTION_CALL_BACK :
                if (is_callable($this->callback)) {
                    call_user_func($this->callback, $this);
                }
                break;

            /* Exception mode: throw new exception */
            case EXCEPTION_EXCEPTION :
                // Need php5.0.0 or above
                if (version_compare('5.0.0', phpversion(), '<=')) {
                    eval("throw new EXCEPTION($this->getMessage();)");
                } else {
                    $message = 'Your php version ('.phpversion().') < 5.0.0';
                    return new $this($message, null, EXCEPTION_NOTICE);
                }
                break;
        }
    }

    /**
     *  Destruction
     */
    function __destruct() {;}

    /**
     *  Print debug message
     *  @return void
     */
    function debug() {
        if ($GLOBALS['debug'] >= 5)
            Object::debug(sprintf('Exception in %s at line %s<br/>', $this->file, $this->line));

        $this->backtrace = debug_backtrace();
    }

    /**
     *  Get buildin php debug_backtrace infomation
     *  @param String $param
     *  @return String
     *  @access public
     */
    function getDebugBacktrace($param=null) {
        if (!$param || null === $param)
            return $this->backtrace;
        return $this->backtrace[$param];
    }
    
    /**
     *  Get print mode of EXCEPTION_PRINT
     *  @param  mixed   $option
     *  @return String
     *  @access public
     */
    function getFormat(&$option) {
        if (is_null($option) || is_int($option))
            return '%s';
        else
            return $option;
    }

    /**
     *  Get mode of current Exceptions object
     *  @return int
     *  @access public
     */
    function getMode() {
        return $this->mode;
    }

    /**
     *  Get message of current Exceptions object
     *  @return String
     *  @access public
     */
    function getMessage() {
        return $this->message;
    }

    /**
     *  Get mode of EXCEPTION_TRIGGER and error level
     *  @return int
     *  @access public
     */
    function getLevel() {
        return $this->level;
    }

    /**
     *  Get error code of current Exceptions object
     *  @return int
     *  @access public
     */
    function getCode() {
        return $this->code;
    }

    /**
     *  Get callback function of current Exceptions object
     *  @return int
     *  @access public
     */
    function getCallback() {
        return $this->callback;
    }

    /**
     *  Get instance name of current Exceptions object
     *  @return String
     *  @access public
     */
    function instanceOfClass() {
        return get_class($this);
    }

    /**
     *  Set debug level
     *  @return void
     *  @access public
     */
    function setDebug($debug) {
        $this->debug = $debug;
    }

    /**
     *  Return a string description of this object
     *  @return String
     *  @access public
     */
    function toString() {
        $levels = array(E_USER_NOTICE => 'e_user_notice',
                        E_USER_WARNING => 'e_user_warning',
                        E_USER_ERROR => 'e_user_error'
                  );
        $modes = array(EXCEPTION_RETURN => 'return',
                       EXCEPTION_PRINT => 'print',
                       EXCEPTION_DIE => 'die',
                       EXCEPTION_TRIGGER => 'trigger',
                       EXCEPTION_EXCEPTION => 'exception',
                       EXCEPTION_CALL_BACK => 'callback'
                 );

        return sprintf('class: "%s"<br/> 
                        message: "%s"<br/> 
                        code: "%s"<br/> 
                        mode: "%s"<br/> 
                        level: "%s"<br/> 
                        callback: "%s"<br/>',       
                        $this->instanceOfClass(), 
                        $this->message, 
                        $this->code ? $this->code: 'null', 
                        $modes[$this->mode], 
                        $levels[$this->level], 
                        $this->callback ? $this->callback: 'null');
    }
} // End class
