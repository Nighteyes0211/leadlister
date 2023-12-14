<?php


use Carbon\Carbon;
use Hashids\Hashids;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


/**
 * Converts CSV into array
 *
 */

 function parseCsvToArray($filePath, $has_header = false, ?callable $callback = null)
 {
     // Check if the file exists
     if (file_exists($filePath)) {
        // Open the CSV file for reading
        $file = fopen($filePath, 'r');

        $data = [];

        // Skip header
        $row_index = -1;

        // Read and parse each row
        while (($row = fgetcsv($file)) !== false) {

            $row_index += 1;
            if ($row_index == 0 && $has_header) {
                continue;
            }

            if ($callback) {

                $data[] = $callback($row);

            } else {

                $data[] = collect($row)->filter()->all();

            }
        }

         // Close the file
         fclose($file);

         return $data;
     }

     return null;
 }


/**
 * Get public folder path
 *
 * @return string
 */
function customPublicPath($path = '')
{
    return realpath(base_path(env('DOMAIN_PUBLIC_PATH', 'public'))) . ($path ? DIRECTORY_SEPARATOR . $path : $path);
}


/**
 * Get utc date time
 */
function getUTCDateTime(){
    return Carbon::now("UTC")->toDateTimeString();
}


/**
 * @param $n
 * @return string
 * Use to convert large positive numbers in to short form like 1K+, 100K+, 199K+, 1M+, 10M+, 1B+ etc
 */
function number_format_short( $n ) {
    $n_format = '';
    $suffix = '';
	if ($n > 0 && $n < 1000) {
		// 1 - 999
		$n_format = floor($n);
		$suffix = '';
	} else if ($n >= 1000 && $n < 1000000) {
		// 1k-999k
		$n_format = floor($n / 1000);
		$suffix = 'K+';
	} else if ($n >= 1000000 && $n < 1000000000) {
		// 1m-999m
		$n_format = floor($n / 1000000);
		$suffix = 'M+';
	} else if ($n >= 1000000000 && $n < 1000000000000) {
		// 1b-999b
		$n_format = floor($n / 1000000000);
		$suffix = 'B+';
	} else if ($n >= 1000000000000) {
		// 1t+
		$n_format = floor($n / 1000000000000);
		$suffix = 'T+';
	}

	return !empty($n_format . $suffix) ? $n_format . $suffix : 0;
}


/**
 * Truncates the text with desired length
 *
 * @param string $string
 * @param int $maxLength
 */
function truncateWithEllipsis(string $string, int $maxLength) {
    if (strlen($string) > $maxLength) {
        return substr($string, 0, $maxLength) . '...';
    }
    return $string;
}

/**
 * Parse date in specific form or use default
 *
 * @param string $date
 * @param string $format = "Y-m-d"
 */

function parseDate(string $date, string $format = "F j, Y")
{

    // Format date
    $formattedDate = Carbon::parse($date)->format($format);

    return $formattedDate;
}

/**
 * Parse time in specific form or use default
 *
 * @param string $time
 * @param string $format = "F j, Y"
 */

function parseTime(string $time, string $format = "g:i A")
{

    // Format date
    $formattedTime = Carbon::parse($time)->format($format);

    return $formattedTime;
}

// /**
//  * Encode id
//  *
//  * @param int $id
//  * @param string $alphabet = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890"
//  * @return string
//  */
// function encode_id(int $id, $alphabet = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890")
// {

//     $hashids = new Hashids(env('APP_KEY'), 10, $alphabet); // pad to length 10
//     return $hashids->encode($id);
// }

// /**
//  * Decodes id
//  *
//  * @param string $id
//  * @return int
//  */
// function decode_id(string $id)
// {

//     $hashids = new Hashids(env('APP_KEY'), 10); // pad to length 10
//     $id = $hashids->decode($id); // [1]

//     if (empty($id)) abort(404, 'Invalid hash.');

//     return $id[0];
// }


/**
 * Returns the file name from the path
 *
 * @return string
 */
function fileName(string $path)
{
    return Str::afterLast($path, '/');
}

/**
 * Store file
 *
 * @param string $dir
 * @param $file (File)
 * @param string $disk = domain_public
 *
 * @return string path of file
 */
function storeFile($dir, $file, $disk = 'public_folder')
{
    $name = uniqid() . '.' . $file->getClientOriginalExtension();
    // Store file
    // Storage::disk($disk)->put($dir . '/' . $name, file_get_contents($file));
    $file->storeAs($dir, $name, $disk);

    return $name;
}

/**
 * Generate image
 *
 * @param string $dir
 */
function generateImage($dir, $filename = "image.jpg", $width = 640, $height = 480)
{

    $faker = \Faker\Factory::create();

    sleep(1);

    // Create the featured image
    $imagePath = '/' . $dir . '/' . uniqid() . $filename;
    $imageContents = file_get_contents($faker->imageUrl($width, $height));


    // Create the featured image directory if it doesn't exist
    $full_path = base_path() . '/' . env('DOMAIN_PUBLIC_PATH');

    if (!file_exists($full_path . '/' . $dir)) {
        mkdir($full_path . '/' . $dir, 0777, true);
    }

    file_put_contents($full_path . $imagePath, $imageContents);

    return $imagePath;
}

/**
 * Add query properties to url
 *
 * @param string url
 * @param array $properties
 *
 * @return string Url
 */
function addQueryProperties(string $url, array $properties)
{

    // Query properties
    $queryProperties = [];

    // Parse the URL
    $parts = parse_url($url);

    // Reconstruct the URL without the query string
    $baseUrl = $parts['scheme'] . '://' . $parts['host'] . (array_key_exists('port', $parts) ? ':' . $parts['port'] : '' ) . $parts['path'];

    // Parse the query string
    parse_str(parse_url($url, PHP_URL_QUERY), $queryProperties);

    $properties = array_merge(
        $properties,
        $queryProperties
    );

    return $baseUrl . '?' . http_build_query($properties);
}

/**
 * Retunrs index of the paginated collection
 * NOTE: Only use in loop
 *
 * @param $collection Collection
 * @param $loop Loop var of loop
 *
 * @return int
 */
function getIndexOfPaginatedCollection($collection, $loop)
{
    return $loop->iteration + $collection->perPage() * ($collection->currentPage() - 1);
}

