<?php
/**
 * Function to convert an image to a Base64 encoded string.
 *
 * @param string $filePath - Path to the image file.
 * @return string - Base64 encoded string of the image.
 */
function encodeImageToBase64($filePath) {
    // Check if the file exists
    if (!file_exists($filePath)) {
        return "File does not exist: $filePath";
    }
    
    // Get image file contents
    $imageData = file_get_contents($filePath);

    // Encode image data to Base64
    return base64_encode($imageData);
}

// Example usage
$imagePath = 'RefImages_v1\userpic_66ed9f7164b34.jpg';
$maskImagePath = 'RefImages_v1\userpic_66ed9f7164b34mask.png';

$imageBase64 = encodeImageToBase64($imagePath);
$maskImageBase64 = encodeImageToBase64($maskImagePath);

// Output the encoded strings
echo "Image Base64: \n" . $imageBase64 . "\n";

echo "\n";
echo "\n";
echo "\n";
echo "\n";

echo "Mask Image Base64: \n" . $maskImageBase64 . "\n";
