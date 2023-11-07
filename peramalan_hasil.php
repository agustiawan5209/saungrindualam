<?php
$_SESSION['post'] = $_POST;
$analisa = get_analisa();
$kode_bahan = $_POST['kode_bahan'];
$analisa = $analisa[$kode_bahan];


$wma = new WeightedMovingAverage($analisa, $next_periode, $n_periode);
$categories = array();
$series = array();
?>
<style type="text/css">
    #container {
        height: 500px;
        width: 100%;
        max-width: 1000;
    }
</style>
<div class="card-body">
    <div class="card-heading">
        <h3 class="card-title"><?= $BAHAN[$kode_bahan] ?></h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>Bulan (n)</th>
                    <th>Y</th>
                    <th>Fx</th>
                    <th>e<sub>t</sub></th>
                    <th>e<sub>t</sub><sup>2</sup></th>
                    <th>|e<sub>t</sub>|</th>
                    <th>|e<sub>t</sub> / y<sub>t</sub>|</th>
                </tr>
            </thead>
            <?php foreach ($analisa as $key => $val) :
                $categories[date('M-Y', strtotime($key))] = date('M-Y', strtotime($key));
                $series['aktual']['data'][$key] = $val * 1;
                $series['prediksi']['data'][$key] = round($wma->ft[$key], 2); ?>
                <tr>
                    <td><?= date('M-Y', strtotime($key)) ?></td>
                    <td><?= number_format($val) ?></td>
                    <td><?= number_format($wma->ft[$key], 2) ?></td>
                    <td><?= !isset($wma->et[$key]) ? '' : number_format($wma->et[$key], 2) ?></td>
                    <td><?= !isset($wma->et_square[$key]) ? '' : number_format($wma->et_square[$key], 2) ?></td>
                    <td><?= !isset($wma->et_abs[$key]) ? '' : number_format($wma->et_abs[$key], 2) ?></td>
                    <td><?= !isset($wma->et_yt[$key]) ? '' : number_format($wma->et_yt[$key], 2) ?></td>
                </tr>
            <?php endforeach ?>
            <tr>
                <td colspan="4" class="text-right">MSE (Mean Squared Error)</td>
                <td><?= number_format($wma->error['MSE'], 2) ?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="4" class="text-right">RMSE (Root Mean Squared Error)</td>
                <td><?= number_format($wma->error['RMSE'], 2) ?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="4" class="text-right">MAE (Mean Absolute Error)</td>
                <td>&nbsp;</td>
                <td><?= number_format($wma->error['MAE'], 2) ?></td>
                <td>&nbsp;</td>
            </tr>
            <!-- <tr>
                <td colspan="4" class="text-right">MAPE (Mean Absolute Percentage Error)</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><?= number_format($wma->error['MAPE'], 2) ?> % </td>
            </tr> -->
        </table>
    </div>
    <form method="POST" enctype="multipart/form-data">
        <div class="card-heading mt-3">
            <h3 class="card-title">Hasil Prediksi:</h3>
            <input type="hidden" name="kode_bahan" value="<?= $kode_bahan ?>">
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Bulan (n)</th>
                        <th>Fx</th>
                    </tr>
                </thead>
                <?php foreach ($wma->next_ft as $key => $val) :
                    $key = date('M-Y', strtotime($key));
                    $tgls = date('Y-m', strtotime($key));
                    $categories[$key] = $key;
                    $series['aktual']['data'][$key] = null;
                    $series['prediksi']['data'][$key] = round($val, 2); ?>
                    <tr>
                        <td><?= tgl_indo($tgls) ?>
                            <input type="hidden" name="htanggal[]" value="<?= tgl_indo($tgls) ?>">
                        </td>
                        <td><?= number_format($val) ?>
                            <input type="hidden" name="hhasil[]" value="<?= number_format($val) ?>">
                        </td>
                    </tr>
                <?php endforeach ?>


            </table>
        </div>
        <div class="row mt-3">
            <div class="col">
                <div id="container"></div>
            </div>
        </div>
        <script>
            <?php
            $categories = array_values($categories);
            $series['aktual']['name'] = 'Aktual';
            $series['prediksi']['name'] = 'Prediksi';
            $series['aktual']['data'] = array_values($series['aktual']['data']);
            $series['prediksi']['data'] = array_values($series['prediksi']['data']);
            $series = array_values($series);
            ?>
            Highcharts.chart('container', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Grafik Data dan Hasil Prediksi ' + '<?= $BAHAN[$kode_bahan] ?>'
                },
                xAxis: {
                    categories: <?= json_encode($categories) ?>
                },
                yAxis: {
                    title: {
                        text: 'Total'
                    }
                },
                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true
                        },
                        enableMouseTracking: true
                    }
                },
                series: <?= json_encode($series) ?>,
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                align: 'center',
                                verticalAlign: 'bottom',
                                layout: 'horizontal'
                            }
                        }
                    }]
                }
            });
        </script>
</div>
<?php
function calculateMAPE($actual, $predicted)
{
    // $sumAPE = 0;
    // $n = count($actual);

    // for ($i = 0; $i < $n; $i++) {
    //     if ($actual[$i] != 0) {
    //         $APE = abs(($actual[$i] - $predicted[$i]) / $actual[$i]) * 100;
    //         $sumAPE += $APE;
    //     }
    // }

    // $MAPE = $sumAPE / $n;
    // return $MAPE;

    $sum_absolute_error = 0;
    $length = count($actual);
    for ($i = 0; $i < $length; $i++) {
        $absolute_error = abs($actual[$i] - $predicted[$i]);
        $sum_absolute_error += $absolute_error;
    }
    $mean_absolute_error = $sum_absolute_error / $length;
    $mean_absolute_percentage_error = $mean_absolute_error / array_sum($actual) * 100;
    return $mean_absolute_percentage_error;
}
// Actual data
$actualData = array_values(array_shift($series[0]));

// Predicted data using WMA
$predictedData = array_values(array_shift($series[1]));

$data_mape = calculateMAPE($actualData, $predictedData);
?>
<div class="card-body">
    <div class="col-md-12 text-center">
        <div class="card-heading mt-3">
            <h3 class="card-title">Hasil PENGUJIAN MAPE (Mean Absolute Percentage Error): <?= number_format($data_mape,5) ?>%</h3>
        </div>

    </div>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-md-12 text-center">
            <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
        </div>
    </div>
</div>
</form>