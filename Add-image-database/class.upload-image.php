<?php 

public function insert($table, $values, $options = [])
{

    try {


        if (!empty($_FILES[$options['emp_file']]['name'])) {


            $name_y = $this->imageUpload(
                $_FILES[$options['emp_file']]['name'],
                $_FILES[$options['emp_file']]['size'],
                $_FILES[$options['emp_file']]['tmp_name'],
                $options['dir']
            );

            
            $values += [$options['emp_file'] => $name_y];
        }






        if (isset($options['pass'])) {
            $values[$options['pass']] = md5($values[$options['pass']]);
        }
       
        //unset($values[$options["form-name"]]);
        $stmt = $this->db->prepare("INSERT INTO $table SET {$this->addValue($values)}");
        $stmt->execute(array_values($values));

        return ['status' => TRUE];
    } catch (Exception $e) {

        return ['status' => FALSE, 'error' => $e->getMessage()];
    }
}

public function imageUpload($name, $size, $tmp_name, $dir, $file_delete = null)
{

    try {

        $izinli_uzantilar = [
            'jpg',
            'jpge',
            'png',
            'ico'
        ];

        $ext = strtolower(substr($name, strpos($name, '.') + 1));

        if (in_array($ext, $izinli_uzantilar) === false) {
            throw new Exception('Bu dosya türü kabul edilmemektedir...');
        }

        if ($size > 1048576) {
            throw new Exception('Dosya boyutu çok büyük...');
        }

        $name_y = uniqid() . "." . $ext;

        if (!@move_uploaded_file($tmp_name, "img/$dir/$name_y")) {
            throw new Exception('Dosya yükleme hatası...');
        }

        if (!empty($file_delete)) {
            unlink("img/$dir/$file_delete");
        }

        return $name_y;
    } catch (Exception $e) {

        return ['status' => FALSE, 'error' => $e->getMessage()];
    }
}

?>