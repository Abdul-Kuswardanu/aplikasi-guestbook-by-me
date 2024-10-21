<?php
include 'db_guestbook.php';

/** ------------------------------------------------------------------------------------ */

// fungsi tambah guest nya
function addGuest($name, $message) {
    global $conn;
    $sql = "INSERT INTO guests (name, message) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $name, $message);
    return $stmt->execute();
}

/** ------------------------------------------------------------------------------------ */

// fungsi edit nama guest jika ada yang typo
function updateGuest($id, $name, $message) {
    global $conn;
    $sql = "UPDATE guests SET name = ?, message = ?, updated_at = NOW() WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $name, $message, $id);
    return $stmt->execute();
}

/** ------------------------------------------------------------------------------------ */

// fungsi menampilkan guest
function getGuestById($id) {
    global $conn;
    $sql = "SELECT * FROM guests WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

/** ------------------------------------------------------------------------------------ */

// fungsi get guest
function getGuests() {
    global $conn;
    $sql = "SELECT * FROM guests ORDER BY created_at DESC";
    return $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
}

/** ------------------------------------------------------------------------------------ */

// fungsi menghapus guest
function deleteGuest($id) {
    global $conn;
    $sql = "DELETE FROM guests WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    return $stmt->execute();
}

/** ------------------------------------------------------------------------------------ */

// fungsi get guest by date
function getGuestsGroupedByDate() {
    global $conn;
    $sql = "SELECT * FROM guests ORDER BY created_at ASC";
    $result = $conn->query($sql);
    $guests = [];
    while ($row = $result->fetch_assoc()) {
        $date = date('Y-m-d', strtotime($row['created_at']));
        $guests[$date][] = $row;
    }
    return $guests;
}

/** ------------------------------------------------------------------------------------ */
?>
