<?php
namespace pf\arr\build;

trait PFArrToCsv{

    protected $delimiter;
    protected $text_separator;
    protected $replace_text_separator;
    protected $line_delimiter;
    public function _init($delimiter = ";", $text_separator = '"', $replace_text_separator = "'", $line_delimiter = "\n"){
        $this->delimiter              = $delimiter;
        $this->text_separator         = $text_separator;
        $this->replace_text_separator = $replace_text_separator;
        $this->line_delimiter         = $line_delimiter;
        return $this;
    }
    public function convert($input) {
        $lines = array();
        foreach ($input as $v) {
            $lines[] = $this->convertLine($v);
        }
        return implode($this->line_delimiter, $lines);
    }
    private function convertLine($line) {
        $csv_line = array();
        foreach ($line as $v) {
            $csv_line[] = is_array($v) ?
                $this->convertLine($v) :
                $this->text_separator . str_replace($this->text_separator, $this->replace_text_separator, $v) . $this->text_separator;
        }
        return implode($this->delimiter, $csv_line);
    }
}