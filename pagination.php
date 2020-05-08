<?php
    if ($page == 1)
        $firstStatus = " disabled";
    else
        $firstStatus = "";
    if ($nbPages == $page)
        $lastStatus = " disabled";
?>
<div class="main-pagination">
    <ul class="pagination pagination-lg center">
        <li class="page-item<?php echo $firstStatus; ?>">
            <a class="page-link" href="?page=<?php echo $page-1;?>">&laquo;</a>
            </li>
            <?php
            for ($i = 1; $i <= $nbPages; $i++) {
                if ($i == $page)
                    $current = ' active';
                else
                    $current = '';
                echo '<li class="page-item' . $current . '">
                <a class="page-link" href="?page=' . $i . '">' . $i .'</a>
                </li>';
            }
            ?>
            <li class="page-item<?php echo $lastStatus; ?>">
            <a class="page-link" href="?page=<?php echo $page+1;?>">&raquo;</a>
        </li>
    </ul>
</div>