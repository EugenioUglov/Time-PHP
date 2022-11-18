<?php
class Time
{
    private $CI;

    function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('localization');
    }

    public function format($seconds, $always_seconds = false, $count_numbers_after_dot = 2) {
        $localization_current = $this->CI->localization->get_current_localization();
        
        $seconds = abs($seconds);
			
        if ($seconds < 60 || $always_seconds) {
            $fmt = numfmt_create( 'de_DE', NumberFormatter::DECIMAL );
            return round($seconds, $count_numbers_after_dot).' '.$localization_current['common_seconds'];
        } else {
            //dateTimeFormatter.dateTimePattern = "m:ss";
            // return date_format($seconds, 'i:s');

            $minutes = floor($seconds / 60);
            $seconds -= $minutes * 60;

            if ($seconds == 0) return $minutes." ".$localization_current['common_minutes'];

            $seconds = floor($seconds);
            
            if ($seconds < 10) $seconds = '0'.$seconds;

            return $minutes.':'.$seconds;
        }
    }
}