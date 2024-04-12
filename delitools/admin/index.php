<?
require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/header.php";

$page = $_GET["page"] ?? 1;
$limit = 100;

$offset = $page*$limit;
$filter="";
if($_GET["filter_categories"]=="1") {
    $filter="is_category=1";
}
$items = $DB->getItems($filter, $limit, $offset, "id");
?>
<div class="container">
    <h2>Список товаров</h2>
    <a href="edit.php" class="btn btn-primary">Добавить</a>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Название</th>
        <th scope="col">Артикул</th>
        <th scope="col">Цена</th>
        <th scope="col">Категория</th>
        <th scope="col">Редактировать</th>
        </tr>
    </thead>
    <tbody>
        <?foreach($items as $item):?>
            <tr>
                <th><?=$item["id"]?></th>
                <td><?=$item["name"]?></td>
                <td><?=$item["sku"]?></td>
                <td><?=$item["price"]?></td>
                <td><?=$item["parent_id"]>0?$DB->getItem($item["parent_id"])["name"]:"???";?></td>
                <td><a href="/admin/edit.php?item_id=<?=$item["id"]?>" class="btn btn-primary"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
            </tr>
        <?endforeach;?>
    </tbody>
    </table>
</div>

<?php
    $itemsCount = $DB->select("SELECT COUNT(*) AS count FROM items")[0]["count"];

    $pagesCount = floor($itemsCount / $limit);

    $startPage = max(1, $page - 5);
    $endPage = min($pagesCount, $page + 4);
    ?>
    <div class="fixed-bottom bg-light">
        <div class="container">
            <nav class="py-3">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link<?=$page>1?"":" disabled"?>" href="?page=<?=max(1,$page-1)?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link <?=$page>1?"":" disabled"?>" href="?page=1">Начало</a></li>
                    <?php for($i=$startPage; $i<=$endPage;$i++):?>
                        <li class="page-item<?=$i==$page?" active":""?>"><a class="page-link" href="?page=<?=$i?>"><?=$i?></a></li>
                    <?php endfor;?>
                    <li class="page-item"><a class="page-link<?=$page < $pagesCount?"":" disabled"?>" href="?page=<?=$pagesCount?>">Конец</a></li>

                    <li class="page-item">
                        <a class="page-link<?=$page < $pagesCount?"":" disabled"?>" href="?page=<?=min($pagesCount, $page+1)?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>

        </div>
    </div>


<?
require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/footer.php";
?>