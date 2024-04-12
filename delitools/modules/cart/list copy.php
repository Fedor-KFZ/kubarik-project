<?
if (isset($_POST['cartData']) && !empty($_POST['cartData'])):
    require_once $_SERVER["DOCUMENT_ROOT"]."/tools/DB.php";

    $cartData = json_decode($_POST['cartData'], true);
    foreach($cartData as $id=>$item):
        // $item["data"] = $DB->getItem($item["id"]);
        print_r($item);
    endforeach;
    exit();
    ?>
    <div class="list-group">
        <?foreach($cartData as $id=>$item):
            $item["data"] = $DB->getItem($item["id"]);?>
        <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3">
            <img src="https://github.com/twbs.png" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0">
            <div class="d-flex gap-2 w-100 justify-content-between">
                <div>
                    <h6 class="mb-0"><?=$item["data"]["name"]?></h6>
                    <p class="mb-0 opacity-50"><?=$item["data"]["price"] тг.?></p>
                </div>
                <div class="opacity-50 text-nowrap" onclick="removeFromCart(<?=$item['id']?>)">&times;</div>
            </div>
        </a>
        <?endforeach;?>
    </div>
<?else:?>
<div class="list-group">
    <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3">
        <div class="d-flex gap-2 w-100 justify-content-between">
            <div>
                <h6 class="mb-0">Ваша корзина пуста</h6>
                <p class="mb-0 opacity-50">Исправить это просто: выберите в каталоге интересующий
товар и нажмите кнопку «В корзину».</p>
            </div>
        </div>
    </a>
</div>
<?endif;?>