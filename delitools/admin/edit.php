<?require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/header.php";?>
<?
$itemdata = [];
if(isset($_GET["item_id"])) $itemdata = $DB->getItem($_GET["item_id"]);
if(isset($_POST["save_itemdata"])) {
    $itemdata["name"] = $_POST["item_name"];
    $itemdata["sku"] = $_POST["item_sku"];
    $itemdata["price"] = $_POST["item_price"];
    $itemdata["description"] = trim($_POST["item_description"]);
    $itemdata["parent_id"] = $_POST["item_parent"];
    $itemdata["is_category"] = $_POST["item_is_category"]=="on"?1:0;

    if(empty($_POST["item_id"])) {
        $DB->insertItem($itemdata);
    } else {
        $DB->updateItem($_POST["item_id"], $itemdata);}

}

?>
<div class="container">
    <h2><a href="/admin/"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a> <?=empty($_GET["item_id"])?"Добавление":"Редактирование"?></h2>
    <form method="post">
        <div class="mb-3 row">
            <label for="item_id" class="col-sm-2 col-form-label">ID</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="item_id" name="item_id" value="<?=$itemdata['id']?>">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="item_name" class="col-sm-2 col-form-label">Название</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="item_name" name="item_name" value="<?=$itemdata['name']?>">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="item_sku" class="col-sm-2 col-form-label">Артикул</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="item_sku" name="item_sku" value="<?=$itemdata['sku']?>">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="item_price" class="col-sm-2 col-form-label">Цена</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="item_price" name="item_price" value="<?=$itemdata['price']?>">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="item_description" class="col-sm-2 col-form-label">Описание</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="item_description" name="item_description">
                    <?=$itemdata['description']?>
                </textarea>
            </div>
        </div>
        <div class="mb-3 row">
        <div class="form-check">
            <label class="form-check-label" for="item_is_category">
            Это категория
            </label>
            <input class="form-check-input" type="checkbox" id="item_is_category" name="item_is_category" <?=empty($_GET["item_id"])?"":"disabled"?> <?=$itemdata["is_category"]?"checked":""?>>
        </div>
        <div class="mb-3 row">
            <label for="item_parent" class="col-sm-2 col-form-label">Категория</label>
            <div class="col-sm-10">
                <? $categories = $DB->getCategoryTree();?>
                <select class="form-select" id="item_parent" name="item_parent">
                    <option value="0" default>Верхний уровень</option>
                    <? function buildCategoryOptions($categories) {
                        foreach($categories as $id=>$category) {
                            global $itemdata;
                            if($id == $itemdata["id"]) continue;
                            echo '<option value="'.$id.'" '.($id==$itemdata["parent_id"]?"selected":"").'>'.str_repeat(".", $category["depth"]).$category["name"].'</option>';
                            if(!empty($category["children"])) {
                                buildCategoryOptions($category["children"]);
                            }
                        }
                    }
                    
                    buildCategoryOptions($categories)
                    ?>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" name="save_itemdata">Сохранить</button>
    </form>
</div>
<?require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/footer.php";?>