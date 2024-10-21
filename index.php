<?php
include 'function.php';

$guestsByDate = getGuestsGroupedByDate();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="table.css">
</head>
<body>
    <h1>Buku Tamu</h1>

    <div class="content">
        <p>
            Selamat datang di buku tamu kami. Di sini Anda dapat meninggalkan pesan untuk kami. 
            Pesan Anda sangat berarti untuk meningkatkan kualitas layanan kami.
        </p>
        <img src="furina.jpeg" alt="" class="content-image">
        <p>
            Terima kasih telah berkunjung dan menyempatkan waktu untuk memberikan pesan. 
            Kami menghargai setiap masukan yang Anda berikan.
        </p>
    </div>

    <div class="button-container">
        <label for="add-modal" class="button">Tambah Pesan</label>
    </div>

    <?php foreach ($guestsByDate as $date => $guests): ?>
        <h2>Tanggal: <?= $date ?></h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Tamu</th>
                        <th>Pesan</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($guests as $index => $guest): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($guest['name']) ?></td>
                            <td><?= htmlspecialchars($guest['message']) ?></td>
                            <td><?= $guest['created_at'] ?></td>
                            <td>
                                <label for="edit-modal-<?= $guest['id'] ?>" class="button">Edit</label>
                                <a href="delete_guest.php?id=<?= $guest['id'] ?>" class="button delete">Hapus</a>
                            </td>
                        </tr>

                        <input type="checkbox" id="edit-modal-<?= $guest['id'] ?>" class="modal-toggle">
                        <div class="modal">
                            <div class="modal-content">
                                <form action="edit_guest.php" method="POST">
                                    <input type="hidden" name="id" value="<?= $guest['id'] ?>">
                                    <input type="text" name="name" value="<?= htmlspecialchars($guest['name']) ?>" required><br><br>
                                    <textarea name="message" required><?= htmlspecialchars($guest['message']) ?></textarea><br><br>
                                    <button type="submit">Update</button>
                                </form>
                                <label for="edit-modal-<?= $guest['id'] ?>" class="button close">Tutup</label>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endforeach; ?>

    <input type="checkbox" id="add-modal" class="modal-toggle">
    <div class="modal">
        <div class="modal-content">
            <form action="add_guest.php" method="POST">
                <input type="text" name="name" placeholder="Nama Anda" required><br><br>
                <textarea name="message" placeholder="Pesan Anda" required></textarea><br><br>
                <button type="submit">Kirim</button><br><br>
            </form>
            <label for="add-modal" class="button close">Tutup</label>
        </div>
    </div>
</body>
</html>
