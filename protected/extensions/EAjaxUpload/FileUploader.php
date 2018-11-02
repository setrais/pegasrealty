<?php
/**
 * Handle file uploads via XMLHttpRequest
 */
class UploadedFileXhr
{
    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    function save($path)
    {
        $input = fopen("php://input", "r");
        $temp = tmpfile();
        $realSize = stream_copy_to_stream($input, $temp);
        fclose($input);

        if ($realSize != $this->getSize()) {
            return false;
        }

        $target = fopen($path, "w");
        fseek($temp, 0, SEEK_SET);
        stream_copy_to_stream($temp, $target);
        fclose($target);

        return true;
    }

    function getName()
    {
        return $_GET['qqfile'];
    }

    function getSize()
    {
        if (isset($_SERVER["CONTENT_LENGTH"])) {
            return (int)$_SERVER["CONTENT_LENGTH"];
        } else {
            throw new Exception('Getting content length is not supported.');
        }
    }
}

/**
 * Handle file uploads via regular form post (uses the $_FILES array)
 */
class UploadedFileForm
{
    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    function save($path)
    {
        if (!move_uploaded_file($_FILES['qqfile']['tmp_name'], $path)) {
            return false;
        }
        return true;
    }

    function getName()
    {
        return $_FILES['qqfile']['name'];
    }

    function getSize()
    {
        return $_FILES['qqfile']['size'];
    }
}

class FileUploader
{
    private $allowedExtensions = array();
    private $sizeLimit = 104857600; // 100mb
    private $file;

    function __construct(array $allowedExtensions = array(), $sizeLimit = 104857600)
    {
        $allowedExtensions = array_map("strtolower", $allowedExtensions);

        $this->allowedExtensions = $allowedExtensions;
        $this->sizeLimit = $sizeLimit;

        $this->checkServerSettings();

        if (isset($_GET['qqfile'])) {
            $this->file = new UploadedFileXhr();
        } elseif (isset($_FILES['qqfile'])) {
            $this->file = new UploadedFileForm();
        } else {
            $this->file = false;
        }
    }

    private function checkServerSettings()
    {
        $uploadSize = $this->toBytes(ini_get('upload_max_filesize'));

        if ($uploadSize > $this->sizeLimit) {
            $size = max(1, $this->sizeLimit / 1024 / 1024) . 'Мб';
            die("{'error':'Файлы, размером более $size не могут быть загружены. Обратитесь к системному администратору.'}");
        }
    }

    private function toBytes($str)
    {
        $val = trim($str);
        $last = strtolower($str[strlen($str) - 1]);
        switch ($last) {
            case 'g':
                $val *= 1024;
            case 'm':
                $val *= 1024;
            case 'k':
                $val *= 1024;
        }
        return $val;
    }

    function handleUpload($uploadDirectory, $replaceOldFile = false, $setWaterMark = false, $newNameFile="")
    {
        if (!is_writable($uploadDirectory)) {
            return array('error' => 'Не получилось записать файл.');
        }

        if (!$this->file) {
            return array('error' => 'Файл не обнаружен.');
        }

        $size = $this->file->getSize();

        if ($size == 0) {
            return array('error' => 'Файл пустой.');
        }

        if ($size > $this->sizeLimit) {
            return array('error' => 'Файл слишком большой, максимальный размер файла ' . $this->sizeLimit . '.');
        }

        $pathinfo = pathinfo($this->file->getName());
        $filename = $pathinfo['filename'];
        $ext = $pathinfo['extension'];

        if ($this->allowedExtensions && !in_array(strtolower($ext), $this->allowedExtensions)) {
            $these = implode(', ', $this->allowedExtensions);
            return array('error' => 'Файл имеет не верное расширение. Разрешены файлы с расширениями ' . $these . '.');
        }

        if (!$replaceOldFile) {
            if ( trim($newNameFile)<>"" ) { 
                    $filename .= $newNameFile;
            }else{
                while (file_exists($uploadDirectory . $filename . '.' . $ext)) {
                    $filename .= rand(10, 99);
                }                
            }
        }

		#return array('error' => $uploadDirectory . $filename . '.' . $ext);

        if ($this->file->save($uploadDirectory . $filename . '.' . $ext)) {
            if ($setWaterMark)
                $this->MySetWatermark($uploadDirectory . $filename . '.' . $ext, $ext);
            return array('success' => true, 'filename' => $filename . '.' . $ext);
        } else {
            return array('error' => 'Произошла ошибка. Файл не удалось загрузить.');
        }
    }

    public function MySetWatermark($filename, $ext){
        $im = null;
        if ($ext == 'jpeg' || $ext = 'jpg')
            $im = imagecreatefromjpeg($filename);
        if ($ext == 'png')
            $im = imagecreatefrompng($filename);
        if ($ext == 'gif')
            $im = imagecreatefromgif($filename);
        $this->SetWatermark($im, $ext, Yii::app()->basePath.'\..\images\watermark.png', $filename);
    }

    //create watermark
    //$sType output format jpeg,jpg,gif,png
    //$sfWatermark path to 24b – png
    function SetWatermark($rImg, $sType, $sfWatermark, $filename){
        $iDelta = 5;
        $xImg = imagesx($rImg);
        $yImg = imagesy($rImg);

        $r = imagecreatefrompng($sfWatermark);
        $x = imagesx($r);
        $y = imagesy($r);

        $xDest = $xImg - ($x + $iDelta);
        $yDest = $yImg - ($y + $iDelta);
        imageAlphaBlending($rImg,TRUE);
        imagecopy($rImg,$r, $xDest,$yDest, 0,0, $x,$y);
        if('png' == $sType) imagepng($rImg, $filename);
        if('jpeg' == $sType || 'jpg' == $sType) imagejpeg($rImg, $filename);
        if('gif' == $sType) imagegif($rImg, $filename);
        imagedestroy($r);
        imagedestroy($rImg);
    }
}