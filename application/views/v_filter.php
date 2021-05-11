<?php 
error_reporting(0);
$best_item = array();
$product_shown=array();
foreach ($barang as $key => $value) {
    $product_shown[]=$value->id_barang;
}
$person = $this->m_rating->getAllUsers();
foreach ($person as $cust):
    foreach ($product_shown as $item): 
        $rate=$this->m_rating->getCoordinates($cust->user,$item);
        if ($rate!==null) {
            $user_avg[$cust->user][$item]= $rate;
            $item_avg[$item][$cust->user]= $rate;
        }
    endforeach;
    $rerata_user[$cust->user]=round(array_sum($user_avg[$cust->user])/count($user_avg[$cust->user]),2);
endforeach;
foreach ($product_shown as $item):
    $count_item_avg = count($item_avg[$item]);
    $sum_item_avg   = array_sum($item_avg[$item]);
    $rerata_item[$item] = round($sum_item_avg/$count_item_avg,2);
endforeach;
foreach ($product_shown as $itema):
    foreach ($product_shown as $itemb):
        if ($itema!==$itemb){ 
            $person = $this->m_rating->getAllUsers();
            $plus=0;
            foreach ($person as $cust):
                $topFirst     = $user_avg[$cust->user][$itema];
                $topLast     = $user_avg[$cust->user][$itemb];
                $topAvg     = $rerata_user[$cust->user];
                $top[] = ($topFirst-$topAvg)*($topLast-$topAvg);
                $plus++;
            endforeach;
            $plus_f=0;
            $plus_l=0;
            foreach ($person as $cust):
                $div['bottom_f'][] = pow(($user_avg[$cust->user][$itema]-$rerata_item[$itema]),2);
                $plus_f++;
                $div['bottom_l'][] = pow(($user_avg[$cust->user][$itemb]-$rerata_item[$itemb]),2);
                $plus_l++;
            endforeach;
            $bottom     = sqrt(array_sum($div['bottom_f'])) * sqrt(array_sum($div['bottom_l']));
            if ($bottom > 0 and round(array_sum($top)/$bottom,2) >= $best) {
                if (round(array_sum($top)/$bottom,2) !== $best) {
                    unset($best_item);
                    unset($best);
                }
                $best_item[] = $itema;
                $best_item[] = $itemb;
                $best = round(array_sum($top)/$bottom,2);
            } 
            unset($top);unset($div);unset($bottom);unset($string);
        }
    endforeach;
endforeach;
// echo $best_item;
// print_r($best_item);exit;
?>
<div class="col-lg-12 p-0 row">
    <div class="col-lg-3 col-xs-12 ">
        <div class="card card-solid mt-2 mb-2 shadow p-3 rounded" style="border-left: #fe7877 solid 4px">
            <div class="card-body">
                <h4>Filter</h4>
                <form method="GET" action="<?php echo base_url()."home/filter/" ?>">
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori" class="custom-select">
                            <option value="">All</option>
                            <?php foreach ($filter_kategori as $row): ?>
                                <option value="<?php echo $row->id_kategori ?>" <?php echo @$_GET['kategori']==$row->id_kategori ? "selected" : ""; ?>><?php echo ucwords($row->nama_kategori) ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Bahan</label>
                        <select name="bahan" class="custom-select">
                            <option value="">All</option>
                            <?php foreach ($filter_bahan as $row): ?>
                                <option value="<?php echo $row->id_bahan ?>" <?php echo @$_GET['bahan']==$row->id_bahan ? "selected" : ""; ?>><?php echo ucwords($row->nama_bahan) ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Range Harga</label>
                        <div class="input-group">
                            <input type="number" name="min" placeholder="Min" class="form-control" value="<?php echo @$_GET['min'] ?>">
                            <input type="number" name="max" placeholder="Max" class="form-control" value="<?php echo @$_GET['max'] ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block" style="background: #fe7877;color: #f1f1f1">Filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-9 col-xs-12">
        <div class="card card-solid mt-2 mb-2">
            <div class="card-body pb-0">
                <div class="row">
                    <?php 
                    $product_shown=array();
                    foreach ($barang as $key => $value) {
                        if (in_array($value->id_barang, $best_item)) {
                            $product_shown[]=$value->id_barang;
                            ?>
                            <div class="col-sm-6 col-xs-12">
                                <?php
                                echo form_open('belanja/add');
                                echo form_hidden('id', $value->id_barang);
                                echo form_hidden('qty', 1);
                                echo form_hidden('price', $value->harga);
                                echo form_hidden('name', $value->nama_barang);
                                echo form_hidden('redirect_page', str_replace('index.php/', '', current_url()));
                                ?>
                                <div class="card bg-light">
                                    <div class="col-12 text-center">
                                        <img src="<?= base_url('assets/uploads/' . $value->gambar) ?>" width="300px" height="250px" class="text-center">
                                    </div>
                                    <div class="card-header text-muted border-bottom-0">
                                        <?php if (in_array($value->id_barang, $best_item)): ?>
                                            <span class="float-right badge badge-danger">Recommended</span>
                                        <?php endif ?>
                                        <h2 class="lead"><b><?= $value->nama_barang; ?></b></h2>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-7">
                                                <p class="text-muted text-sm"><b>Kategori : </b> <?= $value->nama_kategori; ?> </p>
                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="medium"><span class="fa-li "><i class="fas fa-wallet"></i></span><span class="badge bg-success bg-m">Rp. <?= number_format($value->harga, 0); ?></span></li>
                                                    <li class="medium"><span class="fa-li"><i class="fas fa-layer-group"></i></span><?= $value->nama_bahan; ?></li>
                                                    <li>
                                                        <?php 
                                                        $star = round($this->m_rating->getRating($value->id_barang),1);
                                                        if ($star>0) {
                                                            $s=0;
                                                            for ($i = 1; $i <= $star; $i++) {
                                                                echo '<span class="fa fa-star text-warning"></span>';
                                                                $s++;
                                                            }
                                                            if (($star*2)%2==1) {
                                                                echo '<span class="fa fa-star-half-o text-warning"></span>';   
                                                                $s++;
                                                            }
                                                            if ($s < 5) {
                                                                for ($i = 1; $i <= 5 - $s; $i++) {
                                                                    echo '<span class="fa fa-star text-secondary"></span>';   
                                                                }
                                                            }
                                                        }else{
                                                            echo 'Not rated yet';
                                                        }
                                                        ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-right">
                                            <a href="<?= base_url('home/detail_brg/' . $value->id_barang); ?>" class="btn btn-sm bg-teal">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <button type="submit" class="btn btn-sm btn-primary swalDefaultSuccess">
                                                <i class="fa fa-cart-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        <?php }
                    }
                    foreach ($barang as $key => $value) {
                     if (!in_array($value->id_barang, $best_item) && $this->m_rating->getRating($value->id_barang) !== null){
                        $product_shown[]=$value->id_barang;
                        ?>
                        <div class="col-sm-6 col-xs-12">
                            <?php
                            echo form_open('belanja/add');
                            echo form_hidden('id', $value->id_barang);
                            echo form_hidden('qty', 1);
                            echo form_hidden('price', $value->harga);
                            echo form_hidden('name', $value->nama_barang);
                            echo form_hidden('redirect_page', str_replace('index.php/', '', current_url()));
                            ?>
                            <div class="card bg-light">
                                <div class="col-12 text-center">
                                    <img src="<?= base_url('assets/uploads/' . $value->gambar) ?>" width="300px" height="250px" class="text-center">
                                </div>
                                <div class="card-header text-muted border-bottom-0">
                                    <?php if (in_array($value->id_barang, $best_item)): ?>
                                        <span class="float-right badge badge-danger">Recommended</span>
                                    <?php endif ?>
                                    <h2 class="lead"><b><?= $value->nama_barang; ?></b></h2>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-7">
                                            <p class="text-muted text-sm"><b>Kategori : </b> <?= $value->nama_kategori; ?> </p>
                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                <li class="medium"><span class="fa-li "><i class="fas fa-wallet"></i></span><span class="badge bg-success bg-m">Rp. <?= number_format($value->harga, 0); ?></span></li>
                                                <li class="medium"><span class="fa-li"><i class="fas fa-layer-group"></i></span><?= $value->nama_bahan; ?></li>
                                                <li>
                                                    <?php 
                                                    $star = round($this->m_rating->getRating($value->id_barang),1);
                                                    if ($star>0) {
                                                        $s=0;
                                                        for ($i = 1; $i <= $star; $i++) {
                                                            echo '<span class="fa fa-star text-warning"></span>';
                                                            $s++;
                                                        }
                                                        if (($star*2)%2==1) {
                                                            echo '<span class="fa fa-star-half-o text-warning"></span>';   
                                                            $s++;
                                                        }
                                                        if ($s < 5) {
                                                            for ($i = 1; $i <= 5 - $s; $i++) {
                                                                echo '<span class="fa fa-star text-secondary"></span>';   
                                                            }
                                                        }
                                                    }else{
                                                        echo 'Not rated yet';
                                                    }
                                                    ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">
                                        <a href="<?= base_url('home/detail_brg/' . $value->id_barang); ?>" class="btn btn-sm bg-teal">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <button type="submit" class="btn btn-sm btn-primary swalDefaultSuccess">
                                            <i class="fa fa-cart-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                        <?php 
                    }
                }
                foreach ($barang as $key => $value) {
                 if (!in_array($value->id_barang, $best_item) && $this->m_rating->getRating($value->id_barang) == null){
                    $product_shown[]=$value->id_barang;
                    ?>
                    <div class="col-sm-6 col-xs-12">
                        <?php
                        echo form_open('belanja/add');
                        echo form_hidden('id', $value->id_barang);
                        echo form_hidden('qty', 1);
                        echo form_hidden('price', $value->harga);
                        echo form_hidden('name', $value->nama_barang);
                        echo form_hidden('redirect_page', str_replace('index.php/', '', current_url()));
                        ?>
                        <div class="card bg-light">
                            <div class="col-12 text-center">
                                <img src="<?= base_url('assets/uploads/' . $value->gambar) ?>" width="300px" height="250px" class="text-center">
                            </div>
                            <div class="card-header text-muted border-bottom-0">
                                <?php if (in_array($value->id_barang, $best_item)): ?>
                                    <span class="float-right badge badge-danger">Recommended</span>
                                <?php endif ?>
                                <h2 class="lead"><b><?= $value->nama_barang; ?></b></h2>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-7">
                                        <p class="text-muted text-sm"><b>Kategori : </b> <?= $value->nama_kategori; ?> </p>
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="medium"><span class="fa-li "><i class="fas fa-wallet"></i></span><span class="badge bg-success bg-m">Rp. <?= number_format($value->harga, 0); ?></span></li>
                                            <li class="medium"><span class="fa-li"><i class="fas fa-layer-group"></i></span><?= $value->nama_bahan; ?></li>
                                            <li>
                                                <?php 
                                                $star = round($this->m_rating->getRating($value->id_barang),1);
                                                if ($star>0) {
                                                    $s=0;
                                                    for ($i = 1; $i <= $star; $i++) {
                                                        echo '<span class="fa fa-star text-warning"></span>';
                                                        $s++;
                                                    }
                                                    if (($star*2)%2==1) {
                                                        echo '<span class="fa fa-star-half-o text-warning"></span>';   
                                                        $s++;
                                                    }
                                                    if ($s < 5) {
                                                        for ($i = 1; $i <= 5 - $s; $i++) {
                                                            echo '<span class="fa fa-star text-secondary"></span>';   
                                                        }
                                                    }
                                                }else{
                                                    echo 'Not rated yet';
                                                }
                                                ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <a href="<?= base_url('home/detail_brg/' . $value->id_barang); ?>" class="btn btn-sm bg-teal">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <button type="submit" class="btn btn-sm btn-primary swalDefaultSuccess">
                                        <i class="fa fa-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                    <?php 
                }
            } ?>
        </div>
    </div>
</div>
<div class="card  mt-2 mb-2">
    <div class="card-header" id="headingOne">
        <h5 class="mb-0">
            Collaborative Filtering
        </h5>
    </div>
    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <th>Nama\Rating</th>
                        <?php foreach ($product_shown as $ps => $item): ?>
                            <th class="text-center"><?php echo $this->m_barang->get_data($item)->nama_barang;?></th>
                        <?php endforeach ?>
                        <th>Rerata</th>
                    </thead>
                    <tbody>
                        <?php $person = $this->m_rating->getAllUsers();
                        foreach ($person as $cust): ?>
                            <tr>
                                <th><?php echo ucwords($cust->user) ?></th>
                                <?php foreach ($product_shown as $item): ?>
                                    <td class="text-center"><?php echo $this->m_rating->getCoordinates($cust->user,$item); ?></td>
                                    <?php 
                                    $rate=$this->m_rating->getCoordinates($cust->user,$item);
                                    if ($rate!==null) {
                                        $user_avg[$cust->user][$item]= $rate;
                                        $item_avg[$item][$cust->user]= $rate;
                                    }
                                    ?>
                                <?php endforeach ?>
                                <th>
                                    <?php $rerata_user[$cust->user]=round(array_sum($user_avg[$cust->user])/count($user_avg[$cust->user]),2); echo $rerata_user[$cust->user]; ?>
                                </th>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <th class="bg-dark">Total</th>
                        <?php 
                        foreach ($product_shown as $item):
                            $count_item_avg = count($item_avg[$item]);
                            $sum_item_avg   = array_sum($item_avg[$item]);
                            ?>
                            <th class="text-center">
                                <?php $rerata_item[$item] = round($sum_item_avg/$count_item_avg,2); echo $rerata_item[$item] ?>
                            </th>
                        <?php endforeach ?>
                        <th></th>
                    </tfoot>
                </table>
            </div>
            <div class="col-lg-12">
                <div class="text-center">
                    <img src="<?php echo base_url('assets/foto/Collaborative filtering.png') ?>" style="max-width: 300px">
                </div>
                <ul class="list-unstyled">
                    <?php foreach ($product_shown as $itema): ?>
                        <?php foreach ($product_shown as $itemb):
                            if ($itema!==$itemb){ 
                                $string['full']="";
                                ?>
                                <li>
                                    <small>
                                        <i>sim(<b><?php echo $this->m_barang->get_data($itema)->nama_barang;?></b>,<b><?php echo $this->m_barang->get_data($itemb)->nama_barang;?></b>)</i> = 
                                    </small>
                                    <?php 
                                    $person = $this->m_rating->getAllUsers();
                                    $string['top']="";
                                    $string['bottom']="";
                                    $plus=0;
                                    foreach ($person as $cust):
                                        $topFirst     = $user_avg[$cust->user][$itema];  
                                        $topLast     = $user_avg[$cust->user][$itemb];
                                        $topAvg     = $rerata_user[$cust->user];
                                        $top[] = ($topFirst-$topAvg)*($topLast-$topAvg);
                                        $string['top'] .= $plus > 0 ? " + ":"";
                                        $string['top'] .=  " (".$topFirst."-".$topAvg.")(".$topLast."-".$topAvg.")";
                                        $plus++;
                                    endforeach;
                                    $string['bottom_f'] = "√";
                                    $string['bottom_l'] = "√";
                                    $plus_f=0;
                                    $plus_l=0;
                                    foreach ($person as $cust):
                                        $avg_a = $user_avg[$cust->user][$itema];
                                        $avg_b = $user_avg[$cust->user][$itemb];
                                        $div['bottom_f'][] = pow(($avg_a-$rerata_item[$itema]),2);
                                        $string['bottom_f'] .= $plus_f > 0 ? " + ":"";
                                        $string['bottom_f'] .= "(".$avg_a."-".$rerata_item[$itema].")<sup>2</sup>";
                                        $plus_f++;
                                        $div['bottom_l'][] = pow(($avg_b-$rerata_item[$itemb]),2);
                                        $string['bottom_l'] .= $plus_l > 0 ? " + ":"";
                                        $string['bottom_l'] .= "(".$avg_b."-".$rerata_item[$itemb].")<sup>2</sup>";
                                        $plus_l++;
                                    endforeach;
                                    $bottom     = sqrt(array_sum($div['bottom_f'])) * sqrt(array_sum($div['bottom_l']));
                                    $string['bottom'] = $string['bottom_f']."  ".$string['bottom_l'];
                                    ?>
                                    <table>
                                        <tr>
                                            <td>
                                                <small>
                                                    <span class='text-center' style='border-bottom:1px solid black'><?php echo $string['top'] ?></span><br><span class='text-center'><?php echo $string['bottom'] ?></span>
                                                </small>
                                            </td>
                                            <td>&nbsp;=&nbsp;</td>
                                            <td>
                                                <small>
                                                    <span class='text-center' style='border-bottom:1px solid black'>

                                                        <?php echo round(array_sum($top),2) ?>
                                                    </span>
                                                    <br>
                                                    <span class='text-center'>
                                                        <?php echo round(sqrt(array_sum($div['bottom_f'])*array_sum($div['bottom_l'])),2) ?>
                                                    </span>
                                                </small>
                                            </td>
                                            <td>&nbsp;=&nbsp;</td>
                                            <td><?php echo round(array_sum($top)/$bottom,2) ?></td>
                                            <td>
                                                <?php if (round(array_sum($top)/$bottom,2) == $best): ?>
                                                    <small class="badge badge-danger">Recommended</small>
                                                <?php endif ?>
                                            </td>
                                        </tr>
                                    </table>
                                </li>
                                <?php 
                                unset($top);unset($div);unset($bottom);  
                            }
                        endforeach ?>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
</div>