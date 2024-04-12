<? require_once $_SERVER["DOCUMENT_ROOT"]."/include/header.php";?>

<?
$itemdata = $DB->getItem($_GET["id"]);
$itemdata['props'] = $DB->getItemProps($_GET["id"]);
?>

<section class="product_section">
         <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-1 col-lg-1" style="border: 1px solid red">Фотки</div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="box" style="margin-top:0">
                        <div class="img-box">
                            <img src="https://kuvert.kz/upload/resize_cache/iblock/2a9/450_450_140cd750bba9870f18aada2478b24840a/tinlj8ksc3kcy9b7ljwu5pmd1nuv1f0w.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">Свойства</div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="box" style="border:none;margin-top:0">
                        <h5><?=$itemdata["name"]?></h5>
                        <p class="text-black-50">Артикул: <span style="user-select:all"><?=$itemdata["sku"]?></span></p>
                        <h5><b><?=$itemdata["price"]?> тг.</b></h5>
                        <div class="options" style="align-items:start">
                            <a href="javascript:void(0)" class="option2" onclick="addToCart(<?=$itemdata['id']?>)">В корзину</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12" style="padding-top:25px">
                    <h2>Характеристики</h2>
                    <ul>
                        <?foreach($itemdata["props"] as $prop):?>
                            <li><?=$prop["name"]?> - <?=$prop["value"]?></li>
                        <?endforeach?>
                    </ul>
                </div>
                <div class="col-12" style="padding-top:25px">
                    <h2>Описание</h2>
                    <p><?=$itemdata["description"]?></p>
                </div>
            </div>
         </div>
      </section>

<? require_once $_SERVER["DOCUMENT_ROOT"]."/include/footer.php";?>