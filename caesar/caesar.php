<?php
class Caesar
{
    var $charset;
    var $txt;
    var $rot;

    public function __construct($s, $n)
    {
        $this->charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $this->txt = $s;
        $this->rot = $n;
    }

    public function encode()
    {
        $result = '';
        for ($i = 0; $i < strlen($this->txt); $i++) {
            $result .= $this->rotate($this->txt{
                $i}, $this->rot);
        }
        return $result;
    }

    public function decode()
    {
        $result = '';
        for ($i = 0; $i < strlen($this->txt); $i++) {
            $result .= $this->rotate($this->txt{
                $i}, -$this->rot);
        }
        return $result;
    }

    public function rotate($c, $n)
    {
        $result = '';
        $tamC = strlen($this->charset);
        $k = 0;
        $n %= $tamC;
        $c = strtoupper($c);

        if (strstr($this->charset, $c)) {
            $k = (strpos($this->charset, $c) + $n);
            if ($k < 0) {
                $k += $tamC;
            } else {
                $k %= $tamC;
            }
            $result .= $this->charset{
                $k};
        } else {
            $result .= $c;
        }
        return $result;
    }
}
