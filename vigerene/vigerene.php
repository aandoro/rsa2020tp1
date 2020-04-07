<?php
class Vigerene
{
    var $charset;
    var $txt;
    var $rot;

    public function __construct($msj, $key)
    {
        $this->charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $this->txt = $msj;
        $this->rot = $key;
    }

    public function encode()
    {
        $result = '';
        $sign = "encode";

        for ($i = 0; $i < strlen($this->txt); $i++) {
            $result .= $this->rotate($this->txt{
                $i}, $this->rot{
                $i % strlen($this->rot)}, $sign);
        }
        return $result;
    }

    public function decode()
    {
        $result = '';
        $sign = "decode";
        for ($i = 0; $i < strlen($this->txt); $i++) {
            $result .= $this->rotate($this->txt{
                $i}, $this->rot{
                $i % strlen($this->rot)}, $sign);
        }
        return $result;
    }

    public function rotate($c, $n, $s)
    {
        $result = '';
        $tamC = strlen($this->charset);
        $k = 0;
        $n = strtoupper($n);
        $c = strtoupper($c);

        if (strstr($this->charset, $c)) {
            if (strcmp($s, "encode")) {
                $k = ((strpos($this->charset, $c) + strpos($this->charset, $n)) % $tamC);
            } else {
                $k = ((strpos($this->charset, $c) - strpos($this->charset, $n)) % $tamC);
            }
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
