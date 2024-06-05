<?php

namespace Models;

use Core\Core;
use Core\Model;

/**
 * @property int $id ID категорї
 * @property string $name Назва категорії
 * @property string $description Опис категорії
 * @property string $photo Шлях до зображення категорії
 */

class Category extends Model
{
    public static $table_name = 'category';

    private static function photo_path($photo): string
    {
        do {
            $photo_name = uniqid() . '.jpg';
            $path = 'Uploads\\Category\\' . $photo_name;
        } while (file_exists($path));
        move_uploaded_file($photo, $path);
        return $photo_name;
    }

    public static function change_photo($id, $new_photo)
    {
        $category = self::find_by_id($id);
        $photo_path = 'Uploads\\Category\\' . $category['photo'];
        if (is_file($photo_path)) {
            unlink($photo_path);
        }

        $photo_name = self::photo_path($new_photo);
        return $photo_name;
    }

    public static function add_category($name, $photo, $description = null)
    {

        $photo_name = self::photo_path($photo);

        $category = new Category();
        $category->name = $name;
        $category->photo = $photo_name;
        $category->description = $description;
        $category->save();
    }

    public static function find_category_by_id($id)
    {
        $rows = self::find_by_id($id);
        if (!empty($rows)) {
            return self::array_to_object($rows, self::class);
        } else {
            return null;
        }
    }

    public static function find_all_categories()
    {
        $rows = self::find_all();
        $category = [];
        foreach ($rows as $row) {
            $category[] = self::array_to_object($row, self::class);
        }
        return $category;
    }

    public static function delete_category($id)
    {
        self::delete_by_id($id);
        
    }

    public static function update_category($id, $name, $photo = null, $description = null)
    {
        $category = self::find_category_by_id($id);
        $category->name = $name;
        if (!empty($photo)) {
            $category->photo = self::change_photo($id, $photo);
        }
        $category->description = $description;
        $category->save();
    }
}
