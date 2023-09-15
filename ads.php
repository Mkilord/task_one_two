<?php
require_once 'includes/functions.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$ads = fetch_ads();

require_once 'templates/header.php';
?>

<main>
    <div class="container">
        
        <h1>Объявления</h1>
        <table class="ads-table">
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Описание</th>
                    <th>Автор</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ads as $ad): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($ad['title']); ?></td>
                        <td><?php echo htmlspecialchars($ad['description']); ?></td>
                        <td><?php echo htmlspecialchars($ad['username']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>       

        <form id="ad-form">
            <label for="title">Название:</label>
            <input type="text" id="title" name="title" required>
            <label for="description">Описание:</label>
            <textarea id="description" name="description" required></textarea>
            <input type="submit" value="Отправить">
        </form>
    </div>
</main>

<script>
    document.getElementById("ad-form").addEventListener("submit", function(event) {
        event.preventDefault(); 

        const formData = new FormData(event.target);

        fetch("create_ad.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const adRow = `
                    <tr>
                        <td>${data.ad.title}</td>
                        <td>${data.ad.description}</td>
                        <td>${data.ad.username}</td>
                    </tr>
                `;
                document.querySelector(".ads-table tbody").insertAdjacentHTML("afterbegin", adRow);
            } else {
                alert(data.error);
            }
        });
    });
</script>

<?php require_once 'templates/footer.php'; ?>
