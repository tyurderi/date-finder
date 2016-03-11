<?php

namespace WCKZ\DateUtil;

class DateFinder
{

    protected $dateRules = array();

    protected $result    = array();

    public function __construct()
    {
        $this->dateRules = array();
    }

    public function add($callback)
    {
        $this->dateRules[] = $callback;
    }

    public function find($contents, $format = 'd.m.Y')
    {
        $lines = explode(PHP_EOL, $contents);
        $dates = array();

        foreach($this->dateRules as $dateRuleCallback)
        {
            foreach($lines as $i => $line)
            {
                $date = call_user_func_array($dateRuleCallback, array(
                    $line,
                    $i,
                    $format,
                    $this
                ));

                if($this->checkDate($date, $format))
                {
                    $dates[] = $date;
                }
            }
        }

        $this->result = $dates;

        return !empty($dates);
    }

    public function getDates()
    {
        return $this->result;
    }

    protected function checkDate($value, $format = 'd.m.Y')
    {
        $date = \DateTime::createFromFormat($format, $value);
        return $date !== false && !array_sum($date->getLastErrors());
    }

}