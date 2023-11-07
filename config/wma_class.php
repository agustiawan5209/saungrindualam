<?php
class WeightedMovingAverage
{
    public $y;
    public $next_periode;
    public $n_periode;
    public $x;
    public $ft;
    public $xy;
    public $x_kuadrat;
    public $max_periode;
    public $et_square;
    public $error;
    public $et_yt;
    public $et_abs;
    public $et;
    public $next_ft;

    function __construct($y, $next_periode, $n_periode)
    {
        $this->y = $y;
        $this->next_periode = $next_periode;
        $this->n_periode = $n_periode;
        $this->hitung();
        $this->error();
    }

    function error()
    {
        $a = 1;
        foreach ($this->y as $key => $val) {
            if ($a > $this->n_periode) {
                $this->et[$key] = $this->ft[$key] - $val;
                $this->et_square[$key] = $this->et[$key] * $this->et[$key];
                $this->et_abs[$key] = abs($this->et[$key]);
                if ($val != 0) {
                    $this->et_yt[$key] = abs($this->et[$key] / $val);
                } else {
                    $this->et_yt[$key] = 0; // atau nilai lain yang sesuai dengan kasus Anda
                }
            }
            $a++;
        }
        $this->error['MSE'] = array_sum($this->et_square) / count($this->et_square);
        $this->error['RMSE'] = sqrt($this->error['MSE']);
        $this->error['MAE'] = array_sum($this->et_abs) / count($this->et_abs);
        $this->error['MAPE'] = array_sum($this->et_yt) / count($this->et_yt) * 100;
        //echo '<pre>' . print_r($this->error, 1) . '</pre>';
    }

    function hitung()
    {
        $prev = array();

        foreach ($this->y as $key => $val) {
            $hasil = 0;
            if (count($prev) == $this->n_periode) {
                $n = 0;
                $bobot  = 1;
                foreach ($prev as $v) {
                    $hasil += $v * $bobot;
                    $n += $bobot;
                    $bobot++;
                }
                $hasil /= $n;
            }
            $this->ft[$key] = $hasil;
            $prev[] = $val;
            if (count($prev) > $this->n_periode)
                $prev = array_slice($prev, count($prev) - $this->n_periode, $this->n_periode);
        }

        $this->max_periode = max(array_keys($this->y));
        $this->max_periode = substr($this->max_periode, 0, 8) . '15';

        for ($a = 1; $a <= $this->next_periode; $a++) {
            $hasil = 0;
            $n = 0;
            $bobot  = 1;
            foreach ($prev as $v) {
                $hasil += $v * $bobot;
                $n += $bobot;
                $bobot++;
            }
            $hasil /= $n;
            $key = date('Y-m-d', strtotime("+$a month", strtotime($this->max_periode)));

            $this->next_ft[$key] = $hasil;
            $prev[] = $hasil;
            if (count($prev) > $this->n_periode)
                $prev = array_slice($prev, count($prev) - $this->n_periode, $this->n_periode);
        }
    }
}
