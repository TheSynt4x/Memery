<?php
/**
 * Upload
 *
 * @author      Josh Lockhart <info@joshlockhart.com>
 * @copyright   2012 Josh Lockhart
 * @link        http://www.joshlockhart.com
 * @version     1.0.0
 *
 * MIT LICENSE
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
namespace Upload;

/**
 * File
 *
 * This class provides the implementation for an uploaded file. It exposes
 * common attributes for the uploaded file (e.g. name, extension, media type)
 * and allows you to attach validations to the file that must pass for the
 * upload to succeed.
 *
 * @author  Josh Lockhart <info@joshlockhart.com>
 * @since   1.0.0
 * @package Upload
 */
class File extends \SplFileInfo
{
    /********************************************************************************
    * Static Properties
    *******************************************************************************/

    /**
     * Upload error code messages
     * @var array
     */
    protected static $errorCodeMessages = array(
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3 => 'The uploaded file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk',
        8 => 'A PHP extension stopped the file upload'
    );

    /**
     * Lookup hash to convert file units to bytes
     * @var array
     */
    protected static $units = array(
        'b' => 1,
        'k' => 1024,
        'm' => 1048576,
        'g' => 1073741824
    );

    /********************************************************************************
    * Instance Properties
    *******************************************************************************/

    public $storage;

    protected $validations;

    protected $errors;

    protected $originalName;

    protected $name;

    protected $extension;

    protected $mimetype;

    protected $errorCode;

    public function __construct($key, \Upload\Storage\Base $storage)
    {

        if (!isset($_FILES[$key])) {
            throw new \InvalidArgumentException("Cannot find uploaded file identified by key: $key");
        }

        $this->storage = $storage;
        $this->validations = array();
        $this->errors = array();
        $this->originalName = $_FILES[$key]['name'];
        $this->errorCode = $_FILES[$key]['error'];

        parent::__construct($_FILES[$key]['tmp_name']);
    }

    public function getName()
    {
        if (!isset($this->name)) {
            $this->name = pathinfo($this->originalName, PATHINFO_FILENAME);
        }

        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getNameWithExtension()
    {
        return sprintf('%s.%s', $this->getName(), $this->getExtension());
    }

    public function getExtension()
    {
        if (!isset($this->extension)) {
            $this->extension = strtolower(pathinfo($this->originalName, PATHINFO_EXTENSION));
        }

        return $this->extension;
    }

    public function getMimetype()
    {
        if (!isset($this->mimeType)) {
            $finfo = new \finfo(FILEINFO_MIME);
            $mimetype = $finfo->file($this->getPathname());
            $mimetypeParts = preg_split('/\s*[;,]\s*/', $mimetype);
            $this->mimetype = strtolower($mimetypeParts[0]);
            unset($finfo);
        }

        return $this->mimetype;
    }

    public function getMd5()
    {
        return md5_file($this->getPathname());
    }

    public function getDimensions()
    {
        list($width, $height) = getimagesize($this->getPathname());
        return array(
            'width' => $width,
            'height' => $height
        );
    }


    public function addValidations($validations)
    {
        if (!is_array($validations)) {
            $validations = array($validations);
        }
        foreach ($validations as $validation) {
            if ($validation instanceof \Upload\Validation\Base) {
                $this->validations[] = $validation;
            }
        }
    }

    public function getValidations()
    {
        return $this->validations;
    }

    public function validate()
    {
        // Validate is uploaded OK
        if ($this->isOk() === false) {
            $this->errors[] = self::$errorCodeMessages[$this->errorCode];
        }

        // Validate is uploaded file
        if ($this->isUploadedFile() === false) {
            $this->errors[] = 'The uploaded file was not sent with a POST request';
        }

        // User validations
        foreach ($this->validations as $validation) {
            if ($validation->validate($this) === false) {
                $this->errors[] = $validation->getMessage();
            }
        }

        return empty($this->errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function addError($error)
    {
        $this->errors[] = $error;

        return $this;
    }

    public function upload($newName = null)
    {
        if ($this->validate() === false) {
            throw new \Upload\Exception\UploadException('File validation failed');
        }

        // Update the name, leaving out the extension
        if (is_string($newName)) {
            $this->name = pathinfo($newName, PATHINFO_FILENAME);
        }

        return $this->storage->upload($this, $newName);
    }

    public function isUploadedFile()
    {
        return is_uploaded_file($this->getPathname());
    }

    public function isOk()
    {
        return ($this->errorCode === UPLOAD_ERR_OK);
    }

    public static function humanReadableToBytes($input)
    {
        $number = (int)$input;
        $unit = strtolower(substr($input, -1));
        if (isset(self::$units[$unit])) {
            $number = $number * self::$units[$unit];
        }

        return $number;
    }
}
