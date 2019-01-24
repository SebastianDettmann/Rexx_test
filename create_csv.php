<?php
    $host = 'localhost';
    $user = 'root';
    $password = 'root';
    $database = 'rexx_test';

    $filename = "customer_sales_" . time() . ".csv";

    $start = $_POST["start"];
    $end = $_POST["end"];

    try {
        $pdo = new PDO("mysql:dbname=$database;host=$host", "$user", "$password");
        $query =
        "SELECT customer.customer_id AS id, 
          CONCAT(
            CASE 
              WHEN gender = 'male' THEN 'Herr '
              ELSE 'Frau '
            END,      
            firstname, ' ', lastname) AS customer_name,
            COUNT(*) AS sales_count, SUM(sales.sale_amount) AS sales_sum, MAX(DATE(sale_date)) AS sales_date
        FROM customer
        INNER JOIN(
          SELECT customer_id, sale_amount, sale_date
          FROM sales1
          UNION ALL
          SELECT customer_id, sale_amount, sale_date
          FROM sales2) AS sales
        ON customer.customer_id = sales.customer_id
        WHERE DATE(sales.sale_date) BETWEEN :sale_start AND :sale_end
        GROUP BY id
        ORDER BY lastname;";

        $statement = $pdo->prepare($query);
        $statement->execute([
            ':sale_start' => $start,
            ':sale_end' => $end
        ]);
    } catch (Exception $e) {
        echo 'Fehler: ' . htmlspecialchars($e->getMessage());
    }

    if(!empty($statement)) {
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        $thead = [];
        foreach($rows[0] as $colName => $val){
            $thead[] = $colName;
        }
        $fp = fopen('php://output', 'w+');
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        fputcsv($fp, $thead);
        foreach($rows as $row){
            fputcsv($fp, $row);
        }
        fclose($fp);
    }
?>

