<?php
require_once('vendor/autoload.php');

$client = new \GuzzleHttp\Client();

$apiKey = '';

function encodeImageToBase64($filePath): string {
    $imageData = file_get_contents(filename: $filePath);
    return base64_encode(string: $imageData);
}

$imageFilePath = 'RefImages_v1\userpic_66f7167e69496.jpeg';
$maskImageFilePath = 'RefImages_v1\userpic_66f7167e69496mask.png';

$imageBase64 = encodeImageToBase64(filePath: $imageFilePath);
$maskImageBase64 = encodeImageToBase64(filePath: $maskImageFilePath);

$response = $client->request('POST', 'https://api.getimg.ai/v1/stable-diffusion-xl/inpaint', [
  'body' => json_encode(value: [
    "model" => "stable-diffusion-xl-v1-0",
    "prompt" => "
    A photorealistic depiction of a French Country garden in USDA hardiness zone 10a, showcasing traditional landscape design elements. The garden features five English Lavender (Lavandula angustifolia) shrubs in 1-gallon pots, each 24-36 inches tall, strategically placed under a charming wooden deck to provide fragrance and attract butterflies. Near the left-side fence, two Black Knight Butterfly Bushes (Buddleja davidii) in 2-gallon pots, each 6-8 feet tall, serve as focal points drawing butterflies and adding vertical interest. Along the perimeter, eight American Boxwood (Buxus sempervirens) hedges in 2-gallon pots, ranging from 5-10 feet tall, create a lush, green barrier for privacy. Near the deck steps, three Tuscan Blue Rosemary plants (Salvia rosmarinus) in 1-gallon pots, each 3-5 feet tall, offer aromatic foliage and insect resistance. Throughout the yard, four clusters of Caradonna Salvia (Salvia nemorosa) in 1-gallon pots, each 18-24 inches tall, add vibrant purple and blue hues, enhancing the garden's color palette and attracting butterflies. The garden combines a mix of textures and colors with drought-tolerant plants, ensuring a water-wise and insect-resistant environment. Visible elements include a wooden deck, a sturdy fence, and well-defined walkways, all contributing to a picturesque and serene outdoor space. The overall color scheme emphasizes purples, blues, and greens, harmoniously blending with the traditional French Country aesthetic.",

    "negative_prompt" => "Blurry, pixelated, cartoon-like, synthetic textures, oversaturated colors, unnatural lighting, exaggerated shadows",

    "prompt_2" => "
    Design a French Country-inspired backyard garden suitable for USDA zone 10a, emphasizing traditional aesthetics, water-wise planting, and insect resistance. Implement the following layout and plant selections:
      Perimeter Planting: Line the entire perimeter with eight American Boxwood (Buxus sempervirens) hedges in 2-gallon pots, each ranging from 5-10 feet tall, to establish privacy and a structured boundary.
      Deck Area:
      Under the Deck: Position five English Lavender (Lavandula angustifolia) plants in 1-gallon pots, each 24-36 inches tall, to provide fragrance and attract butterflies.
      Near Deck Steps: Place three Tuscan Blue Rosemary (Salvia rosmarinus) plants in 1-gallon pots, each 3-5 feet tall, offering aromatic foliage and insect resistance.
      Fence Placement: Install two Black Knight Butterfly Bushes (Buddleja davidii) in 2-gallon pots, each 6-8 feet tall, near the left-side fence to serve as focal points and attract butterflies.
      Yard Clusters: Distribute four Caradonna Salvia (Salvia nemorosa) plants in 1-gallon pots, each 18-24 inches tall, in clusters throughout the yard to add vibrant color and further attract butterflies.
      Additional Design Elements:
      Textures and Colors: Incorporate a harmonious mix of purple, blue, and green hues through the selected plants to create visual interest and a serene atmosphere.
      Water-Wise Features: Utilize drought-tolerant plants such as rosemary and salvia to ensure the garden thrives during hot summers and mild winters.
      Insect-Resistant Plants: Choose plant varieties that naturally deter insects, minimizing the need for chemical interventions.
      Seating and Walkways: Ensure seating areas and walkways are strategically placed near rosemary for easy access to fragrant areas and to guide movement through the garden.
      This design should result in a charming, picturesque outdoor space that balances privacy, beauty, and functionality, tailored to the climate of zone 10a.
    ",

    "negative_prompt_2" => "Distorted shapes, disfigured plants, low detail, plastic-like appearance, 3D render, unrealistic proportions, washed-out colors.",
    "image" => $imageBase64,
    "mask_image" => $maskImageBase64,
    "strength" => 0.8,
    "width" => 1024,
    "height" => 1024,
    "steps" => 30,
    "guidance" => 7.5,
    "seed" => 1,
    "scheduler" => "euler",
    "output_format" => "jpeg",
    "response_format" => "b64"
  ]),
  'headers' => [
    'accept' => 'application/json',
    'content-type' => 'application/json',
    'Authorization' => 'Bearer ' . $apiKey,
  ],
  'verify' => false, // Disable SSL verification
]);

echo $response->getBody();
