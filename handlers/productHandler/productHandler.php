<?php
require_once '../../dbconfig/db_config.php';

header('Content-Type: application/json');

$action = isset($_GET['action']) ? $_GET['action'] : 'getProducts';

switch ($action) {
    case 'getProducts':
        getProducts();
        break;
    case 'quickView':
        getQuickViewProduct();
        break;
    default:
        echo json_encode(['error' => 'Invalid action']);
        break;
}

function getProducts() {
    global $conn;

    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $limit = 12;
    $offset = ($page - 1) * $limit;

    $search = isset($_GET['search']) ? trim($_GET['search']) : '';
    $size = isset($_GET['size']) ? trim($_GET['size']) : '';
    $minPrice = isset($_GET['minPrice']) ? floatval($_GET['minPrice']) : null;
    $maxPrice = isset($_GET['maxPrice']) ? floatval($_GET['maxPrice']) : null;
    $sort = isset($_GET['sort']) ? trim($_GET['sort']) : '';

    $whereClauses = [];
    $params = [];
    $types = '';

    if (!empty($search)) {
        $whereClauses[] = "name LIKE ?";
        $params[] = '%' . $search . '%';
        $types .= 's';
    }

    if (!empty($size)) {
        $whereClauses[] = "size = ?";
        $params[] = $size;
        $types .= 's';
    }

    if ($minPrice !== null) {
        $whereClauses[] = "price >= ?";
        $params[] = $minPrice;
        $types .= 'd';
    }

    if ($maxPrice !== null) {
        $whereClauses[] = "price <= ?";
        $params[] = $maxPrice;
        $types .= 'd';
    }

    $whereSQL = $whereClauses ? 'WHERE ' . implode(' AND ', $whereClauses) : '';

    $orderBy = '';
    switch ($sort) {
        case 'price_asc':
            $orderBy = 'ORDER BY price ASC';
            break;
        case 'price_desc':
            $orderBy = 'ORDER BY price DESC';
            break;
        case 'name_asc':
            $orderBy = 'ORDER BY name ASC';
            break;
        case 'name_desc':
            $orderBy = 'ORDER BY name DESC';
            break;
    }

    try {
        $query = "SELECT * FROM products $whereSQL $orderBy LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($query);

        if ($types) {
            $types .= 'ii';
            $params[] = $limit;
            $params[] = $offset;
            $stmt->bind_param($types, ...$params);
        } else {
            $stmt->bind_param('ii', $limit, $offset);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $products = $result->fetch_all(MYSQLI_ASSOC);

        $totalQuery = "SELECT COUNT(*) FROM products $whereSQL";
        $totalStmt = $conn->prepare($totalQuery);
        if ($types) {
            $totalStmt->bind_param(substr($types, 0, -2), ...array_slice($params, 0, -2));
        }
        $totalStmt->execute();
        $totalResult = $totalStmt->get_result();
        $totalProducts = $totalResult->fetch_row()[0];

        echo json_encode([
            'products' => $products,
            'totalProducts' => $totalProducts,
            'currentPage' => $page,
            'totalPages' => ceil($totalProducts / $limit),
        ]);
    } catch (mysqli_sql_exception $e) {
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
}

function getQuickViewProduct() {
    global $conn;

    $productId = isset($_GET['productId']) ? intval($_GET['productId']) : 0;

    if ($productId <= 0) {
        echo json_encode(['error' => 'Invalid product ID']);
        return;
    }

    try {
        $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param('i', $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();

        if (!$product) {
            echo json_encode(['error' => 'Product not found']);
            return;
        }

        echo json_encode(['product' => $product]);
    } catch (mysqli_sql_exception $e) {
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
}
