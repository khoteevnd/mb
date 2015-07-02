<?php
class File {

    public static function uploadIMG($file, $max_size, $dir, $root = false, $source_name = false) {
        //Массив расширений файлов которые не доступны для загрузки
        $blacklist = array(".php", ".phtml", ".php3", ".php4", ".html", ".htm",);
        //Проверяем на допустимость загрузги по расширению файла
        foreach ($blacklist as $item)
            //Если есть совпадение расширения из массива $blacklist
            if (preg_match("/$item\$/i", $file["name"]))
                //если да, выбрасываем ошибку
                throw new Exception("ERROR_AVATAR_TYPE");

        $type = $file["type"];
        $size = $file["size"];

        //Если тип расширения не jpg, jpeg, gif, png продолжаем
        if (
            ($type != "image/jpg")
            && ($type != "image/jpeg")
            && ($type != "image/gif")
            && ($type != "image/png")
        )
            //если нет, выбрасываем ошибку
            throw new Exception("ERROR_AVATAR_TYPE");

        //Если не привышает максимальный размер файла заданный в $max_size продолжаем
        if ($size > $max_size)
            //если превышает, выбрасываем ошибку
            throw new Exception("ERROR_AVATAR_SIZE");

        //Если
        if ($source_name)
            $avatar_name = $file["name"];
        else
            //Присваеваем уникальное имя файла
            $avatar_name = self::getName().".".substr($type, strlen("image/"));


        $upload_file = $dir.$avatar_name;

        if (!$root)
            $upload_file = $_SERVER["DOCUMENT_ROOT"].$upload_file;

        if (!move_uploaded_file($file["tmp_name"], $upload_file))
            throw new Exception("UNKNOWN_ERROR");

        return $avatar_name;
    }

    public static function getName() {
        return uniqid();
    }

    public static function delete($file, $root = false) {
        if (!$root) $file = $_SERVER["DOCUMENT_ROOT"].$file;
        if (file_exists($file)) unlink($file);
    }

    public static function isExists($file, $root = false) {
        if (!$root) $file = $_SERVER["DOCUMENT_ROOT"].$file;
        return file_exists($file);
    }
}