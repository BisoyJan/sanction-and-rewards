<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$connect = new PDO("mysql:host=localhost; dbname=vpsdasdata", "root", "");

$limit = '10';
$page = 1;
if ($_POST['page'] > 1) {
    $start = (($_POST['page'] - 1) * $limit);
    $page = $_POST['page'];
} else {
    $start = 0;
}

$query = "
SELECT * FROM properties
";

if ($_POST['query'] != '') {
    $query .= '
  WHERE student_id LIKE "%' . str_replace(' ', '%', $_POST['query']) . '%"
  OR retrieval_id LIKE "%' . str_replace(' ', '%', $_POST['query']) . '%"
  OR type LIKE "%' . str_replace(' ', '%', $_POST['query']) . '%"
  OR date_found LIKE "%' . str_replace(' ', '%', $_POST['query']) . '%"
  OR date_retrieve LIKE "%' . str_replace(' ', '%', $_POST['query']) . '%"
  OR date_surrendered LIKE "%' . str_replace(' ', '%', $_POST['query']) . '%"
  ';
}

$query .= 'ORDER BY id DESC ';

$filter_query = $query . 'LIMIT ' . $start . ', ' . $limit . '';

$statement = $connect->prepare($query);
$statement->execute();
$total_data = $statement->rowCount();

$statement = $connect->prepare($filter_query);
$statement->execute();
$result = $statement->fetchAll();
$total_filter_data = $statement->rowCount();

$output = '
<div class="table-responsive">
<table id="programTable" class="table table-hover" style="text-align: center;">
<thead >
    <tr>
        <th>ID</th>
        <th>Returnee ID</th>
        <th>Retrieval ID</th>
        <th>Type</th>
        <th>Description</th>
        <th>Date Found</th>
        <th>Date Retrieved</th>
        <th>Date Surrendered</th>
        <th>Actions</th>
    </tr>
</thead>

   <tbody >';
if ($total_data > 0) {
    foreach ($result as $row) {
        $output .= '
        <tr>
            <td>' . $row["id"] . '</td>
            <td>' . $row["student_id"] . '</td>
            <td>' . $row["retrieval_id"] . '</td>
            <td>' . $row["type"] . '</td>
            <td>' . $row["description"] . '</td>
            <td>' . $row["date_found"] . '</td>
            <td>' . $row["date_retrieved"] . '</td>
            <td>' . $row["date_surrendered"] . '</td>
            <td>
                <button class="lost-foundViewImage btn btn-success" value="' . $row["id"] . '"  type="button" data-bs-toggle="modal" data-bs-target="#viewImage">View Image</button>
                <a href="../forms/lost-found.php" style="text-decoration: none;"> <button class="lost-foundEditButton btn btn-success" value="' . $row["id"] . '"  type="button">Update</button> </a>
                <button class="lost-foundDeleteButton btn btn-danger" value="' . $row["id"] . '" type="button" data-bs-toggle="modal" data-bs-target="#LostFoundDeleteModal">Delete</button>
            </td>
        </tr>
   ';
    }

    $output .= '
    </tbody>
    </table>
    </div>
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
} else {
    $output .= '
    <tbody>
        <tr>
            <td colspan="12" align="center"><h1>No Data Found</h1></td>
        </tr>
    </tbody>
    </table>
  ';
}



echo $output;
