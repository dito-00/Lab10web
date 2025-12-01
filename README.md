# Praktikum 10 – PHP OOP (Object Oriented Programming)

## Tujuan Praktikum
1. Memahami konsep dasar OOP dalam PHP  
2. Memahami penggunaan Class dan Object  
3. Mengimplementasikan konsep modularisasi menggunakan class library (Form & Database)

## 1. Persiapan
Buat folder baru pada webserver:

```
htdocs/Lab10Web/
```

Gunakan text editor seperti **VSCode**.

## 2. Langkah-langkah Praktikum

### 2.1 Membuat Class Mobil (OOP Dasar)
PDF menjelaskan dasar penggunaan class dengan contoh `Mobil`.

---

# 3. Modularisasi Dengan Class Library

Menggunakan:
- **form.php**
- **database.php**
- **config.php**
- **form_input.php**
- **simpan.php**

---

# 4. Source Code

## 4.1 form.php
```php
<?php
class Form {
    private $fields = array();
    private $action;
    private $submit = "Submit";
    private $jumField = 0;

    public function __construct($action, $submit) {
        $this->action = $action;
        $this->submit = $submit;
    }

    public function addField($name, $label) {
        $this->fields[$this->jumField]['name'] = $name;
        $this->fields[$this->jumField]['label'] = $label;
        $this->jumField++;
    }

    public function displayForm() {
        echo "<form action='".$this->action."' method='POST'>";
        echo "<table width='100%' border='0'>";
        foreach ($this->fields as $field) {
            echo "<tr><td width='120' align='right'>".$field['label']."</td>";
            echo "<td><input type='text' name='".$field['name']."'></td></tr>";
        }
        echo "<tr><td colspan='2'><input type='submit' value='".$this->submit."'></td></tr>";
        echo "</table></form>";
    }
}
?>
```

## 4.2 config.php
```php
<?php
$config = [
    "host" => "localhost",
    "username" => "root",
    "password" => "",
    "db_name" => "latihan1"
];
?>
```

## 4.3 database.php
```php
<?php
class Database {
    protected $host;
    protected $user;
    protected $password;
    protected $db_name;
    protected $conn;

    public function __construct() {
        $this->getConfig();
        $this->conn = new mysqli(
            $this->host,
            $this->user,
            $this->password,
            $this->db_name
        );

        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    private function getConfig() {
        include_once "config.php";
        global $config;

        $this->host      = $config['host'];
        $this->user      = $config['username'];
        $this->password  = $config['password'];
        $this->db_name   = $config['db_name'];
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function insert($table, $data) {
        $columns = implode(",", array_keys($data));
        $values  = "'" . implode("','", array_values($data)) . "'";

        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        return $this->conn->query($sql);
    }
}
?>
```

## 4.4 form_input.php
```php
<?php
include "form.php";
include "database.php";

echo "<h2>Form Input Mahasiswa</h2>";

$form = new Form("simpan.php", "Simpan Data");
$form->addField("nim", "NIM");
$form->addField("nama", "Nama");
$form->addField("alamat", "Alamat");

$form->displayForm();
?>
```

## 4.5 simpan.php
```php
<?php
include "database.php";

$db = new Database();

$data = [
    "nim"    => $_POST['nim'],
    "nama"   => $_POST['nama'],
    "alamat" => $_POST['alamat']
];

$save = $db->insert("mahasiswa", $data);

if ($save) {
    echo "Data berhasil disimpan!";
} else {
    echo "Gagal menyimpan data.";
}
?>
```

---

# 5. Struktur Folder
```
Lab10Web/
├─ form.php
├─ database.php
├─ config.php
├─ form_input.php
├─ simpan.php
```

# 6. Hasil & Pembahasan
✔ Form tampil  
✔ Data tersimpan  
✔ Modularisasi berhasil  

# 7. Link Repository
*(isi setelah upload ke GitHub)*
