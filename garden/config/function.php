<?php 
$conn = mysqli_connect("localhost", "root", "", "billiard");

function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}

function register ($data){
    
    global $conn;
    $username = $data['username'];
    $email = $data['email'];
    $password = $data['password'];
    $role = $data["role"];

    $query = "INSERT INTO user VALUES ('','$username', '$email', '$password', '$role')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// Fitur Item
function tambah ($data){
    
    global $conn;
    $nama = $data['nama'];
    $jenis_barang = $data['jenis_barang'];
    $harga = $data['harga'];
    $stock = $data["stock"];
    $suplier = $data["suplier"];

    $gambar = upload();
    if( !$gambar ){
        return false;
    }

    $query = "INSERT INTO foodie VALUES ('','$nama', '$jenis_barang', '$harga', '$stock','$suplier','$gambar')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function upload(){
    $namaFile = $_FILES['gambar']['name'];
    $ukuran = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // Cek upload gambar
    if ($error === 4){
        echo "
        <script>
            alert('Masukkan gambar');
        </script>";
        return false;
    }

    // Cek ekstensi
    $jenis = ['jpg', 'jpeg', 'png'];
    $ekstensi = explode('.', $namaFile);
    $ekstensi = strtolower(end($ekstensi));
    if (!in_array($ekstensi, $jenis)){
        echo "
        <script>
            alert('File ini bukan gambar');
        </script>";
        return false;
    }

    // Batas ukuran
    if ($ukuran > 2000000){
        echo "
        <script>
            alert('Gambar terlalu besar');
        </script>";
        return false;
    }

    // Siap upload
    move_uploaded_file($tmpName, '../image/' . $namaFile);
    return $namaFile;
}


function ubah_item ($data){

    global $conn;
    $id = $data["id"];
    $nama = $data["nama"];
    $jenis_barang = $data["jenis_barang"];
    $harga = $data["harga"];
    $stock = $data["stock"];
    $suplier = $data["suplier"];
    $gambar = upgambar();
    if( !$gambar ){
        return false;
    }

    $query = "UPDATE foodie SET 
                                nama = '$nama', 
                                jenis_barang ='$jenis_barang', 
                                harga ='$harga',
                                stock = '$stock',
                                suplier = '$suplier',
                                gambar = '$gambar'
                            WHERE id = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function upgambar(){
    $namaFile = $_FILES['gambar']['name'];
    $ukuran = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // Cek upload gambar
    if ($error === 4){
        echo "
        <script>
            alert('Masukkan gambar');
        </script>";
        return false;
    }

    // Cek ekstensi
    $jenis = ['jpg', 'jpeg', 'png'];
    $ekstensi = explode('.', $namaFile);
    $ekstensi = strtolower(end($ekstensi));
    if (!in_array($ekstensi, $jenis)){
        echo "
        <script>
            alert('File ini bukan gambar');
        </script>";
        return false;
    }

    // Batas ukuran
    if ($ukuran > 2000000){
        echo "
        <script>
            alert('Gambar terlalu besar');
        </script>";
        return false;
    }

    // Siap upload
    move_uploaded_file($tmpName, '../image/' . $namaFile);
    return $namaFile;
}

function hapus_item($id){

    global $conn;
    mysqli_query($conn, "DELETE FROM foodie WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function hapus_user($id){

    global $conn;
    mysqli_query($conn, "DELETE FROM user WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function ubah_profil ($data){

    global $conn;
    $id = $data["id"];
    $username = $data["username"];
    $email = $data["email"];
    $password = $data["password"];

    $query = "UPDATE user SET 
                                username = '$username', 
                                id =$id, 
                                password ='$password'
                            WHERE email ='$email'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
?>




