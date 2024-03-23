<!-- anything proper is not done in this page -->
<?php

$filePath = '../pages/';//location of the file
$fileName = 'test.pdf'; // name of file
$fileFullPath = $filePath . $fileName;

//check file exists in the given place or not
if (!file_exists($fileFullPath)) {
    die('File not found.');
}

// Get the file extension of the file
$fileExtension = strtolower(pathinfo($fileFullPath, PATHINFO_EXTENSION));

switch ($fileExtension) {
    case 'jpg':
    case 'jpeg':
    case 'png':
        // Serve image files directly in the preview provided by the browser
        header('Content-Type: image/' . $fileExtension);
        readfile($fileFullPath);
        break;

    case 'pdf':
        // Serve PDF files directly in the preview provided by the browser
        header('Content-Type: application/pdf');
        readfile($fileFullPath);
        break;

    case 'docx':
    case 'pptx':
    case 'xlsx':
        // Convert Office documents to PDF
        $convertedFileName = convertToPDF($fileFullPath);
        header('Content-Type: application/pdf');
        readfile($convertedFileName);
        break;

    default:
        echo 'Unsupported file type.';
}

function convertToPDF($originalFile) {
    // Placeholder for conversion logic
    // You can use tools like LibreOffice or a PHP library for conversion
    // For example, using LibreOffice in command line:
    // shell_exec("libreoffice --headless --convert-to pdf:writer_pdf_Export $originalFile --outdir /path/to/output");
    // Return the path to the converted file
    return '/path/to/converted/file.pdf';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Document</title>
</head>
<body>
    <div id="preview">
        <!-- Dynamically generate the iframe or img src based on the file type -->
        <?php if (strtolower(pathinfo($fileName, PATHINFO_EXTENSION)) == 'pdf'): ?>
            <iframe src="?action=serveFile&file=<?= urlencode($fileName) ?>" width="100%" height="600px"></iframe>
        <?php else: ?>
            <img src="?action=serveFile&file=<?= urlencode($fileName) ?>" alt="File Preview" style="max-width: 100%; height: auto;">
        <?php endif; ?>
    </div>

</body>
</html>