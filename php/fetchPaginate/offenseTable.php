<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$connect = new PDO("mysql:host=localhost; dbname=vpsdasdata", "root", "");

$limit = '6';
$page = 1;
if ($_POST['page'] > 1) {
    $start = (($_POST['page'] - 1) * $limit);
    $page = $_POST['page'];
} else {
    $start = 0;
}

$query = "
SELECT
    violations.*,
    offenses.offense
FROM
    violations
JOIN offenses ON violations.offenses_id = offenses.id
";

if ($_POST['query'] != '') {
    $query .= '
  WHERE violations.code LIKE "%' . str_replace(' ', '%', $_POST['query']) . '"';
}

$query .= 'ORDER BY id DESC ';

$filter_query = $query . 'LIMIT ' . $start . ', ' . $limit . '';

$statement = $connect->prepare($query);
$statement->execute();
$total_data = $statement->rowCount();

if ($statement->rowCount() == 0) {
    echo '<h1>NO DATA</h1>';
} else {

    $statement = $connect->prepare($filter_query);
    $statement->execute();
    $result = $statement->fetchAll();
    $total_filter_data = $statement->rowCount();

    $output = '
<table id="offenseTable" class="table table-hover table-responsive" style="text-align: center; ">
<thead >
    <tr>
        <th>ID</th>
        <th>Type of Offense</th>
        <th>Code</th>
        <th>Violation</th>
        <th>Actions</th>
    </tr>
</thead>

   <tbody >';
    if ($total_data > 0) {
        foreach ($result as $row) {
            $output .= '
        <tr>
            <td>' . $row["id"] . '</td>
            <td>' . $row["offense"] . '</td>
            <td>' . $row["code"] . '</td>
            <td style="width:25%;">' . $row["violation"] . '</td>
            <td>
                <button class="offenseEditButton btn btn-success" value="' . $row["id"] . '" onclick="buttonIDChange()" type="button">Edit Button</button>
                <button class="offenseDeleteButton btn btn-danger" value="' . $row["id"] . '" type="button" data-bs-toggle="modal" data-bs-target="#OffenseDeleteModal">Delete Button</button>
            </td>
        </tr>
   ';
        }
        $output .= '</tbody>';
    } else {
        $output .= '
    <tbody>
        <tr>
            <td colspan="2" align="center">No Data Found</td>
        </tr>
    </tbody>
  ';
    }

    $output .= '
</table>
<label class="mb-2 ps-4">Total Records - ' . $total_data . '</label>
  <ul class="pagination">
';

    $total_links = ceil($total_data / $limit);
    $previous_link = '';
    $next_link = '';
    $page_link = '';

    //echo $total_links;

    if ($total_links > 4) {
        if ($page < 5) {
            for ($count = 1; $count <= 5; $count++) {
                $page_array[] = $count;
            }
            $page_array[] = '...';
            $page_array[] = $total_links;
        } else {
            $end_limit = $total_links - 5;
            if ($page > $end_limit) {
                $page_array[] = 1;
                $page_array[] = '...';
                for ($count = $end_limit; $count <= $total_links; $count++) {
                    $page_array[] = $count;
                }
            } else {
                $page_array[] = 1;
                $page_array[] = '...';
                for ($count = $page - 1; $count <= $page + 1; $count++) {
                    $page_array[] = $count;
                }
                $page_array[] = '...';
                $page_array[] = $total_links;
            }
        }
    } else {
        for ($count = 1; $count <= $total_links; $count++) {
            $page_array[] = $count;
        }
    }

    for ($count = 0; $count < count($page_array); $count++) {
        if ($page == $page_array[$count]) {
            $page_link .= '
    <li class="page-item active">
      <a class="page-link" href="#">' . $page_array[$count] . ' <span class="sr-only">(current)</span></a>
    </li>
    ';

            $previous_id = $page_array[$count] - 1;
            if ($previous_id > 0) {
                $previous_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="' . $previous_id . '">Previous</a></li>';
            } else {
                $previous_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">Previous</a>
      </li>
      ';
            }
            $next_id = $page_array[$count] + 1;
            if ($next_id >= $total_links) {
                $next_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">Next</a>
      </li>
        ';
            } else {
                $next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="' . $next_id . '">Next</a></li>';
            }
        } else {
            if ($page_array[$count] == '...') {
                $page_link .= '
      <li class="page-item disabled">
          <a class="page-link" href="#">...</a>
      </li>
      ';
            } else {
                $page_link .= '
      <li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="' . $page_array[$count] . '">' . $page_array[$count] . '</a></li>
      ';
            }
        }
    }

    $output .= $previous_link . $page_link . $next_link;
    $output .= '
  </ul>

';

    echo $output;
}
