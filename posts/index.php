<?php
echo "🧪 Top of index.php<br>";

require_once "../includes/header-single.php";
echo "✅ header-single.php loaded<br>";

echo "Slug: " . ($_GET['slug'] ?? 'no slug') . "<br>";
exit;
