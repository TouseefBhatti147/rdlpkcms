<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    use HasFactory;

    /**
     * Get all pages with specific attributes.
     *
     * @return array
     */
    public static function getPages()
    {
        // Initialize the array to hold the processed pages
        $mPages = [];

        // Retrieve all pages with the specified attributes
        $pages = self::all(['title', 'website', 'image', 'description', 'alias', 'status', 'ordering', 'meta_title', 'meta_description', 'meta_keywords']);

        // Process each page
        foreach ($pages as $page) {
            $mPages[$page->alias] = [
                'title' => $page->title,
                'website' => $page->website,
                'image' => $page->image,
                'alias' => $page->alias,
                'description' => $page->description,
                'status' => $page->status,
                'ordering' => $page->ordering,
                'meta_title' => $page->meta_title,
                'meta_description' => $page->meta_description,
                'meta_keywords' => $page->meta_keywords,
            ];
        }

        return $mPages;
    }

    /**
     * Get the count of pages with status 1.
     *
     * @return int
     */
    public static function getPagesCount()
    {
        return self::where('status', '=', '1')->count();
    }
}
