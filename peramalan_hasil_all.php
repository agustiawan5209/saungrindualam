<?php
$_SESSION['post'] = $_POST;
$all_bahan = getAllBahan();
$data_analisa = get_analisa();

$data_WMA = array();
foreach ($data_analisa as $key => $value) {
    $data_WMA[$key] = new WeightedMovingAverage($value, $next_periode, $n_periode);
}

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
<?php
foreach ($data_WMA as $key => $value) {
?>
    <div class="card-body">
        <div class="card-heading">
            <h3 class="card-title"><?= $BAHAN[$key] ?></h3>
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
                <?php foreach ($value->y as $index => $val) :
                    $categories[$key][date('M-Y', strtotime($index))] = date('M-Y', strtotime($index));
                    $series[$key]['aktual']['data'][$index] = $val * 1;
                    $series[$key]['prediksi']['data'][$index] = round($value->ft[$index], 2); ?>
                    <tr>
                        <td><?= date('M-Y', strtotime($index)) ?></td>
                        <td><?= number_format($val) ?></td>
                        <td><?= number_format($value->ft[$index], 2) ?></td>
                        <td><?= !isset($value->et[$index]) ? '' : number_format($value->et[$index], 2) ?></td>
                        <td><?= !isset($value->et_square[$index]) ? '' : number_format($value->et_square[$index], 2) ?></td>
                        <td><?= !isset($value->et_abs[$index]) ? '' : number_format($value->et_abs[$index], 2) ?></td>
                        <td><?= !isset($value->et_yt[$index]) ? '' : number_format($value->et_yt[$index], 2) ?></td>
                    </tr>
                <?php endforeach ?>
                <tr>
                    <td colspan="4" class="text-right">MSE (Mean Squared Error)</td>
                    <td><?= number_format($value->error['MSE'], 2) ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right">RMSE (Root Mean Squared Error)</td>
                    <td><?= number_format($value->error['RMSE'], 2) ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right">MAE (Mean Absolute Error)</td>
                    <td>&nbsp;</td>
                    <td><?= number_format($value->error['MAE'], 2) ?></td>
                    <td>&nbsp;</td>
                </tr>
                <!-- <tr>
                <td colspan="4" class="text-right">MAPE (Mean Absolute Percentage Error)</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><?= number_format($value->error['MAPE'], 2) ?> % </td>
            </tr> -->
            </table>
        </div>

        <form method="POST" enctype="multipart/form-data">
            <div class="card-heading mt-3">
                <h3 class="card-title">Hasil Prediksi:</h3>
                <input type="hidden" name="kode_bahan[]" value="<?= $key ?>">
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Bulan (n)</th>
                            <th>Fx</th>
                        </tr>
                    </thead>
                    <?php foreach ($value->next_ft as $k => $val) :
                        $k = date('M-Y', strtotime($k));
                        $tgls = date('Y-m', strtotime($k));
                        $categories[$key] = $k;
                        $series[$key]['aktual']['data'][$k] = null;
                        $series[$key]['prediksi']['data'][$k] = round($val, 2); ?>
                        <tr>
                            <td><?= tgl_indo($tgls) ?>
                                <input type="hidden" name="htanggal[<?= $key ?>]" value="<?= tgl_indo($tgls) ?>">
                            </td>
                            <td><?= number_format($val) ?>
                                <input type="hidden" name="hhasil[<?= $key ?>]" value="<?= number_format($val) ?>">
                            </td>
                        </tr>
                    <?php endforeach ?>


                </table>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <div id="container<?= $BAHAN[$key] ?>"></div>
                </div>
            </div>
            <script>
                <?php
                $categories_cart = array_values($categories);
                $series[$key]['aktual']['name'] = 'Aktual';
                $series[$key]['prediksi']['name'] = 'Prediksi';
                $series[$key]['aktual']['data'] = array_values($series[$key]['aktual']['data']);
                $series[$key]['prediksi']['data'] = array_values($series[$key]['prediksi']['data']);
                $series_cart = array_values($series[$key]);
                // var_dump($series);
                ?>
                Highcharts.chart('container<?= $BAHAN[$key] ?>', {
                    chart: {
                        type: 'line'
                    },
                    title: {
                        text: 'Grafik Data dan Hasil Prediksi ' + '<?= $BAHAN[$key] ?>'
                    },
                    xAxis: {
                        categories: <?= json_encode($categories_cart) ?>
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
                    series: <?= json_encode($series_cart) ?>,
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

    // Actual data
    $actualData = array_values(array_shift($series[$key]['aktual']));

    // Predicted data using WMA
    $predictedData = array_values(array_shift($series[$key]['prediksi']));

    $data_mape = calculateMAPE($actualData, $predictedData);
    ?>
    <div class="card-body">
        <div class="col-md-12 text-center">
            <div class="card-heading mt-3">
                <h5 class="card-title">Hasil PENGUJIAN MAPE (Mean Absolute Percentage Error) <?= $BAHAN[$key] ?>: <?= number_format($data_mape, 5) ?>%</h5>
            </div>

        </div>
    </div>
<?php

}
?>
<div class="card-body">
    <div class="row">
        <div class="col-md-12 text-center">
            <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
        </div>
    </div>
</div>
</form>