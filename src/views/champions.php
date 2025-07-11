<!DOCTYPE html>
<html lang="en">
<?php
try {
    require_once "../controllers/championsController.php";
} catch (\Throwable $th) {
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://raw.githubusercontent.com/VietHung0712/AssetsLOL/refs/heads/main/Icon/League_of_Legends_icon.svg">
    <link rel="stylesheet" href="../style/layout-admin.css">
    <title>Champions - Admin</title>
</head>

<body>
    <?php require_once __DIR__ . "/Templates/header.php"; ?>
    <main>
        <div id="tools">
            <form id="search" action="./champions.php" method="POST">
                <input type="search" name="valueSearch" placeholder="Search"
                    value="<?php if (isset($valueSearch)) echo $valueSearch; ?>">
                <select name="sort" id="selectSort">
                    <?php
                    if (isset($sortArr)) {
                        foreach ($sortArr as $item) {
                    ?>
                            <option
                                value="<?php echo $item[0]; ?>"
                                <?php
                                if (isset($valueSearch) && trim($valueSort) === trim($item[0])) echo ' selected';
                                ?>>
                                <?php echo $item[1]; ?>
                            </option>
                    <?php
                        }
                    }
                    ?>
                </select>
                <button type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>
                </button>
            </form>
        </div>
        <div id="addNew">
            <a href="./editChampion.php?edit=add">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                </svg>
            </a>
        </div>
        <table id="list" class="table__tr">
            <caption>Champions</caption>
            <thead id="thead__pc">
                <th>ID</th>
                <th>Name</th>
                <th>Region</th>
                <th>Release Date</th>
                <th>Updated Date</th>
                <th>Details</th>
            </thead>

            <tbody>
                <?php
                if (isset($champions)) {
                    foreach ($champions as $i => $item) {
                ?>
                        <tr>
                            <th class="thead__mobile">ID</th>
                            <td>
                                <input type="text" value="<?php echo $item->getId(); ?>" disabled>
                            </td>
                            <th class="thead__mobile">Name</th>
                            <td>
                                <input type="text" value="<?php echo $item->getName(); ?>" disabled>
                            </td>
                            <th class="thead__mobile">Region</th>
                            <td>
                                <a href="./editRegion.php?edit=details&region=<?php echo $item->getRegion(); ?>"><?php echo $item->getRegion(); ?></a>
                            </td>
                            <th class="thead__mobile">Release Date</th>
                            <td>
                                <input type="date" value="<?php echo $item->getReleaseDate(); ?>" disabled>
                            </td>
                            <th class="thead__mobile">Updated Date</th>
                            <td>
                                <input type="date" value="<?php echo $item->getUpdatedDate(); ?>" disabled>
                            </td>
                            <th class="thead__mobile">Details</th>
                            <td>
                                <a href="./editChampion.php?edit=details&champion=<?php echo $item->getId(); ?>">
                                    <span>View</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z" />
                                        <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>

        </table>
    </main>
</body>

</html>

<script type="module">
    import {
        $
    } from '../js/functions.js';

    const $formSearch = $("form#search")
    const $selectSort = $('#selectSort');
    $selectSort.addEventListener('change', () => {
        $formSearch.submit();
    });
</script>